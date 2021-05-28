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
use Extly\League\CommonMark\Cursor;
use Extly\League\CommonMark\Node\Node;

final class TableRow extends AbstractBlock
{
    public function canContain(AbstractBlock $block): bool
    {
        return $block instanceof TableCell;
    }

    public function isCode(): bool
    {
        return false;
    }

    public function matchesNextLine(Cursor $cursor): bool
    {
        return false;
    }

    /**
     * @return AbstractBlock[]
     */
    public function children(): iterable
    {
        return array_filter((array) parent::children(), static function (Node $child): bool {
            return $child instanceof AbstractBlock;
        });
    }
}
