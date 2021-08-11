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

use Extly\League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use Extly\League\CommonMark\Node\Block\Paragraph;
use Extly\League\CommonMark\Parser\Block\BlockStart;
use Extly\League\CommonMark\Parser\Block\BlockStartParserInterface;
use Extly\League\CommonMark\Parser\Cursor;
use Extly\League\CommonMark\Parser\MarkdownParserStateInterface;
use Extly\League\CommonMark\Util\RegexHelper;

final class HtmlBlockStartParser implements BlockStartParserInterface
{
    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        if ($cursor->isIndented() || $cursor->getNextNonSpaceCharacter() !== '<') {
            return BlockStart::none();
        }

        $tmpCursor = clone $cursor;
        $tmpCursor->advanceToNextNonSpaceOrTab();
        $line = $tmpCursor->getRemainder();

        for ($blockType = 1; $blockType <= 7; $blockType++) {
            /** @psalm-var HtmlBlock::TYPE_* $blockType */
            /** @phpstan-var HtmlBlock::TYPE_* $blockType */
            $match = RegexHelper::matchAt(
                RegexHelper::getHtmlBlockOpenRegex($blockType),
                $line
            );

            if ($match !== null && ($blockType < 7 || $this->isType7BlockAllowed($cursor, $parserState))) {
                return BlockStart::of(new HtmlBlockParser($blockType))->at($cursor);
            }
        }

        return BlockStart::none();
    }

    private function isType7BlockAllowed(Cursor $cursor, MarkdownParserStateInterface $parserState): bool
    {
        // Type 7 blocks can't interrupt paragraphs
        if ($parserState->getLastMatchedBlockParser()->getBlock() instanceof Paragraph) {
            return false;
        }

        // Even lazy ones
        return ! $parserState->getActiveBlockParser()->canHaveLazyContinuationLines();
    }
}
