<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) 2015 Martin Hasoň <martin.hason@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Extly\League\CommonMark\Extension\Attributes\Event;

use Extly\League\CommonMark\Event\DocumentParsedEvent;
use Extly\League\CommonMark\Extension\Attributes\Node\Attributes;
use Extly\League\CommonMark\Extension\Attributes\Node\AttributesInline;
use Extly\League\CommonMark\Extension\Attributes\Util\AttributesHelper;
use Extly\League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use Extly\League\CommonMark\Extension\CommonMark\Node\Block\ListBlock;
use Extly\League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use Extly\League\CommonMark\Node\Inline\AbstractInline;
use Extly\League\CommonMark\Node\Node;

final class AttributesListener
{
    private const DIRECTION_PREFIX = 'prefix';
    private const DIRECTION_SUFFIX = 'suffix';

    public function processDocument(DocumentParsedEvent $event): void
    {
        foreach ($event->getDocument()->iterator() as $node) {
            if (! ($node instanceof Attributes || $node instanceof AttributesInline)) {
                continue;
            }

            [$target, $direction] = self::findTargetAndDirection($node);

            if ($target instanceof Node) {
                $parent = $target->parent();
                if ($parent instanceof ListItem && $parent->parent() instanceof ListBlock && $parent->parent()->isTight()) {
                    $target = $parent;
                }

                if ($direction === self::DIRECTION_SUFFIX) {
                    $attributes = AttributesHelper::mergeAttributes($target, $node->getAttributes());
                } else {
                    $attributes = AttributesHelper::mergeAttributes($node->getAttributes(), $target);
                }

                $target->data->set('attributes', $attributes);
            }

            $node->detach();
        }
    }

    /**
     * @param Attributes|AttributesInline $node
     *
     * @return array<Node|string|null>
     */
    private static function findTargetAndDirection($node): array
    {
        $target    = null;
        $direction = null;
        $previous  = $next = $node;
        while (true) {
            $previous = self::getPrevious($previous);
            $next     = self::getNext($next);

            if ($previous === null && $next === null) {
                if (! $node->parent() instanceof FencedCode) {
                    $target    = $node->parent();
                    $direction = self::DIRECTION_SUFFIX;
                }

                break;
            }

            if ($node instanceof AttributesInline && ($previous === null || ($previous instanceof AbstractInline && $node->isBlock()))) {
                continue;
            }

            if ($previous !== null && ! self::isAttributesNode($previous)) {
                $target    = $previous;
                $direction = self::DIRECTION_SUFFIX;

                break;
            }

            if ($next !== null && ! self::isAttributesNode($next)) {
                $target    = $next;
                $direction = self::DIRECTION_PREFIX;

                break;
            }
        }

        return [$target, $direction];
    }

    /**
     * Get any previous block (sibling or parent) this might apply to
     */
    private static function getPrevious(?Node $node = null): ?Node
    {
        if ($node instanceof Attributes) {
            if ($node->getTarget() === Attributes::TARGET_NEXT) {
                return null;
            }

            if ($node->getTarget() === Attributes::TARGET_PARENT) {
                return $node->parent();
            }
        }

        return $node instanceof Node ? $node->previous() : null;
    }

    /**
     * Get any previous block (sibling or parent) this might apply to
     */
    private static function getNext(?Node $node = null): ?Node
    {
        if ($node instanceof Attributes && $node->getTarget() !== Attributes::TARGET_NEXT) {
            return null;
        }

        return $node instanceof Node ? $node->next() : null;
    }

    private static function isAttributesNode(Node $node): bool
    {
        return $node instanceof Attributes || $node instanceof AttributesInline;
    }
}
