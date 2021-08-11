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

namespace Extly\League\CommonMark\Extension\InlinesOnly;

use Extly\League\CommonMark\Node\Block\Document;
use Extly\League\CommonMark\Node\Node;
use Extly\League\CommonMark\Renderer\ChildNodeRendererInterface;
use Extly\League\CommonMark\Renderer\NodeRendererInterface;

/**
 * Simply renders child elements as-is, adding newlines as needed.
 */
final class ChildRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): string
    {
        $out = $childRenderer->renderNodes($node->children());
        if (! $node instanceof Document) {
            $out .= $childRenderer->getBlockSeparator();
        }

        return $out;
    }
}
