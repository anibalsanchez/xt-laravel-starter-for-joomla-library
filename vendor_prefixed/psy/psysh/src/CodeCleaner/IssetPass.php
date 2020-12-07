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
use Extly\PhpParser\Node\Expr\ArrayDimFetch;
use Extly\PhpParser\Node\Expr\Isset_;
use Extly\PhpParser\Node\Expr\NullsafePropertyFetch;
use Extly\PhpParser\Node\Expr\PropertyFetch;
use Extly\PhpParser\Node\Expr\Variable;
use Extly\Psy\Exception\FatalErrorException;

/**
 * Code cleaner pass to ensure we only allow variables, array fetch and property
 * fetch expressions in isset() calls.
 */
class IssetPass extends CodeCleanerPass
{
    const EXCEPTION_MSG = 'Cannot use isset() on the result of an expression (you can use "null !== expression" instead)';

    /**
     * @throws FatalErrorException
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Isset_) {
            return;
        }

        foreach ($node->vars as $var) {
            if (!$var instanceof Variable && !$var instanceof ArrayDimFetch && !$var instanceof PropertyFetch && !$var instanceof NullsafePropertyFetch) {
                throw new FatalErrorException(self::EXCEPTION_MSG, 0, \E_ERROR, null, $node->getLine());
            }
        }
    }
}
