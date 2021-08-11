<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

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

namespace Extly\League\CommonMark\Extension\CommonMark\Parser\Inline;

use Extly\League\CommonMark\Node\Inline\Text;
use Extly\League\CommonMark\Parser\Inline\InlineParserInterface;
use Extly\League\CommonMark\Parser\Inline\InlineParserMatch;
use Extly\League\CommonMark\Parser\InlineParserContext;
use Extly\League\CommonMark\Util\Html5EntityDecoder;
use Extly\League\CommonMark\Util\RegexHelper;

final class EntityParser implements InlineParserInterface
{
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::regex(RegexHelper::PARTIAL_ENTITY);
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $entity = $inlineContext->getFullMatch();

        $inlineContext->getCursor()->advanceBy($inlineContext->getFullMatchLength());
        $inlineContext->getContainer()->appendChild(new Text(Html5EntityDecoder::decode($entity)));

        return true;
    }
}
