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

use Extly\Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Extly\Symfony\Component\HttpFoundation\Cookie;
use Extly\Symfony\Component\HttpFoundation\Session\Session;
use Extly\Symfony\Component\HttpFoundation\Session\SessionInterface;
use Extly\Symfony\Component\HttpKernel\Event\RequestEvent;
use Extly\Symfony\Component\HttpKernel\Event\ResponseEvent;
use Extly\Symfony\Component\HttpKernel\KernelEvents;

/**
 * TestSessionListener.
 *
 * Saves session in test environment.
 *
 * @author Bulat Shakirzyanov <mallluhuct@gmail.com>
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @internal
 */
abstract class AbstractTestSessionListener implements EventSubscriberInterface
{
    private $sessionId;
    private $sessionOptions;

    public function __construct(array $sessionOptions = [])
    {
        $this->sessionOptions = $sessionOptions;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        if (!$event->isMainRequest()) {
            return;
        }

        // bootstrap the session
        if (!$session = $this->getSession()) {
            return;
        }

        $cookies = $event->getRequest()->cookies;

        if ($cookies->has($session->getName())) {
            $this->sessionId = $cookies->get($session->getName());
            $session->setId($this->sessionId);
        }
    }

    /**
     * Checks if session was initialized and saves if current request is the main request
     * Runs on 'kernel.response' in test environment.
     */
    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        if (!$request->hasSession()) {
            return;
        }

        $session = $request->getSession();
        if ($wasStarted = $session->isStarted()) {
            $session->save();
        }

        if ($session instanceof Session ? !$session->isEmpty() || (null !== $this->sessionId && $session->getId() !== $this->sessionId) : $wasStarted) {
            $params = session_get_cookie_params() + ['samesite' => null];
            foreach ($this->sessionOptions as $k => $v) {
                if (0 === strpos($k, 'cookie_')) {
                    $params[substr($k, 7)] = $v;
                }
            }

            foreach ($event->getResponse()->headers->getCookies() as $cookie) {
                if ($session->getName() === $cookie->getName() && $params['path'] === $cookie->getPath() && $params['domain'] == $cookie->getDomain()) {
                    return;
                }
            }

            $event->getResponse()->headers->setCookie(new Cookie($session->getName(), $session->getId(), 0 === $params['lifetime'] ? 0 : time() + $params['lifetime'], $params['path'], $params['domain'], $params['secure'], $params['httponly'], false, $params['samesite'] ?: null));
            $this->sessionId = $session->getId();
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 192],
            KernelEvents::RESPONSE => ['onKernelResponse', -128],
        ];
    }

    /**
     * Gets the session object.
     *
     * @return SessionInterface|null A SessionInterface instance or null if no session is available
     */
    abstract protected function getSession();
}
