<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Validation\Rules;

use Extly\Illuminate\Support\Traits\Conditionable;

class Exists
{
    use Conditionable, DatabaseRule;

    /**
     * Ignore soft deleted models during the existence check.
     *
     * @param  string  $deletedAtColumn
     * @return $this
     */
    public function withoutTrashed($deletedAtColumn = 'deleted_at')
    {
        $this->whereNull($deletedAtColumn);

        return $this;
    }

    /**
     * Convert the rule to a validation string.
     *
     * @return string
     */
    public function __toString()
    {
        return rtrim(sprintf('exists:%s,%s,%s',
            $this->table,
            $this->column,
            $this->formatWheres()
        ), ',');
    }
}
