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

use Extly\League\CommonMark\Block\Element\HtmlBlock;
use Extly\League\CommonMark\Block\Renderer\HtmlBlockRenderer;
use Extly\League\CommonMark\ConfigurableEnvironmentInterface;
use Extly\League\CommonMark\Extension\ExtensionInterface;
use Extly\League\CommonMark\Inline\Element\HtmlInline;
use Extly\League\CommonMark\Inline\Renderer\HtmlInlineRenderer;

final class DisallowedRawHtmlExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addBlockRenderer(HtmlBlock::class, new DisallowedRawHtmlBlockRenderer(new HtmlBlockRenderer()), 50);
        $environment->addInlineRenderer(HtmlInline::class, new DisallowedRawHtmlInlineRenderer(new HtmlInlineRenderer()), 50);
    }
}
