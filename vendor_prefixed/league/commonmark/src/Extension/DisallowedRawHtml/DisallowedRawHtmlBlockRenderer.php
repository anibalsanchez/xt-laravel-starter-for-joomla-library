<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\DisallowedRawHtml;

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Block\Renderer\BlockRendererInterface;
use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\Util\ConfigurationAwareInterface;
use Extly\League\CommonMark\Util\ConfigurationInterface;

final class DisallowedRawHtmlBlockRenderer implements BlockRendererInterface, ConfigurationAwareInterface
{
    /** @var BlockRendererInterface */
    private $htmlBlockRenderer;

    public function __construct(BlockRendererInterface $htmlBlockRenderer)
    {
        $this->htmlBlockRenderer = $htmlBlockRenderer;
    }

    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        $rendered = $this->htmlBlockRenderer->render($block, $htmlRenderer, $inTightList);

        if ($rendered === '') {
            return '';
        }

        // Match these types of tags: <title> </title> <title x="sdf"> <title/> <title />
        return preg_replace('/<(\/?(?:title|textarea|style|xmp|iframe|noembed|noframes|script|plaintext)[ \/>])/i', '&lt;$1', $rendered);
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        if ($this->htmlBlockRenderer instanceof ConfigurationAwareInterface) {
            $this->htmlBlockRenderer->setConfiguration($configuration);
        }
    }
}
