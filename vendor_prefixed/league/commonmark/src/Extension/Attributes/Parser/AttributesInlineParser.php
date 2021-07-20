<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) 2015 Martin Hasoň <martin.hason@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Extly\League\CommonMark\Extension\Attributes\Parser;

use Extly\League\CommonMark\Extension\Attributes\Node\AttributesInline;
use Extly\League\CommonMark\Extension\Attributes\Util\AttributesHelper;
use Extly\League\CommonMark\Inline\Element\Text;
use Extly\League\CommonMark\Inline\Parser\InlineParserInterface;
use Extly\League\CommonMark\InlineParserContext;

final class AttributesInlineParser implements InlineParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCharacters(): array
    {
        return ['{'];
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $cursor = $inlineContext->getCursor();

        $char = (string) $cursor->peek(-1);

        $attributes = AttributesHelper::parseAttributes($cursor);
        if ($attributes === []) {
            return false;
        }

        if ($char === ' ' && ($previousInline = $inlineContext->getContainer()->lastChild()) instanceof Text) {
            $previousInline->setContent(\rtrim($previousInline->getContent(), ' '));
        }

        if ($char === '') {
            $cursor->advanceToNextNonSpaceOrNewline();
        }

        $node = new AttributesInline($attributes, $char === ' ' || $char === '');
        $inlineContext->getContainer()->appendChild($node);

        return true;
    }
}
