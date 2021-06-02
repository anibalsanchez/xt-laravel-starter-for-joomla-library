<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com> and uAfrica.com (http://uafrica.com)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\Strikethrough;

use Extly\League\CommonMark\Inline\Element\AbstractInline;

final class Strikethrough extends AbstractInline
{
    public function isContainer(): bool
    {
        return true;
    }
}