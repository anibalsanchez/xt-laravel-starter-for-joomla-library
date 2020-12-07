<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\HeadingPermalink;

use Extly\League\CommonMark\Inline\Element\AbstractInline;

/**
 * Represents an anchor link within a heading
 */
final class HeadingPermalink extends AbstractInline
{
    /** @var string */
    private $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
