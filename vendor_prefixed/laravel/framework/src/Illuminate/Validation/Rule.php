<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Validation;

use Extly\Illuminate\Contracts\Support\Arrayable;
use Extly\Illuminate\Support\Traits\Macroable;
use Extly\Illuminate\Validation\Rules\Dimensions;
use Extly\Illuminate\Validation\Rules\Exists;
use Extly\Illuminate\Validation\Rules\In;
use Extly\Illuminate\Validation\Rules\NotIn;
use Extly\Illuminate\Validation\Rules\RequiredIf;
use Extly\Illuminate\Validation\Rules\Unique;

class Rule
{
    use Macroable;

    /**
     * Get a dimensions constraint builder instance.
     *
     * @param  array  $constraints
     * @return \Illuminate\Validation\Rules\Dimensions
     */
    public static function dimensions(array $constraints = [])
    {
        return new Dimensions($constraints);
    }

    /**
     * Get an exists constraint builder instance.
     *
     * @param  string  $table
     * @param  string  $column
     * @return \Illuminate\Validation\Rules\Exists
     */
    public static function exists($table, $column = 'NULL')
    {
        return new Exists($table, $column);
    }

    /**
     * Get an in constraint builder instance.
     *
     * @param  \Illuminate\Contracts\Support\Arrayable|array|string  $values
     * @return \Illuminate\Validation\Rules\In
     */
    public static function in($values)
    {
        if ($values instanceof Arrayable) {
            $values = $values->toArray();
        }

        return new In(is_array($values) ? $values : func_get_args());
    }

    /**
     * Get a not_in constraint builder instance.
     *
     * @param  \Illuminate\Contracts\Support\Arrayable|array|string  $values
     * @return \Illuminate\Validation\Rules\NotIn
     */
    public static function notIn($values)
    {
        if ($values instanceof Arrayable) {
            $values = $values->toArray();
        }

        return new NotIn(is_array($values) ? $values : func_get_args());
    }

    /**
     * Get a required_if constraint builder instance.
     *
     * @param  callable|bool  $callback
     * @return \Illuminate\Validation\Rules\RequiredIf
     */
    public static function requiredIf($callback)
    {
        return new RequiredIf($callback);
    }

    /**
     * Get a unique constraint builder instance.
     *
     * @param  string  $table
     * @param  string  $column
     * @return \Illuminate\Validation\Rules\Unique
     */
    public static function unique($table, $column = 'NULL')
    {
        return new Unique($table, $column);
    }
}
