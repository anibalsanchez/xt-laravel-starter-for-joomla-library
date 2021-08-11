<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

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

namespace Extly\League\CommonMark\Extension\Footnote\Renderer;

use Extly\League\CommonMark\Extension\Footnote\Node\Footnote;
use Extly\League\CommonMark\Node\Node;
use Extly\League\CommonMark\Renderer\ChildNodeRendererInterface;
use Extly\League\CommonMark\Renderer\NodeRendererInterface;
use Extly\League\CommonMark\Util\HtmlElement;
use Extly\League\CommonMark\Xml\XmlNodeRendererInterface;
use Extly\League\Config\ConfigurationAwareInterface;
use Extly\League\Config\ConfigurationInterface;

final class FootnoteRenderer implements NodeRendererInterface, XmlNodeRendererInterface, ConfigurationAwareInterface
{
    private ConfigurationInterface $config;

    /**
     * @param Footnote $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Footnote::assertInstanceOf($node);

        $attrs = $node->data->getData('attributes');

        $attrs->append('class', $this->config->get('footnote/footnote_class'));
        $attrs->set('id', $this->config->get('footnote/footnote_id_prefix') . \mb_strtolower($node->getReference()->getLabel()));
        $attrs->set('role', 'doc-endnote');

        return new HtmlElement(
            'li',
            $attrs->export(),
            $childRenderer->renderNodes($node->children()),
            true
        );
    }

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

    public function getXmlTagName(Node $node): string
    {
        return 'footnote';
    }

    /**
     * @param Footnote $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        Footnote::assertInstanceOf($node);

        return [
            'reference' => $node->getReference()->getLabel(),
        ];
    }
}
