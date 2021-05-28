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

namespace Extly\Psy\Command\ListCommand;

use Extly\Psy\Reflection\ReflectionNamespace;
use Extly\Symfony\Component\Console\Input\InputInterface;

/**
 * Function Enumerator class.
 */
class FunctionEnumerator extends Enumerator
{
    /**
     * {@inheritdoc}
     */
    protected function listItems(InputInterface $input, \Reflector $reflector = null, $target = null)
    {
        // if we have a reflector, ensure that it's a namespace reflector
        if (($target !== null || $reflector !== null) && !$reflector instanceof ReflectionNamespace) {
            return [];
        }

        // only list functions if we are specifically asked
        if (!$input->getOption('functions')) {
            return [];
        }

        if ($input->getOption('user')) {
            $label = 'User Functions';
            $functions = $this->getFunctions('user');
        } elseif ($input->getOption('internal')) {
            $label = 'Internal Functions';
            $functions = $this->getFunctions('internal');
        } else {
            $label = 'Functions';
            $functions = $this->getFunctions();
        }

        $prefix = $reflector === null ? null : \strtolower($reflector->getName()).'\\';
        $functions = $this->prepareFunctions($functions, $prefix);

        if (empty($functions)) {
            return [];
        }

        $ret = [];
        $ret[$label] = $functions;

        return $ret;
    }

    /**
     * Get defined functions.
     *
     * Optionally limit functions to "user" or "internal" functions.
     *
     * @param string|null $type "user" or "internal" (default: both)
     *
     * @return array
     */
    protected function getFunctions($type = null)
    {
        $funcs = \get_defined_functions();

        if ($type) {
            return $funcs[$type];
        } else {
            return \array_merge($funcs['internal'], $funcs['user']);
        }
    }

    /**
     * Prepare formatted function array.
     *
     * @param array  $functions
     * @param string $prefix
     *
     * @return array
     */
    protected function prepareFunctions(array $functions, $prefix = null)
    {
        \natcasesort($functions);

        // My kingdom for a generator.
        $ret = [];

        foreach ($functions as $name) {
            if ($prefix !== null && \strpos(\strtolower($name), $prefix) !== 0) {
                continue;
            }

            if ($this->showItem($name)) {
                try {
                    $ret[$name] = [
                        'name'  => $name,
                        'style' => self::IS_FUNCTION,
                        'value' => $this->presentSignature($name),
                    ];
                } catch (\Exception $e) {
                    // Ignore failures. HHVM does this sometimes for internal functions.
                }
            }
        }

        return $ret;
    }
}
