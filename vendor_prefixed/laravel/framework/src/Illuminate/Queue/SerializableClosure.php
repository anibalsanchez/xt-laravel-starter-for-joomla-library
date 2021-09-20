<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Queue;

use Extly\Opis\Closure\SerializableClosure as OpisSerializableClosure;

class SerializableClosure extends OpisSerializableClosure
{
    use SerializesAndRestoresModelIdentifiers;

    /**
     * Transform the use variables before serialization.
     *
     * @param  array  $data
     * @return array
     */
    protected function transformUseVariables($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->getSerializedPropertyValue($value);
        }

        return $data;
    }

    /**
     * Resolve the use variables after unserialization.
     *
     * @param  array  $data
     * @return array
     */
    protected function resolveUseVariables($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = $this->getRestoredPropertyValue($value);
        }

        return $data;
    }
}
