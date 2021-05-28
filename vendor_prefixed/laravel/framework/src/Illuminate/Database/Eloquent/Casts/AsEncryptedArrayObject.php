<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Database\Eloquent\Casts;

use Extly\Illuminate\Contracts\Database\Eloquent\Castable;
use Extly\Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Extly\Illuminate\Support\Facades\Crypt;

class AsEncryptedArrayObject implements Castable
{
    /**
     * Get the caster class to use when casting from / to this cast target.
     *
     * @param  array  $arguments
     * @return object|string
     */
    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            public function get($model, $key, $value, $attributes)
            {
                return new ArrayObject(json_decode(Crypt::decryptString($attributes[$key]), true));
            }

            public function set($model, $key, $value, $attributes)
            {
                return [$key => Crypt::encryptString(json_encode($value))];
            }

            public function serialize($model, string $key, $value, array $attributes)
            {
                return $value->getArrayCopy();
            }
        };
    }
}
