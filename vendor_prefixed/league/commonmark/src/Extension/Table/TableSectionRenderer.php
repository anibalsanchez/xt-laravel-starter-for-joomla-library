<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This is part of the league/commonmark package.
 *
 * (c) Martin Hasoň <martin.hason@gmail.com>
 * (c) Webuni s.r.o. <info@webuni.cz>
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\Table;

use Extly\League\CommonMark\Node\Node;
use Extly\League\CommonMark\Renderer\ChildNodeRendererInterface;
use Extly\League\CommonMark\Renderer\NodeRendererInterface;
use Extly\League\CommonMark\Util\HtmlElement;
use Extly\League\CommonMark\Xml\XmlNodeRendererInterface;

final class TableSectionRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param TableSection $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        TableSection::assertInstanceOf($node);

        if (! $node->hasChildren()) {
            return '';
        }

        $attrs = $node->data->get('attributes');

        $separator = $childRenderer->getInnerSeparator();

        $tag = $node->getType() === TableSection::TYPE_HEAD ? 'thead' : 'tbody';

        return new HtmlElement($tag, $attrs, $separator . $childRenderer->renderNodes($node->children()) . $separator);
    }

    public function getXmlTagName(Node $node): string
    {
        return 'table_section';
    }

    /**
     * @param TableSection $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        TableSection::assertInstanceOf($node);

        return [
            'type' => $node->getType(),
        ];
    }
}
