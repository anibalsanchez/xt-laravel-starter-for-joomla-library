<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\InlinesOnly;

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Block\Element\Document;
use Extly\League\CommonMark\Block\Element\InlineContainerInterface;
use Extly\League\CommonMark\Block\Renderer\BlockRendererInterface;
use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\Inline\Element\AbstractInline;

/**
 * Simply renders child elements as-is, adding newlines as needed.
 */
final class ChildRenderer implements BlockRendererInterface
{
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, bool $inTightList = false)
    {
        $out = '';

        if ($block instanceof InlineContainerInterface) {
            /** @var iterable<AbstractInline> $children */
            $children = $block->children();
            $out .= $htmlRenderer->renderInlines($children);
        } else {
            /** @var iterable<AbstractBlock> $children */
            $children = $block->children();
            $out .= $htmlRenderer->renderBlocks($children);
        }

        if (!($block instanceof Document)) {
            $out .= "\n";
        }

        return $out;
    }
}
