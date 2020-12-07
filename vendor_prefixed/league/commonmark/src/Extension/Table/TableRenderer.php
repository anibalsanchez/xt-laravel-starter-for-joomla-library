<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

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

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Block\Renderer\BlockRendererInterface;
use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\HtmlElement;

final class TableRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        if (!$block instanceof Table) {
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        $attrs = $block->getData('attributes', []);

        $separator = $htmlRenderer->getOption('inner_separator', "\n");

        $children = $htmlRenderer->renderBlocks($block->children());

        return new HtmlElement('table', $attrs, $separator . \trim($children) . $separator);
    }
}
