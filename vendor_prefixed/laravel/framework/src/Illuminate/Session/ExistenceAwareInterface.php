<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Session;

interface ExistenceAwareInterface
{
    /**
     * Set the existence state for the session.
     *
     * @param  bool  $value
     * @return \SessionHandlerInterface
     */
    public function setExists($value);
}
