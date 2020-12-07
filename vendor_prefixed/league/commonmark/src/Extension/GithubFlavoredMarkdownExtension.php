<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension;

use Extly\League\CommonMark\ConfigurableEnvironmentInterface;
use Extly\League\CommonMark\Extension\Autolink\AutolinkExtension;
use Extly\League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
use Extly\League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use Extly\League\CommonMark\Extension\Table\TableExtension;
use Extly\League\CommonMark\Extension\TaskList\TaskListExtension;

final class GithubFlavoredMarkdownExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new DisallowedRawHtmlExtension());
        $environment->addExtension(new StrikethroughExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new TaskListExtension());
    }
}
