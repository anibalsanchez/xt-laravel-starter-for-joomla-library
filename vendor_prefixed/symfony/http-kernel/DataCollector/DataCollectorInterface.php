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

namespace Extly\Symfony\Component\HttpKernel\DataCollector;

use Extly\Symfony\Component\HttpFoundation\Request;
use Extly\Symfony\Component\HttpFoundation\Response;
use Extly\Symfony\Contracts\Service\ResetInterface;

/**
 * DataCollectorInterface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface DataCollectorInterface extends ResetInterface
{
    /**
     * Collects data for the given Request and Response.
     */
    public function collect(Request $request, Response $response, \Throwable $exception = null);

    /**
     * Returns the name of the collector.
     *
     * @return string The collector name
     */
    public function getName();
}
