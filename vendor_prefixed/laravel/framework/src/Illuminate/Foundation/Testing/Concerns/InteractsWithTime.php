<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Foundation\Testing\Concerns;

use DateTimeInterface;
use Extly\Illuminate\Foundation\Testing\Wormhole;
use Extly\Illuminate\Support\Carbon;

trait InteractsWithTime
{
    /**
     * Begin travelling to another time.
     *
     * @param  int  $value
     * @return \Illuminate\Foundation\Testing\Wormhole
     */
    public function travel($value)
    {
        return new Wormhole($value);
    }

    /**
     * Travel to another time.
     *
     * @param  \DateTimeInterface  $date
     * @param  callable|null  $callback
     * @return mixed
     */
    public function travelTo(DateTimeInterface $date, $callback = null)
    {
        Carbon::setTestNow($date);

        if ($callback) {
            return XT_tap($callback(), function () {
                Carbon::setTestNow();
            });
        }
    }

    /**
     * Travel back to the current time.
     *
     * @return \DateTimeInterface
     */
    public function travelBack()
    {
        return Wormhole::back();
    }
}
