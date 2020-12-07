<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

namespace Extly\Dotenv\Repository;

interface RepositoryInterface
{
    /**
     * Determine if the given environment variable is defined.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name);

    /**
     * Get an environment variable.
     *
     * @param string $name
     *
     * @return string|null
     */
    public function get(string $name);

    /**
     * Set an environment variable.
     *
     * @param string $name
     * @param string $value
     *
     * @return bool
     */
    public function set(string $name, string $value);

    /**
     * Clear an environment variable.
     *
     * @param string $name
     *
     * @return bool
     */
    public function clear(string $name);
}
