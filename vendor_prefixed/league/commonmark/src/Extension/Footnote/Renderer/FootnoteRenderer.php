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

namespace Extly\League\CommonMark\Extension\Footnote\Renderer;

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Block\Renderer\BlockRendererInterface;
use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\Extension\Footnote\Node\Footnote;
use Extly\League\CommonMark\HtmlElement;
use Extly\League\CommonMark\Util\ConfigurationAwareInterface;
use Extly\League\CommonMark\Util\ConfigurationInterface;

final class FootnoteRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    /** @var ConfigurationInterface */
    private $config;

    /**
     * @param Footnote                 $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!($block instanceof Footnote)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . \get_class($block));
        }

        $attrs = $block->getData('attributes', []);
        $attrs['class'] = $attrs['class'] ?? $this->config->get('footnote/footnote_class', 'footnote');
        $attrs['id'] = $this->config->get('footnote/footnote_id_prefix', 'fn:') . \mb_strtolower($block->getReference()->getLabel());
        $attrs['role'] = 'doc-endnote';

        foreach ($block->getBackrefs() as $backref) {
            $block->lastChild()->appendChild($backref);
        }

        return new HtmlElement(
            'li',
            $attrs,
            $htmlRenderer->renderBlocks($block->children()),
            true
        );
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->config = $configuration;
    }
}
