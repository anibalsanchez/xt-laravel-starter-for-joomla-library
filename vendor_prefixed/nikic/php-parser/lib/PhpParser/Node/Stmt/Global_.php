<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Stmt;

use Extly\PhpParser\Node;

class Global_ extends Node\Stmt
{
    /** @var Node\Expr[] Variables */
    public $vars;

    /**
     * Constructs a global variables list node.
     *
     * @param Node\Expr[] $vars       Variables to unset
     * @param array       $attributes Additional attributes
     */
    public function __construct(array $vars, array $attributes = []) {
        $this->attributes = $attributes;
        $this->vars = $vars;
    }

    public function getSubNodeNames() : array {
        return ['vars'];
    }
    
    public function getType() : string {
        return 'Stmt_Global';
    }
}
