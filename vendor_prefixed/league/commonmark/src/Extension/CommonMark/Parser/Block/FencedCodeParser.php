<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\CommonMark\Parser\Block;

use Extly\League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use Extly\League\CommonMark\Parser\Block\AbstractBlockContinueParser;
use Extly\League\CommonMark\Parser\Block\BlockContinue;
use Extly\League\CommonMark\Parser\Block\BlockContinueParserInterface;
use Extly\League\CommonMark\Parser\Cursor;
use Extly\League\CommonMark\Util\ArrayCollection;
use Extly\League\CommonMark\Util\RegexHelper;

final class FencedCodeParser extends AbstractBlockContinueParser
{
    /** @psalm-readonly */
    private FencedCode $block;

    /** @var ArrayCollection<string> */
    private ArrayCollection $strings;

    public function __construct(int $fenceLength, string $fenceChar, int $fenceOffset)
    {
        $this->block   = new FencedCode($fenceLength, $fenceChar, $fenceOffset);
        $this->strings = new ArrayCollection();
    }

    public function getBlock(): FencedCode
    {
        return $this->block;
    }

    public function tryContinue(Cursor $cursor, BlockContinueParserInterface $activeBlockParser): ?BlockContinue
    {
        // Check for closing code fence
        if (! $cursor->isIndented() && $cursor->getNextNonSpaceCharacter() === $this->block->getChar()) {
            $match = RegexHelper::matchFirst('/^(?:`{3,}|~{3,})(?= *$)/', $cursor->getLine(), $cursor->getNextNonSpacePosition());
            if ($match !== null && \strlen($match[0]) >= $this->block->getLength()) {
                // closing fence - we're at end of line, so we can finalize now
                return BlockContinue::finished();
            }
        }

        // Skip optional spaces of fence offset
        // Optimization: don't attempt to match if we're at a non-space position
        if ($cursor->getNextNonSpacePosition() > $cursor->getPosition()) {
            $cursor->match('/^ {0,' . $this->block->getOffset() . '}/');
        }

        return BlockContinue::at($cursor);
    }

    public function addLine(string $line): void
    {
        $this->strings[] = $line;
    }

    public function closeBlock(): void
    {
        // first line becomes info string
        $firstLine = $this->strings->first();
        if ($firstLine === false) {
            $firstLine = '';
        }

        $this->block->setInfo(RegexHelper::unescape(\trim($firstLine)));

        if ($this->strings->count() === 1) {
            $this->block->setLiteral('');
        } else {
            $this->block->setLiteral(\implode("\n", $this->strings->slice(1)) . "\n");
        }
    }
}
