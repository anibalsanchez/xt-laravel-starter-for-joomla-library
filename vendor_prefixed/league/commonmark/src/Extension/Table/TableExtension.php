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

use Extly\League\CommonMark\ConfigurableEnvironmentInterface;
use Extly\League\CommonMark\Extension\ExtensionInterface;

final class TableExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment): void
    {
        $environment
            ->addBlockParser(new TableParser())

            ->addBlockRenderer(Table::class, new TableRenderer())
            ->addBlockRenderer(TableSection::class, new TableSectionRenderer())
            ->addBlockRenderer(TableRow::class, new TableRowRenderer())
            ->addBlockRenderer(TableCell::class, new TableCellRenderer())
        ;
    }
}