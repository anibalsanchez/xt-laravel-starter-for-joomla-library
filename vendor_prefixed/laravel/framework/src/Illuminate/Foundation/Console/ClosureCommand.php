<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

namespace Extly\Illuminate\Foundation\Console;

use Closure;
use Extly\Illuminate\Console\Command;
use ReflectionFunction;
use Extly\Symfony\Component\Console\Input\InputInterface;
use Extly\Symfony\Component\Console\Output\OutputInterface;

class ClosureCommand extends Command
{
    /**
     * The command callback.
     *
     * @var \Closure
     */
    protected $callback;

    /**
     * Create a new command instance.
     *
     * @param  string  $signature
     * @param  \Closure  $callback
     * @return void
     */
    public function __construct($signature, Closure $callback)
    {
        $this->callback = $callback;
        $this->signature = $signature;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputs = array_merge($input->getArguments(), $input->getOptions());

        $parameters = [];

        foreach ((new ReflectionFunction($this->callback))->getParameters() as $parameter) {
            if (isset($inputs[$parameter->getName()])) {
                $parameters[$parameter->getName()] = $inputs[$parameter->getName()];
            }
        }

        return (int) $this->laravel->call(
            $this->callback->bindTo($this, $this), $parameters
        );
    }

    /**
     * Set the description for the command.
     *
     * @param  string  $description
     * @return $this
     */
    public function purpose($description)
    {
        return $this->describe($description);
    }

    /**
     * Set the description for the command.
     *
     * @param  string  $description
     * @return $this
     */
    public function describe($description)
    {
        $this->setDescription($description);

        return $this;
    }
}
