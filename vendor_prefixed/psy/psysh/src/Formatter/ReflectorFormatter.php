<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2020 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Psy\Formatter;

/**
 * Reflector formatter interface.
 */
interface ReflectorFormatter
{
    /**
     * @param \Reflector $reflector
     *
     * @return string
     */
    public static function format(\Reflector $reflector);
}
