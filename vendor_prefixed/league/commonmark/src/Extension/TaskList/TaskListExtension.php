<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\TaskList;

use Extly\League\CommonMark\ConfigurableEnvironmentInterface;
use Extly\League\CommonMark\Extension\ExtensionInterface;

final class TaskListExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment)
    {
        $environment->addInlineParser(new TaskListItemMarkerParser(), 35);
        $environment->addInlineRenderer(TaskListItemMarker::class, new TaskListItemMarkerRenderer());
    }
}
