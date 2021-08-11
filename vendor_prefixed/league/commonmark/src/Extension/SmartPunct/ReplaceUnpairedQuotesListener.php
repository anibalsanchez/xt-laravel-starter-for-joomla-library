<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\SmartPunct;

use Extly\League\CommonMark\Event\DocumentParsedEvent;
use Extly\League\CommonMark\Node\Inline\AdjacentTextMerger;
use Extly\League\CommonMark\Node\Inline\Text;
use Extly\League\CommonMark\Node\Query;

/**
 * Identifies any lingering Quote nodes that were missing pairs and converts them into Text nodes
 */
final class ReplaceUnpairedQuotesListener
{
    public function __invoke(DocumentParsedEvent $event): void
    {
        $query = (new Query())->where(Query::type(Quote::class));
        foreach ($query->findAll($event->getDocument()) as $quote) {
            \assert($quote instanceof Quote);

            $literal = $quote->getLiteral();
            if ($literal === Quote::SINGLE_QUOTE) {
                $literal = Quote::SINGLE_QUOTE_CLOSER;
            } elseif ($literal === Quote::DOUBLE_QUOTE) {
                $literal = Quote::DOUBLE_QUOTE_OPENER;
            }

            $quote->replaceWith($new = new Text($literal));
            AdjacentTextMerger::mergeWithDirectlyAdjacentNodes($new);
        }
    }
}
