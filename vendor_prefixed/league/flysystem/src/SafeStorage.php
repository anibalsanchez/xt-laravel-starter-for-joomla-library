<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\League\Flysystem;

final class SafeStorage
{
    /**
     * @var string
     */
    private $hash;

    /**
     * @var array
     */
    protected static $safeStorage = [];

    public function __construct()
    {
        $this->hash = spl_object_hash($this);
        static::$safeStorage[$this->hash] = [];
    }

    public function storeSafely($key, $value)
    {
        static::$safeStorage[$this->hash][$key] = $value;
    }

    public function retrieveSafely($key)
    {
        if (array_key_exists($key, static::$safeStorage[$this->hash])) {
            return static::$safeStorage[$this->hash][$key];
        }
    }

    public function __destruct()
    {
        unset(static::$safeStorage[$this->hash]);
    }
}