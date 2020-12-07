<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Expr;

use Extly\PhpParser\Node\Expr;

class PreDec extends Expr
{
    /** @var Expr Variable */
    public $var;

    /**
     * Constructs a pre decrement node.
     *
     * @param Expr  $var        Variable
     * @param array $attributes Additional attributes
     */
    public function __construct(Expr $var, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
    }

    public function getSubNodeNames() : array {
        return ['var'];
    }

    public function getType() : string {
        return 'Expr_PreDec';
    }
}
