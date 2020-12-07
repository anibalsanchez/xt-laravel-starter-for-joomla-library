<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node\Expr;

use Extly\PhpParser\Node\Expr;

class Yield_ extends Expr
{
    /** @var null|Expr Key expression */
    public $key;
    /** @var null|Expr Value expression */
    public $value;

    /**
     * Constructs a yield expression node.
     *
     * @param null|Expr $value      Value expression
     * @param null|Expr $key        Key expression
     * @param array     $attributes Additional attributes
     */
    public function __construct(Expr $value = null, Expr $key = null, array $attributes = []) {
        $this->attributes = $attributes;
        $this->key = $key;
        $this->value = $value;
    }

    public function getSubNodeNames() : array {
        return ['key', 'value'];
    }
    
    public function getType() : string {
        return 'Expr_Yield';
    }
}
