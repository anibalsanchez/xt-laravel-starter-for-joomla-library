<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Laravel\Ui;

use Extly\Illuminate\Console\Command;
use Extly\Illuminate\Filesystem\Filesystem;
use Extly\Illuminate\Support\Str;
use Extly\Symfony\Component\Finder\SplFileInfo;

class ControllersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ui:controllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold the authentication controllers';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (! is_dir($directory = XT_app_path('Http/Controllers/Auth'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem;

        XT_collect($filesystem->allFiles(__DIR__.'/../stubs/Auth'))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    XT_app_path('Http/Controllers/Auth/'.Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });

        $this->info('Authentication scaffolding generated successfully.');
    }
}
