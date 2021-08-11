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

namespace Extly\League\CommonMark\Extension\HeadingPermalink;

use Extly\League\CommonMark\Node\Inline\AbstractInline;

/**
 * Represents an anchor link within a heading
 */
final class HeadingPermalink extends AbstractInline
{
    /** @psalm-readonly */
    private string $slug;

    public function __construct(string $slug)
    {
        parent::__construct();

        $this->slug = $slug;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
