<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

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
use Extly\League\CommonMark\Inline\Element\AbstractInline;

interface MentionGeneratorInterface
{
    /**
     * @param Mention $mention
     *
     * @return AbstractInline|null
     */
    public function generateMention(Mention $mention): ?AbstractInline;
}
