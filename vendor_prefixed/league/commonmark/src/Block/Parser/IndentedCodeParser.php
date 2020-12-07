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

use Extly\League\CommonMark\Block\Element\IndentedCode;
use Extly\League\CommonMark\Block\Element\Paragraph;
use Extly\League\CommonMark\ContextInterface;
use Extly\League\CommonMark\Cursor;

final class IndentedCodeParser implements BlockParserInterface
{
    public function parse(ContextInterface $context, Cursor $cursor): bool
    {
        if (!$cursor->isIndented()) {
            return false;
        }

        if ($context->getTip() instanceof Paragraph) {
            return false;
        }

        if ($cursor->isBlank()) {
            return false;
        }

        $cursor->advanceBy(Cursor::INDENT_LEVEL, true);
        $context->addBlock(new IndentedCode());

        return true;
    }
}
