<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Block\Parser;

use Extly\League\CommonMark\Block\Element\Heading;
use Extly\League\CommonMark\ContextInterface;
use Extly\League\CommonMark\Cursor;
use Extly\League\CommonMark\Util\RegexHelper;

final class ATXHeadingParser implements BlockParserInterface
{
    public function parse(ContextInterface $context, Cursor $cursor): bool
    {
        if ($cursor->isIndented()) {
            return false;
        }

        $match = RegexHelper::matchFirst('/^#{1,6}(?:[ \t]+|$)/', $cursor->getLine(), $cursor->getNextNonSpacePosition());
        if (!$match) {
            return false;
        }

        $cursor->advanceToNextNonSpaceOrTab();

        $cursor->advanceBy(\strlen($match[0]));

        $level = \strlen(\trim($match[0]));
        $str = $cursor->getRemainder();
        /** @var string $str */
        $str = \preg_replace('/^[ \t]*#+[ \t]*$/', '', $str);
        /** @var string $str */
        $str = \preg_replace('/[ \t]+#+[ \t]*$/', '', $str);

        $context->addBlock(new Heading($level, $str));
        $context->setBlocksParsed(true);

        return true;
    }
}
