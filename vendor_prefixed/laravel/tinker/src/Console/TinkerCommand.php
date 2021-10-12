<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Laravel\Tinker\Console;

use Extly\Illuminate\Console\Command;
use Extly\Illuminate\Support\Env;
use Extly\Laravel\Tinker\ClassAliasAutoloader;
use Extly\Psy\Configuration;
use Extly\Psy\Shell;
use Extly\Psy\VersionUpdater\Checker;
use Extly\Symfony\Component\Console\Input\InputArgument;
use Extly\Symfony\Component\Console\Input\InputOption;

class TinkerCommand extends Command
{
    /**
     * Artisan commands to include in the tinker shell.
     *
     * @var array
     */
    protected $commandWhitelist = [
        'clear-compiled', 'down', 'env', 'inspire', 'migrate', 'optimize', 'up',
    ];

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tinker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interact with your application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getApplication()->setCatchExceptions(false);

        $config = Configuration::fromInput($this->input);
        $config->setUpdateCheck(Checker::NEVER);

        $config->getPresenter()->addCasters(
            $this->getCasters()
        );

        $shell = new Shell($config);
        $shell->addCommands($this->getCommands());
        $shell->setIncludes($this->argument('include'));

        $path = Env::get('COMPOSER_VENDOR_DIR', $this->getLaravel()->basePath().DIRECTORY_SEPARATOR.'vendor');

        $path .= '/composer/autoload_classmap.php';

        $config = $this->getLaravel()->make('config');

        $loader = ClassAliasAutoloader::register(
            $shell, $path, $config->get('tinker.alias', []), $config->get('tinker.dont_alias', [])
        );

        if ($code = $this->option('execute')) {
            try {
                $shell->setOutput($this->output);
                $shell->execute($code);
            } finally {
                $loader->unregister();
            }

            return 0;
        }

        try {
            return $shell->run();
        } finally {
            $loader->unregister();
        }
    }

    /**
     * Get artisan commands to pass through to PsySH.
     *
     * @return array
     */
    protected function getCommands()
    {
        $commands = [];

        foreach ($this->getApplication()->all() as $name => $command) {
            if (in_array($name, $this->commandWhitelist)) {
                $commands[] = $command;
            }
        }

        $config = $this->getLaravel()->make('config');

        foreach ($config->get('tinker.commands', []) as $command) {
            $commands[] = $this->getApplication()->resolve($command);
        }

        return $commands;
    }

    /**
     * Get an array of Laravel tailored casters.
     *
     * @return array
     */
    protected function getCasters()
    {
        $casters = [
            'Extly\Illuminate\Support\Collection' => 'Extly\Laravel\Tinker\TinkerCaster::castCollection',
            'Extly\Illuminate\Support\HtmlString' => 'Extly\Laravel\Tinker\TinkerCaster::castHtmlString',
            'Extly\Illuminate\Support\Stringable' => 'Extly\Laravel\Tinker\TinkerCaster::castStringable',
        ];

        if (class_exists('Extly\Illuminate\Database\Eloquent\Model')) {
            $casters['Extly\Illuminate\Database\Eloquent\Model'] = 'Extly\Laravel\Tinker\TinkerCaster::castModel';
        }

        if (class_exists('Extly\Illuminate\Foundation\Application')) {
            $casters['Extly\Illuminate\Foundation\Application'] = 'Extly\Laravel\Tinker\TinkerCaster::castApplication';
        }

        $config = $this->getLaravel()->make('config');

        return array_merge($casters, (array) $config->get('tinker.casters', []));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['include', InputArgument::IS_ARRAY, 'Include file(s) before starting tinker'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['execute', null, InputOption::VALUE_OPTIONAL, 'Execute the given code using Tinker'],
        ];
    }
}
