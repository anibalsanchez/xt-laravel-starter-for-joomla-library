<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Symfony\Component\HttpKernel\Controller;

use Extly\Symfony\Component\HttpFoundation\Request;
use Extly\Symfony\Component\Stopwatch\Stopwatch;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TraceableArgumentResolver implements ArgumentResolverInterface
{
    private $resolver;
    private $stopwatch;

    public function __construct(ArgumentResolverInterface $resolver, Stopwatch $stopwatch)
    {
        $this->resolver = $resolver;
        $this->stopwatch = $stopwatch;
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments(Request $request, callable $controller)
    {
        $e = $this->stopwatch->start('controller.get_arguments');

        $ret = $this->resolver->getArguments($request, $controller);

        $e->stop();

        return $ret;
    }
}
