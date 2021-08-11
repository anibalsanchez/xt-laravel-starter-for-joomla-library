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

namespace Extly\League\CommonMark\Event;

use Extly\League\CommonMark\Node\Block\Document;

/**
 * Event dispatched just before rendering begins
 */
final class DocumentPreRenderEvent extends AbstractEvent
{
    /** @psalm-readonly */
    private Document $document;

    /** @psalm-readonly */
    private string $format;

    public function __construct(Document $document, string $format)
    {
        $this->document = $document;
        $this->format   = $format;
    }

    public function getDocument(): Document
    {
        return $this->document;
    }

    public function getFormat(): string
    {
        return $this->format;
    }
}
