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
use Extly\PhpParser\Node\Expr;
use Extly\PhpParser\Node\Expr\Array_;
use Extly\PhpParser\Node\Expr\ArrayDimFetch;
use Extly\PhpParser\Node\Expr\ArrayItem;
use Extly\PhpParser\Node\Expr\Assign;
use Extly\PhpParser\Node\Expr\FuncCall;
use Extly\PhpParser\Node\Expr\List_;
use Extly\PhpParser\Node\Expr\MethodCall;
use Extly\PhpParser\Node\Expr\PropertyFetch;
use Extly\PhpParser\Node\Expr\Variable;
use Extly\Psy\Exception\ParseErrorException;

/**
 * Validate that the list assignment.
 */
class ListPass extends CodeCleanerPass
{
    private $atLeastPhp71;

    public function __construct()
    {
        $this->atLeastPhp71 = \version_compare(\PHP_VERSION, '7.1', '>=');
    }

    /**
     * Validate use of list assignment.
     *
     * @throws ParseErrorException if the user used empty with anything but a variable
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Assign) {
            return;
        }

        if (!$node->var instanceof Array_ && !$node->var instanceof List_) {
            return;
        }

        if (!$this->atLeastPhp71 && $node->var instanceof Array_) {
            $msg = "syntax error, unexpected '='";
            throw new ParseErrorException($msg, $node->expr->getLine());
        }

        // Polyfill for PHP-Parser 2.x
        $items = isset($node->var->items) ? $node->var->items : $node->var->vars;

        if ($items === [] || $items === [null]) {
            throw new ParseErrorException('Cannot use empty list', $node->var->getLine());
        }

        $itemFound = false;
        foreach ($items as $item) {
            if ($item === null) {
                continue;
            }

            $itemFound = true;

            // List_->$vars in PHP-Parser 2.x is Variable instead of ArrayItem.
            if (!$this->atLeastPhp71 && $item instanceof ArrayItem && $item->key !== null) {
                $msg = 'Syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting \',\' or \')\'';
                throw new ParseErrorException($msg, $item->key->getLine());
            }

            if (!self::isValidArrayItem($item)) {
                $msg = 'Assignments can only happen to writable values';
                throw new ParseErrorException($msg, $item->getLine());
            }
        }

        if (!$itemFound) {
            throw new ParseErrorException('Cannot use empty list');
        }
    }

    /**
     * Validate whether a given item in an array is valid for short assignment.
     *
     * @param Expr $item
     *
     * @return bool
     */
    private static function isValidArrayItem(Expr $item)
    {
        $value = ($item instanceof ArrayItem) ? $item->value : $item;

        while ($value instanceof ArrayDimFetch || $value instanceof PropertyFetch) {
            $value = $value->var;
        }

        // We just kind of give up if it's a method call. We can't tell if it's
        // valid via static analysis.
        return $value instanceof Variable || $value instanceof MethodCall || $value instanceof FuncCall;
    }
}