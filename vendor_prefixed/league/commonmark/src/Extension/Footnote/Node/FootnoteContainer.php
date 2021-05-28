<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) Rezo Zero / Ambroise Maupate
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Extly\League\CommonMark\Extension\Footnote\Node;

use Extly\League\CommonMark\Block\Element\AbstractBlock;
use Extly\League\CommonMark\Cursor;

/**
 * @method children() AbstractBlock[]
 */
final class FootnoteContainer extends AbstractBlock
{
    public function canContain(AbstractBlock $block): bool
    {
        return $block instanceof Footnote;
    }

    public function isCode(): bool
    {
        return false;
    }

    public function matchesNextLine(Cursor $cursor): bool
    {
        return false;
    }
}
