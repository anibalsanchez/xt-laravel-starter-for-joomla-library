<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com> and uAfrica.com (http://uafrica.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\Strikethrough;

use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\HtmlElement;
use Extly\League\CommonMark\Inline\Element\AbstractInline;
use Extly\League\CommonMark\Inline\Renderer\InlineRendererInterface;

final class StrikethroughRenderer implements InlineRendererInterface
{
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof Strikethrough)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        return new HtmlElement('del', $inline->getData('attributes', []), $htmlRenderer->renderInlines($inline->children()));
    }
}
