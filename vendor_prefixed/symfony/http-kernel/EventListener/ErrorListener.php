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

namespace Extly\Symfony\Component\HttpKernel\EventListener;

use Psr\Log\LoggerInterface;
use Extly\Symfony\Component\Debug\Exception\FlattenException as LegacyFlattenException;
use Extly\Symfony\Component\ErrorHandler\Exception\FlattenException;
use Extly\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Extly\Symfony\Component\HttpFoundation\Request;
use Extly\Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Extly\Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Extly\Symfony\Component\HttpKernel\Event\ResponseEvent;
use Extly\Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Extly\Symfony\Component\HttpKernel\HttpKernelInterface;
use Extly\Symfony\Component\HttpKernel\KernelEvents;
use Extly\Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ErrorListener implements EventSubscriberInterface
{
    protected $controller;
    protected $logger;
    protected $debug;

    public function __construct($controller, LoggerInterface $logger = null, bool $debug = false)
    {
        $this->controller = $controller;
        $this->logger = $logger;
        $this->debug = $debug;
    }

    public function logKernelException(ExceptionEvent $event)
    {
        $e = FlattenException::createFromThrowable($event->getThrowable());

        $this->logException($event->getThrowable(), sprintf('Uncaught PHP Exception %s: "%s" at %s line %s', $e->getClass(), $e->getMessage(), $e->getFile(), $e->getLine()));
    }

    public function onKernelException(ExceptionEvent $event)
    {
        if (null === $this->controller) {
            return;
        }

        $exception = $event->getThrowable();
        $request = $this->duplicateRequest($exception, $event->getRequest());

        try {
            $response = $event->getKernel()->handle($request, HttpKernelInterface::SUB_REQUEST, false);
        } catch (\Exception $e) {
            $f = FlattenException::createFromThrowable($e);

            $this->logException($e, sprintf('Exception thrown when handling an exception (%s: %s at %s line %s)', $f->getClass(), $f->getMessage(), $e->getFile(), $e->getLine()));

            $prev = $e;
            do {
                if ($exception === $wrapper = $prev) {
                    throw $e;
                }
            } while ($prev = $wrapper->getPrevious());

            $prev = new \ReflectionProperty($wrapper instanceof \Exception ? \Exception::class : \Error::class, 'previous');
            $prev->setAccessible(true);
            $prev->setValue($wrapper, $exception);

            throw $e;
        }

        $event->setResponse($response);

        if ($this->debug) {
            $event->getRequest()->attributes->set('_remove_csp_headers', true);
        }
    }

    public function removeCspHeader(ResponseEvent $event): void
    {
        if ($this->debug && $event->getRequest()->attributes->get('_remove_csp_headers', false)) {
            $event->getResponse()->headers->remove('Content-Security-Policy');
        }
    }

    public function onControllerArguments(ControllerArgumentsEvent $event)
    {
        $e = $event->getRequest()->attributes->get('exception');

        if (!$e instanceof \Throwable || false === $k = array_search($e, $event->getArguments(), true)) {
            return;
        }

        $r = new \ReflectionFunction(\Closure::fromCallable($event->getController()));
        $r = $r->getParameters()[$k] ?? null;

        if ($r && (!($r = $r->getType()) instanceof \ReflectionNamedType || \in_array($r->getName(), [FlattenException::class, LegacyFlattenException::class], true))) {
            $arguments = $event->getArguments();
            $arguments[$k] = FlattenException::createFromThrowable($e);
            $event->setArguments($arguments);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER_ARGUMENTS => 'onControllerArguments',
            KernelEvents::EXCEPTION => [
                ['logKernelException', 0],
                ['onKernelException', -128],
            ],
            KernelEvents::RESPONSE => ['removeCspHeader', -128],
        ];
    }

    /**
     * Logs an exception.
     */
    protected function logException(\Throwable $exception, string $message): void
    {
        if (null !== $this->logger) {
            if (!$exception instanceof HttpExceptionInterface || $exception->getStatusCode() >= 500) {
                $this->logger->critical($message, ['exception' => $exception]);
            } else {
                $this->logger->error($message, ['exception' => $exception]);
            }
        }
    }

    /**
     * Clones the request for the exception.
     */
    protected function duplicateRequest(\Throwable $exception, Request $request): Request
    {
        $attributes = [
            '_controller' => $this->controller,
            'exception' => $exception,
            'logger' => $this->logger instanceof DebugLoggerInterface ? $this->logger : null,
        ];
        $request = $request->duplicate(null, null, $attributes);
        $request->setMethod('GET');

        return $request;
    }
}
