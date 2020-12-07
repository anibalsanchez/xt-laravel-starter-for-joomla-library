<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Broadcasting\Broadcasters;

class NullBroadcaster extends Broadcaster
{
    /**
     * {@inheritdoc}
     */
    public function auth($request)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function validAuthenticationResponse($request, $result)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        //
    }
}
