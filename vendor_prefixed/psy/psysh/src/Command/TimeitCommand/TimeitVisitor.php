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

namespace Extly\Psy\Command\TimeitCommand;

use Extly\PhpParser\Node;
use Extly\PhpParser\Node\Arg;
use Extly\PhpParser\Node\Expr;
use Extly\PhpParser\Node\Expr\StaticCall;
use Extly\PhpParser\Node\FunctionLike;
use Extly\PhpParser\Node\Name\FullyQualified as FullyQualifiedName;
use Extly\PhpParser\Node\Stmt\Expression;
use Extly\PhpParser\Node\Stmt\Return_;
use Extly\PhpParser\NodeVisitorAbstract;
use Extly\Psy\CodeCleaner\NoReturnValue;
use Extly\Psy\Command\TimeitCommand;

/**
 * A node visitor for instrumenting code to be executed by the `timeit` command.
 *
 * Injects `TimeitCommand::markStart()` at the start of code to be executed, and
 * `TimeitCommand::markEnd()` at the end, and on top-level return statements.
 */
class TimeitVisitor extends NodeVisitorAbstract
{
    private $functionDepth;

    /**
     * {@inheritdoc}
     */
    public function beforeTraverse(array $nodes)
    {
        $this->functionDepth = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function enterNode(Node $node)
    {
        // keep track of nested function-like nodes, because they can have
        // returns statements... and we don't want to call markEnd for those.
        if ($node instanceof FunctionLike) {
            $this->functionDepth++;

            return;
        }

        // replace any top-level `return` statements with a `markEnd` call
        if ($this->functionDepth === 0 && $node instanceof Return_) {
            return new Return_($this->getEndCall($node->expr), $node->getAttributes());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function leaveNode(Node $node)
    {
        if ($node instanceof FunctionLike) {
            $this->functionDepth--;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterTraverse(array $nodes)
    {
        // prepend a `markStart` call
        \array_unshift($nodes, $this->maybeExpression($this->getStartCall()));

        // append a `markEnd` call (wrapping the final node, if it's an expression)
        $last = $nodes[\count($nodes) - 1];
        if ($last instanceof Expr) {
            \array_pop($nodes);
            $nodes[] = $this->getEndCall($last);
        } elseif ($last instanceof Expression) {
            \array_pop($nodes);
            $nodes[] = new Expression($this->getEndCall($last->expr), $last->getAttributes());
        } elseif ($last instanceof Return_) {
            // nothing to do here, we're already ending with a return call
        } else {
            $nodes[] = $this->maybeExpression($this->getEndCall());
        }

        return $nodes;
    }

    /**
     * Get PhpParser AST nodes for a `markStart` call.
     *
     * @return \PhpParser\Node\Expr\StaticCall
     */
    private function getStartCall()
    {
        return new StaticCall(new FullyQualifiedName(TimeitCommand::class), 'markStart');
    }

    /**
     * Get PhpParser AST nodes for a `markEnd` call.
     *
     * Optionally pass in a return value.
     *
     * @param Expr|null $arg
     *
     * @return \PhpParser\Node\Expr\StaticCall
     */
    private function getEndCall(Expr $arg = null)
    {
        if ($arg === null) {
            $arg = NoReturnValue::create();
        }

        return new StaticCall(new FullyQualifiedName(TimeitCommand::class), 'markEnd', [new Arg($arg)]);
    }

    /**
     * Compatibility shim for PHP Parser 3.x.
     *
     * Wrap $expr in a PhpParser\Node\Stmt\Expression if the class exists.
     *
     * @param \PhpParser\Node $expr
     * @param array           $attrs
     *
     * @return \PhpParser\Node\Expr|\PhpParser\Node\Stmt\Expression
     */
    private function maybeExpression($expr, $attrs = [])
    {
        return \class_exists(Expression::class) ? new Expression($expr, $attrs) : $expr;
    }
}
