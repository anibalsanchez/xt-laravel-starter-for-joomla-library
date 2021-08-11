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

namespace Extly\League\CommonMark\Extension\HeadingPermalink;

use Extly\League\CommonMark\Environment\EnvironmentBuilderInterface;
use Extly\League\CommonMark\Event\DocumentParsedEvent;
use Extly\League\CommonMark\Extension\ConfigurableExtensionInterface;
use Extly\League\Config\ConfigurationBuilderInterface;
use Extly\Nette\Schema\Expect;

/**
 * Extension which automatically anchor links to heading elements
 */
final class HeadingPermalinkExtension implements ConfigurableExtensionInterface
{
    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('heading_permalink', Expect::structure([
            'min_heading_level' => Expect::int()->min(1)->max(6)->default(1),
            'max_heading_level' => Expect::int()->min(1)->max(6)->default(6),
            'insert' => Expect::anyOf(HeadingPermalinkProcessor::INSERT_BEFORE, HeadingPermalinkProcessor::INSERT_AFTER)->default(HeadingPermalinkProcessor::INSERT_BEFORE),
            'id_prefix' => Expect::string()->default('content'),
            'fragment_prefix' => Expect::string()->default('content'),
            'html_class' => Expect::string()->default('heading-permalink'),
            'title' => Expect::string()->default('Permalink'),
            'symbol' => Expect::string()->default(HeadingPermalinkRenderer::DEFAULT_SYMBOL),
        ]));
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(DocumentParsedEvent::class, new HeadingPermalinkProcessor(), -100);
        $environment->addRenderer(HeadingPermalink::class, new HeadingPermalinkRenderer());
    }
}
