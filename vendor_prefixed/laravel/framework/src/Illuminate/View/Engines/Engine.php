<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\View\Engines;

abstract class Engine
{
    /**
     * The view that was last to be rendered.
     *
     * @var string
     */
    protected $lastRendered;

    /**
     * Get the last view that was rendered.
     *
     * @return string
     */
    public function getLastRendered()
    {
        return $this->lastRendered;
    }
}
