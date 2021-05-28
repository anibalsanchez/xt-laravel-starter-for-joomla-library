<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Stmt;

use Extly\PhpParser\Node;

class Echo_ extends Node\Stmt
{
    /** @var Node\Expr[] Expressions */
    public $exprs;

    /**
     * Constructs an echo node.
     *
     * @param Node\Expr[] $exprs      Expressions
     * @param array       $attributes Additional attributes
     */
    public function __construct(array $exprs, array $attributes = []) {
        $this->attributes = $attributes;
        $this->exprs = $exprs;
    }

    public function getSubNodeNames() : array {
        return ['exprs'];
    }
    
    public function getType() : string {
        return 'Stmt_Echo';
    }
}
