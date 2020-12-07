<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\TableOfContents\Normalizer;

use Extly\League\CommonMark\Block\Element\ListItem;
use Extly\League\CommonMark\Extension\TableOfContents\Node\TableOfContents;

final class FlatNormalizerStrategy implements NormalizerStrategyInterface
{
    /** @var TableOfContents */
    private $toc;

    public function __construct(TableOfContents $toc)
    {
        $this->toc = $toc;
    }

    public function addItem(int $level, ListItem $listItemToAdd): void
    {
        $this->toc->appendChild($listItemToAdd);
    }
}

// Trigger autoload without causing a deprecated error
\class_exists(TableOfContents::class);
