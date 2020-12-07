<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Stmt;

use Extly\PhpParser\Node;

class DeclareDeclare extends Node\Stmt
{
    /** @var Node\Identifier Key */
    public $key;
    /** @var Node\Expr Value */
    public $value;

    /**
     * Constructs a declare key=>value pair node.
     *
     * @param string|Node\Identifier $key        Key
     * @param Node\Expr              $value      Value
     * @param array                  $attributes Additional attributes
     */
    public function __construct($key, Node\Expr $value, array $attributes = []) {
        $this->attributes = $attributes;
        $this->key = \is_string($key) ? new Node\Identifier($key) : $key;
        $this->value = $value;
    }

    public function getSubNodeNames() : array {
        return ['key', 'value'];
    }
    
    public function getType() : string {
        return 'Stmt_DeclareDeclare';
    }
}
