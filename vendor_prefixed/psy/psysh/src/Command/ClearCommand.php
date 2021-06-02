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

use Extly\Symfony\Component\Console\Input\InputInterface;
use Extly\Symfony\Component\Console\Output\OutputInterface;

/**
 * Clear the Psy Shell.
 *
 * Just what it says on the tin.
 */
class ClearCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('clear')
            ->setDefinition([])
            ->setDescription('Clear the Psy Shell screen.')
            ->setHelp(
                <<<'HELP'
Clear the Psy Shell screen.

Pro Tip: If your PHP has readline support, you should be able to use ctrl+l too!
HELP
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write(\sprintf('%c[2J%c[0;0f', 27, 27));

        return 0;
    }
}