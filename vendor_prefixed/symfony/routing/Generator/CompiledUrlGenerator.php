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

namespace Extly\Symfony\Component\Routing\Generator;

use Psr\Log\LoggerInterface;
use Extly\Symfony\Component\Routing\Exception\RouteNotFoundException;
use Extly\Symfony\Component\Routing\RequestContext;

/**
 * Generates URLs based on rules dumped by CompiledUrlGeneratorDumper.
 */
class CompiledUrlGenerator extends UrlGenerator
{
    private $compiledRoutes = [];
    private $defaultLocale;

    public function __construct(array $compiledRoutes, RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->compiledRoutes = $compiledRoutes;
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
    }

    public function generate(string $name, array $parameters = [], int $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale) {
            do {
                if (($this->compiledRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset($this->compiledRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        [$variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes] = $this->compiledRoutes[$name];

        if (isset($defaults['_canonical_route']) && isset($defaults['_locale'])) {
            if (!\in_array('_locale', $variables, true)) {
                unset($parameters['_locale']);
            } elseif (!isset($parameters['_locale'])) {
                $parameters['_locale'] = $defaults['_locale'];
            }
        }

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
