<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) Rezo Zero / Ambroise Maupate
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Extly\League\CommonMark\Extension\Footnote\Parser;

use Extly\League\CommonMark\Block\Parser\BlockParserInterface;
use Extly\League\CommonMark\ContextInterface;
use Extly\League\CommonMark\Cursor;
use Extly\League\CommonMark\Extension\Footnote\Node\Footnote;
use Extly\League\CommonMark\Reference\Reference;
use Extly\League\CommonMark\Util\RegexHelper;

final class FootnoteParser implements BlockParserInterface
{
    public function parse(ContextInterface $context, Cursor $cursor): bool
    {
        if ($cursor->isIndented()) {
            return false;
        }

        $match = RegexHelper::matchFirst(
            '/^\[\^([^\n^\]]+)\]\:\s/',
            $cursor->getLine(),
            $cursor->getNextNonSpacePosition()
        );

        if (!$match) {
            return false;
        }

        $cursor->advanceToNextNonSpaceOrTab();
        $cursor->advanceBy(\strlen($match[0]));
        $str = $cursor->getRemainder();
        \preg_replace('/^\[\^([^\n^\]]+)\]\:\s/', '', $str);

        if (\preg_match('/^\[\^([^\n^\]]+)\]\:\s/', $match[0], $matches) > 0) {
            $context->addBlock($this->createFootnote($matches[1]));
            $context->setBlocksParsed(true);

            return true;
        }

        return false;
    }

    private function createFootnote(string $label): Footnote
    {
        return new Footnote(
            new Reference($label, $label, $label)
        );
    }
}
