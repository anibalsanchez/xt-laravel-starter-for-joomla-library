<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Testing\Fluent\Concerns;

trait Debugging
{
    /**
     * Dumps the given props.
     *
     * @param  string|null  $prop
     * @return $this
     */
    public function dump(string $prop = null): self
    {
        XT_dump($this->prop($prop));

        return $this;
    }

    /**
     * Dumps the given props and exits.
     *
     * @param  string|null  $prop
     * @return void
     */
    public function dd(string $prop = null): void
    {
        dd($this->prop($prop));
    }

    /**
     * Retrieve a prop within the current scope using "dot" notation.
     *
     * @param  string|null  $key
     * @return mixed
     */
    abstract protected function prop(string $key = null);
}
