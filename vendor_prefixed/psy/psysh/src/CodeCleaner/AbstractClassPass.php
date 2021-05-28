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
use Extly\PhpParser\Node\Stmt\Class_;
use Extly\PhpParser\Node\Stmt\ClassMethod;
use Extly\Psy\Exception\FatalErrorException;

/**
 * The abstract class pass handles abstract classes and methods, complaining if there are too few or too many of either.
 */
class AbstractClassPass extends CodeCleanerPass
{
    private $class;
    private $abstractMethods;

    /**
     * @throws FatalErrorException if the node is an abstract function with a body
     *
     * @param Node $node
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Class_) {
            $this->class = $node;
            $this->abstractMethods = [];
        } elseif ($node instanceof ClassMethod) {
            if ($node->isAbstract()) {
                $name = \sprintf('%s::%s', $this->class->name, $node->name);
                $this->abstractMethods[] = $name;

                if ($node->stmts !== null) {
                    $msg = \sprintf('Abstract function %s cannot contain body', $name);
                    throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getLine());
                }
            }
        }
    }

    /**
     * @throws FatalErrorException if the node is a non-abstract class with abstract methods
     *
     * @param Node $node
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof Class_) {
            $count = \count($this->abstractMethods);
            if ($count > 0 && !$node->isAbstract()) {
                $msg = \sprintf(
                    'Class %s contains %d abstract method%s must therefore be declared abstract or implement the remaining methods (%s)',
                    $node->name,
                    $count,
                    ($count === 1) ? '' : 's',
                    \implode(', ', $this->abstractMethods)
                );
                throw new FatalErrorException($msg, 0, \E_ERROR, null, $node->getLine());
            }
        }
    }
}
