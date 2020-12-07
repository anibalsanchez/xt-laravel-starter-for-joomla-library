<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Bus\Events;

use Extly\Illuminate\Bus\Batch;

class BatchDispatched
{
    /**
     * The batch instance.
     *
     * @var \Illuminate\Bus\Batch
     */
    public $batch;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Bus\Batch  $batch
     * @return void
     */
    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }
}
