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

use Extly\League\CommonMark\Input\MarkdownInputInterface;
use Extly\League\CommonMark\Node\Block\Document;

/**
 * Event dispatched when the document is about to be parsed
 */
final class DocumentPreParsedEvent extends AbstractEvent
{
    /** @psalm-readonly */
    private Document $document;

    private MarkdownInputInterface $markdown;

    public function __construct(Document $document, MarkdownInputInterface $markdown)
    {
        $this->document = $document;
        $this->markdown = $markdown;
    }

    public function getDocument(): Document
    {
        return $this->document;
    }

    public function getMarkdown(): MarkdownInputInterface
    {
        return $this->markdown;
    }

    public function replaceMarkdown(MarkdownInputInterface $markdownInput): void
    {
        $this->markdown = $markdownInput;
    }
}
