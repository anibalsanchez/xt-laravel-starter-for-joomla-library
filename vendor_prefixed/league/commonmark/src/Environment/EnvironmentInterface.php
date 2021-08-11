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

namespace Extly\League\CommonMark\Environment;

use Extly\League\CommonMark\Delimiter\Processor\DelimiterProcessorCollection;
use Extly\League\CommonMark\Extension\ExtensionInterface;
use Extly\League\CommonMark\Node\Node;
use Extly\League\CommonMark\Normalizer\TextNormalizerInterface;
use Extly\League\CommonMark\Parser\Block\BlockStartParserInterface;
use Extly\League\CommonMark\Parser\Inline\InlineParserInterface;
use Extly\League\CommonMark\Renderer\NodeRendererInterface;
use Extly\League\Config\ConfigurationProviderInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

interface EnvironmentInterface extends ConfigurationProviderInterface, EventDispatcherInterface
{
    /**
     * Get all registered extensions
     *
     * @return ExtensionInterface[]
     */
    public function getExtensions(): iterable;

    /**
     * @return iterable<BlockStartParserInterface>
     */
    public function getBlockStartParsers(): iterable;

    /**
     * @return iterable<InlineParserInterface>
     */
    public function getInlineParsers(): iterable;

    public function getDelimiterProcessors(): DelimiterProcessorCollection;

    /**
     * @psalm-param class-string<Node> $nodeClass
     *
     * @return iterable<NodeRendererInterface>
     */
    public function getRenderersForClass(string $nodeClass): iterable;

    public function getSlugNormalizer(): TextNormalizerInterface;
}
