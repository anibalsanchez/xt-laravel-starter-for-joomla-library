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
use Extly\Symfony\Component\HttpKernel\Event\ResponseEvent;
use Extly\Symfony\Component\HttpKernel\KernelEvents;

/**
 * ResponseListener fixes the Response headers based on the Request.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final
 */
class ResponseListener implements EventSubscriberInterface
{
    private $charset;

    public function __construct(string $charset)
    {
        $this->charset = $charset;
    }

    /**
     * Filters the Response.
     */
    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $response = $event->getResponse();

        if (null === $response->getCharset()) {
            $response->setCharset($this->charset);
        }

        $response->prepare($event->getRequest());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
