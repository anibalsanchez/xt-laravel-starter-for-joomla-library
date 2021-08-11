<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Extension\DefaultAttributes;

use Extly\League\CommonMark\Environment\EnvironmentBuilderInterface;
use Extly\League\CommonMark\Event\DocumentParsedEvent;
use Extly\League\CommonMark\Extension\ConfigurableExtensionInterface;
use Extly\League\Config\ConfigurationBuilderInterface;
use Extly\Nette\Schema\Expect;

final class DefaultAttributesExtension implements ConfigurableExtensionInterface
{
    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('default_attributes', Expect::arrayOf(
            Expect::arrayOf(
                Expect::type('string|string[]|bool|callable'), // attribute value(s)
                'string' // attribute name
            ),
            'string' // node FQCN
        )->default([]));
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(DocumentParsedEvent::class, [new ApplyDefaultAttributesProcessor(), 'onDocumentParsed']);
    }
}
