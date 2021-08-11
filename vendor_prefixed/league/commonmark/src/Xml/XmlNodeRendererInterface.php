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

namespace Extly\League\CommonMark\Xml;

use Extly\League\CommonMark\Node\Node;

interface XmlNodeRendererInterface
{
    public function getXmlTagName(Node $node): string;

    /**
     * @return array<string, string|int|float|bool>
     *
     * @psalm-return array<string, scalar>
     */
    public function getXmlAttributes(Node $node): array;
}
