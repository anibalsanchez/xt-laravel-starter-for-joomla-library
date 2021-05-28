<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\TijsVerkoyen\CssToInlineStyles\Css\Rule;

use Extly\Symfony\Component\CssSelector\Node\Specificity;
use Extly\TijsVerkoyen\CssToInlineStyles\Css\Property\Property;

final class Rule
{
    /**
     * @var string
     */
    private $selector;

    /**
     * @var Property[]
     */
    private $properties;

    /**
     * @var Specificity
     */
    private $specificity;

    /**
     * @var integer
     */
    private $order;

    /**
     * Rule constructor.
     *
     * @param string      $selector
     * @param Property[]  $properties
     * @param Specificity $specificity
     * @param int         $order
     */
    public function __construct($selector, array $properties, Specificity $specificity, $order)
    {
        $this->selector = $selector;
        $this->properties = $properties;
        $this->specificity = $specificity;
        $this->order = $order;
    }

    /**
     * Get selector
     *
     * @return string
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * Get properties
     *
     * @return Property[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Get specificity
     *
     * @return Specificity
     */
    public function getSpecificity()
    {
        return $this->specificity;
    }

    /**
     * Get order
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }
}
