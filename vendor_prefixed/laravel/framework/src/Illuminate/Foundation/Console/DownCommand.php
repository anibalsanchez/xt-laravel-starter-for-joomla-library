<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Foundation\Console;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Exception;
use Extly\Illuminate\Console\Command;
use Extly\Illuminate\Foundation\Events\MaintenanceModeEnabled;
use Extly\Illuminate\Foundation\Exceptions\RegisterErrorViewPaths;
use Throwable;

class DownCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'down {--redirect= : The path that users should be redirected to}
                                 {--render= : The view that should be prerendered for display during maintenance mode}
                                 {--retry= : The number of seconds after which the request may be retried}
                                 {--refresh= : The number of seconds after which the browser may refresh}
                                 {--secret= : The secret phrase that may be used to bypass maintenance mode}
                                 {--status=503 : The status code that should be used when returning the maintenance mode response}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put the application into maintenance / demo mode';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            if (is_file(XT_storage_path('framework/down'))) {
                $this->comment('Application is already down.');

                return 0;
            }

            file_put_contents(
                XT_storage_path('framework/down'),
                json_encode($this->getDownFilePayload(), JSON_PRETTY_PRINT)
            );

            file_put_contents(
                XT_storage_path('framework/maintenance.php'),
                file_get_contents(__DIR__.'/stubs/maintenance-mode.stub')
            );

            $this->laravel->get('events')->dispatch(MaintenanceModeEnabled::class);

            $this->comment('Application is now in maintenance mode.');
        } catch (Exception $e) {
            $this->error('Failed to enter maintenance mode.');

            $this->error($e->getMessage());

            return 1;
        }
    }

    /**
     * Get the payload to be placed in the "down" file.
     *
     * @return array
     */
    protected function getDownFilePayload()
    {
        return [
            'except' => $this->excludedPaths(),
            'XT_redirect' => $this->redirectPath(),
            'retry' => $this->getRetryTime(),
            'refresh' => $this->option('refresh'),
            'secret' => $this->option('secret'),
            'status' => (int) $this->option('status', 503),
            'template' => $this->option('render') ? $this->prerenderView() : null,
        ];
    }

    /**
     * Get the paths that should be excluded from maintenance mode.
     *
     * @return array
     */
    protected function excludedPaths()
    {
        try {
            return $this->laravel->make(PreventRequestsDuringMaintenance::class)->getExcludedPaths();
        } catch (Throwable $e) {
            return [];
        }
    }

    /**
     * Get the path that users should be redirected to.
     *
     * @return string
     */
    protected function redirectPath()
    {
        if ($this->option('XT_redirect') && $this->option('XT_redirect') !== '/') {
            return '/'.trim($this->option('XT_redirect'), '/');
        }

        return $this->option('XT_redirect');
    }

    /**
     * Prerender the specified view so that it can be rendered even before loading Composer.
     *
     * @return string
     */
    protected function prerenderView()
    {
        (new RegisterErrorViewPaths)();

        return XT_view($this->option('render'), [
            'retryAfter' => $this->option('retry'),
        ])->render();
    }

    /**
     * Get the number of seconds the client should wait before retrying their request.
     *
     * @return int|null
     */
    protected function getRetryTime()
    {
        $retry = $this->option('retry');

        return is_numeric($retry) && $retry > 0 ? (int) $retry : null;
    }
}
