<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */
/* ===========================================================================
 * Copyright (c) 2018-2021 Zindex Software
 *
 * Licensed under the MIT License
 * =========================================================================== */

namespace Extly\Opis\Closure;


/**
 * Helper class used to indicate a reference to an object
 * @internal
 */
class SelfReference
{
    /**
     * @var string An unique hash representing the object
     */
    public $hash;

    /**
     * Constructor
     *
     * @param string $hash
     */
    public function __construct($hash)
    {
        $this->hash = $hash;
    }
}