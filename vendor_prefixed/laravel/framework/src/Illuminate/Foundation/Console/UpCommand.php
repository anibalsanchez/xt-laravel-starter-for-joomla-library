<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Foundation\Console;

use Exception;
use Extly\Illuminate\Console\Command;
use Extly\Illuminate\Foundation\Events\MaintenanceModeDisabled;

class UpCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bring the application out of maintenance mode';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            if (! is_file(XT_storage_path('framework/down'))) {
                $this->comment('Application is already up.');

                return 0;
            }

            unlink(XT_storage_path('framework/down'));

            if (is_file(XT_storage_path('framework/maintenance.php'))) {
                unlink(XT_storage_path('framework/maintenance.php'));
            }

            $this->laravel->get('events')->dispatch(MaintenanceModeDisabled::class);

            $this->info('Application is now live.');
        } catch (Exception $e) {
            $this->error('Failed to disable maintenance mode.');

            $this->error($e->getMessage());

            return 1;
        }
    }
}
