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

namespace Extly\League\CommonMark\Extension\CommonMark\Renderer\Inline;

use Extly\League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Extly\League\CommonMark\Node\Node;
use Extly\League\CommonMark\Renderer\ChildNodeRendererInterface;
use Extly\League\CommonMark\Renderer\NodeRendererInterface;
use Extly\League\CommonMark\Util\HtmlElement;
use Extly\League\CommonMark\Xml\XmlNodeRendererInterface;

final class StrongRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param Strong $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Strong::assertInstanceOf($node);

        $attrs = $node->data->get('attributes');

        return new HtmlElement('strong', $attrs, $childRenderer->renderNodes($node->children()));
    }

    public function getXmlTagName(Node $node): string
    {
        return 'strong';
    }

    /**
     * {@inheritDoc}
     */
    public function getXmlAttributes(Node $node): array
    {
        return [];
    }
}
