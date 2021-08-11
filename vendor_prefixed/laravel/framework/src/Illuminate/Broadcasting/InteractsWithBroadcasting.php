<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Broadcasting;

use Extly\Illuminate\Support\Arr;

trait InteractsWithBroadcasting
{
    /**
     * The broadcaster connection to use to broadcast the event.
     *
     * @var array
     */
    protected $broadcastConnection = [null];

    /**
     * Broadcast the event using a specific broadcaster.
     *
     * @param  array|string|null  $connection
     * @return $this
     */
    public function broadcastVia($connection = null)
    {
        $this->broadcastConnection = is_null($connection)
                        ? [null]
                        : Arr::wrap($connection);

        return $this;
    }

    /**
     * Get the broadcaster connections the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastConnections()
    {
        return $this->broadcastConnection;
    }
}
