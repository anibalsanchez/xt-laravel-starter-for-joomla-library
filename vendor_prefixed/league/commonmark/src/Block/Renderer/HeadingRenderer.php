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

namespace Extly\League\CommonMark\Block\Renderer;

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Block\Element\Heading;
use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\HtmlElement;

final class HeadingRenderer implements BlockRendererInterface
{
    /**
     * @param Heading                  $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!($block instanceof Heading)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . \get_class($block));
        }

        $tag = 'h' . $block->getLevel();

        $attrs = $block->getData('attributes', []);

        return new HtmlElement($tag, $attrs, $htmlRenderer->renderInlines($block->children()));
    }
}
