<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Extly\League\CommonMark\Extension\FrontMatter\Listener;

use Extly\League\CommonMark\Event\DocumentRenderedEvent;
use Extly\League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;

final class FrontMatterPostRenderListener
{
    public function __invoke(DocumentRenderedEvent $event): void
    {
        if ($event->getOutput()->getDocument()->data->get('front_matter', null) === null) {
            return;
        }

        $frontMatter = $event->getOutput()->getDocument()->data->get('front_matter');

        $event->replaceOutput(new RenderedContentWithFrontMatter(
            $event->getOutput()->getDocument(),
            $event->getOutput()->getContent(),
            $frontMatter
        ));
    }
}
