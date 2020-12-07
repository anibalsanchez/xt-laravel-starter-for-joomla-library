<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

namespace Extly\Dotenv\Repository\Adapter;

interface ReaderInterface
{
    /**
     * Read an environment variable, if it exists.
     *
     * @param string $name
     *
     * @return \PhpOption\Option<string>
     */
    public function read(string $name);
}
