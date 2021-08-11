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

namespace Extly\League\CommonMark\Extension\HeadingPermalink;

use Extly\League\CommonMark\Node\Node;
use Extly\League\CommonMark\Renderer\ChildNodeRendererInterface;
use Extly\League\CommonMark\Renderer\NodeRendererInterface;
use Extly\League\CommonMark\Util\HtmlElement;
use Extly\League\CommonMark\Xml\XmlNodeRendererInterface;
use Extly\League\Config\ConfigurationAwareInterface;
use Extly\League\Config\ConfigurationInterface;

/**
 * Renders the HeadingPermalink elements
 */
final class HeadingPermalinkRenderer implements NodeRendererInterface, XmlNodeRendererInterface, ConfigurationAwareInterface
{
    public const DEFAULT_SYMBOL = '¶';

    /** @psalm-readonly-allow-private-mutation */
    private ConfigurationInterface $config;

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

    /**
     * @param HeadingPermalink $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        HeadingPermalink::assertInstanceOf($node);

        $slug = $node->getSlug();

        $idPrefix = (string) $this->config->get('heading_permalink/id_prefix');
        if ($idPrefix !== '') {
            $idPrefix .= '-';
        }

        $fragmentPrefix = (string) $this->config->get('heading_permalink/fragment_prefix');
        if ($fragmentPrefix !== '') {
            $fragmentPrefix .= '-';
        }

        $attrs = $node->data->getData('attributes');
        $attrs->set('id', $idPrefix . $slug);
        $attrs->set('href', '#' . $fragmentPrefix . $slug);
        $attrs->append('class', $this->config->get('heading_permalink/html_class'));
        $attrs->set('aria-hidden', 'true');
        $attrs->set('title', $this->config->get('heading_permalink/title'));

        $symbol = $this->config->get('heading_permalink/symbol');
        \assert(\is_string($symbol));

        return new HtmlElement('a', $attrs->export(), \htmlspecialchars($symbol), false);
    }

    public function getXmlTagName(Node $node): string
    {
        return 'heading_permalink';
    }

    /**
     * @param HeadingPermalink $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        HeadingPermalink::assertInstanceOf($node);

        return [
            'slug' => $node->getSlug(),
        ];
    }
}
