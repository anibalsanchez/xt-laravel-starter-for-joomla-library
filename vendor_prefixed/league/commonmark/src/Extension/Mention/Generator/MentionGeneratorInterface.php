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

namespace Extly\League\CommonMark\Extension\Mention\Generator;

use Extly\League\CommonMark\Extension\Mention\Mention;
use Extly\League\CommonMark\Node\Inline\AbstractInline;

interface MentionGeneratorInterface
{
    public function generateMention(Mention $mention): ?AbstractInline;
}
