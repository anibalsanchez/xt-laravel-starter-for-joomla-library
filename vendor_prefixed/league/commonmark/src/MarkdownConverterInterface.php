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

namespace Extly\League\CommonMark;

use Extly\League\CommonMark\Output\RenderedContentInterface;

/**
 * Interface for a service which converts Markdown to HTML.
 */
interface MarkdownConverterInterface
{
    /**
     * Converts Markdown to HTML.
     *
     * @throws \RuntimeException
     */
    public function convertToHtml(string $markdown): RenderedContentInterface;
}
