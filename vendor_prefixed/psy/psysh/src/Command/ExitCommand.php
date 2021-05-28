<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2020 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Psy\Command;

use Extly\Psy\Exception\BreakException;
use Extly\Symfony\Component\Console\Input\InputInterface;
use Extly\Symfony\Component\Console\Output\OutputInterface;

/**
 * Exit the Psy Shell.
 *
 * Just what it says on the tin.
 */
class ExitCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('exit')
            ->setAliases(['quit', 'q'])
            ->setDefinition([])
            ->setDescription('End the current session and return to caller.')
            ->setHelp(
                <<<'HELP'
End the current session and return to caller.

e.g.
<return>>>> exit</return>
HELP
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        throw new BreakException('Goodbye');
    }
}
