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

namespace Extly\Symfony\Component\Routing\Loader;

use Extly\Symfony\Component\Config\Loader\FileLoader;
use Extly\Symfony\Component\Config\Resource\FileResource;
use Extly\Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Extly\Symfony\Component\Routing\RouteCollection;

/**
 * PhpFileLoader loads routes from a PHP file.
 *
 * The file must return a RouteCollection instance.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Nicolas grekas <p@tchwork.com>
 * @author Jules Pietri <jules@heahprod.com>
 */
class PhpFileLoader extends FileLoader
{
    /**
     * Loads a PHP file.
     *
     * @param string      $file A PHP file path
     * @param string|null $type The resource type
     *
     * @return RouteCollection A RouteCollection instance
     */
    public function load($file, string $type = null)
    {
        $path = $this->locator->locate($file);
        $this->setCurrentDir(\dirname($path));

        // the closure forbids access to the private scope in the included file
        $loader = $this;
        $load = \Closure::bind(static function ($file) use ($loader) {
            return include $file;
        }, null, ProtectedPhpFileLoader::class);

        $result = $load($path);

        if (\is_object($result) && \is_callable($result)) {
            $collection = $this->callConfigurator($result, $path, $file);
        } else {
            $collection = $result;
        }

        $collection->addResource(new FileResource($path));

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, string $type = null)
    {
        return \is_string($resource) && 'php' === pathinfo($resource, \PATHINFO_EXTENSION) && (!$type || 'php' === $type);
    }

    protected function callConfigurator(callable $result, string $path, string $file): RouteCollection
    {
        $collection = new RouteCollection();

        $result(new RoutingConfigurator($collection, $this, $path, $file));

        return $collection;
    }
}

/**
 * @internal
 */
final class ProtectedPhpFileLoader extends PhpFileLoader
{
}
