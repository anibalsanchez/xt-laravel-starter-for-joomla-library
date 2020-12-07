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

namespace Extly\Symfony\Component\HttpKernel\DependencyInjection;

use Extly\Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Extly\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Extly\Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Extly\Symfony\Component\DependencyInjection\ContainerBuilder;
use Extly\Symfony\Component\DependencyInjection\Reference;
use Extly\Symfony\Component\HttpKernel\Controller\ArgumentResolver\TraceableValueResolver;
use Extly\Symfony\Component\Stopwatch\Stopwatch;

/**
 * Gathers and configures the argument value resolvers.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
class ControllerArgumentValueResolverPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    private $argumentResolverService;
    private $argumentValueResolverTag;
    private $traceableResolverStopwatch;

    public function __construct(string $argumentResolverService = 'argument_resolver', string $argumentValueResolverTag = 'controller.argument_value_resolver', string $traceableResolverStopwatch = 'debug.stopwatch')
    {
        $this->argumentResolverService = $argumentResolverService;
        $this->argumentValueResolverTag = $argumentValueResolverTag;
        $this->traceableResolverStopwatch = $traceableResolverStopwatch;
    }

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->argumentResolverService)) {
            return;
        }

        $resolvers = $this->findAndSortTaggedServices($this->argumentValueResolverTag, $container);

        if ($container->getParameter('kernel.debug') && class_exists(Stopwatch::class) && $container->has($this->traceableResolverStopwatch)) {
            foreach ($resolvers as $resolverReference) {
                $id = (string) $resolverReference;
                $container->register("debug.$id", TraceableValueResolver::class)
                    ->setDecoratedService($id)
                    ->setArguments([new Reference("debug.$id.inner"), new Reference($this->traceableResolverStopwatch)]);
            }
        }

        $container
            ->getDefinition($this->argumentResolverService)
            ->replaceArgument(1, new IteratorArgument($resolvers))
        ;
    }
}
