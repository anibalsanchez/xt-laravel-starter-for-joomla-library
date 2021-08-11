<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This file is part of the league/config package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\Config;

use Extly\League\Config\Exception\UnknownOptionException;

/**
 * Interface for setting/merging user-defined configuration values into the configuration object
 */
interface MutableConfigurationInterface
{
    /**
     * @param mixed $value
     *
     * @throws UnknownOptionException if $key contains a nested path which doesn't point to an array value
     */
    public function set(string $key, $value): void;

    /**
     * @param array<string, mixed> $config
     */
    public function merge(array $config = []): void;
}
