<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Contracts\View;

use Extly\Illuminate\Contracts\Support\Renderable;

interface View extends Renderable
{
    /**
     * Get the name of the view.
     *
     * @return string
     */
    public function name();

    /**
     * Add a piece of data to the view.
     *
     * @param  string|array  $key
     * @param  mixed  $value
     * @return $this
     */
    public function with($key, $value = null);

    /**
     * Get the array of view data.
     *
     * @return array
     */
    public function getData();
}
