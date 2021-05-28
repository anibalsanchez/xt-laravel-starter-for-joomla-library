<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Testing;

use Extly\Illuminate\Contracts\Support\DeferrableProvider;
use Extly\Illuminate\Support\ServiceProvider;
use Extly\Illuminate\Testing\Concerns\TestDatabases;

class ParallelTestingServiceProvider extends ServiceProvider implements DeferrableProvider
{
    use TestDatabases;

    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootTestDatabase();
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->app->singleton(ParallelTesting::class, function () {
                return new ParallelTesting($this->app);
            });
        }
    }
}
