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

namespace Extly\Psy;

/**
 * Abstraction around environment variables.
 */
interface EnvInterface
{
    /**
     * Get an environment variable by name.
     *
     * @return string|null
     */
    public function get($key);
}
