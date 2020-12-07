<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2020 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Psy\CodeCleaner;

use Extly\PhpParser\Node;
use Extly\PhpParser\Node\Expr\Variable;
use Extly\Psy\Exception\RuntimeException;

/**
 * Validate that the user input does not reference the `$__psysh__` variable.
 */
class LeavePsyshAlonePass extends CodeCleanerPass
{
    /**
     * Validate that the user input does not reference the `$__psysh__` variable.
     *
     * @throws RuntimeException if the user is messing with $__psysh__
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Variable && $node->name === '__psysh__') {
            throw new RuntimeException('Don\'t mess with $__psysh__; bad things will happen');
        }
    }
}
