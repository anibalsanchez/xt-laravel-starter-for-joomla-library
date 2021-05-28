<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
declare(strict_types=1);

namespace Extly\PhpParser\Node;

use Extly\PhpParser\NodeAbstract;

class UnionType extends NodeAbstract
{
    /** @var (Identifier|Name)[] Types */
    public $types;

    /**
     * Constructs a union type.
     *
     * @param (Identifier|Name)[] $types      Types
     * @param array               $attributes Additional attributes
     */
    public function __construct(array $types, array $attributes = []) {
        $this->attributes = $attributes;
        $this->types = $types;
    }

    public function getSubNodeNames() : array {
        return ['types'];
    }
    
    public function getType() : string {
        return 'UnionType';
    }
}
