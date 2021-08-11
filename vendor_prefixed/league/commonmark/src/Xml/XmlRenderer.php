<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

declare(strict_types=1);

namespace Extly\League\CommonMark\Xml;

use Extly\League\CommonMark\Environment\EnvironmentInterface;
use Extly\League\CommonMark\Event\DocumentPreRenderEvent;
use Extly\League\CommonMark\Node\Block\Document;
use Extly\League\CommonMark\Node\Node;
use Extly\League\CommonMark\Node\StringContainerInterface;
use Extly\League\CommonMark\Output\RenderedContent;
use Extly\League\CommonMark\Output\RenderedContentInterface;
use Extly\League\CommonMark\Renderer\MarkdownRendererInterface;
use Extly\League\CommonMark\Util\Xml;

final class XmlRenderer implements MarkdownRendererInterface
{
    private const INDENTATION = '    ';

    private EnvironmentInterface $environment;

    private XmlNodeRendererInterface $fallbackRenderer;

    /** @var array<class-string, XmlNodeRendererInterface> */
    private array $rendererCache = [];

    public function __construct(EnvironmentInterface $environment)
    {
        $this->environment      = $environment;
        $this->fallbackRenderer = new FallbackNodeXmlRenderer();
    }

    public function renderDocument(Document $document): RenderedContentInterface
    {
        $this->environment->dispatch(new DocumentPreRenderEvent($document, 'xml'));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';

        $indent = 0;
        $walker = $document->walker();
        while ($event = $walker->next()) {
            $node = $event->getNode();

            $closeImmediately = ! $node->hasChildren();
            $selfClosing      = $closeImmediately && ! $node instanceof StringContainerInterface;

            $renderer = $this->findXmlRenderer($node);
            $tagName  = $renderer->getXmlTagName($node);

            if ($event->isEntering()) {
                $attrs = $renderer->getXmlAttributes($node);

                $xml .= "\n" . \str_repeat(self::INDENTATION, $indent);
                $xml .= self::tag($tagName, $attrs, $selfClosing);

                if ($node instanceof StringContainerInterface) {
                    $xml .= Xml::escape($node->getLiteral());
                }

                if ($closeImmediately && ! $selfClosing) {
                    $xml .= self::tag('/' . $tagName);
                }

                if (! $closeImmediately && ! $selfClosing) {
                    $indent++;
                }
            } elseif (! $closeImmediately) {
                $indent--;
                $xml .= "\n" . \str_repeat(self::INDENTATION, $indent);
                $xml .= self::tag('/' . $tagName);
            }
        }

        return new RenderedContent($document, $xml . "\n");
    }

    /**
     * @param array<string, string|int|float|bool> $attrs
     */
    private static function tag(string $name, array $attrs = [], bool $selfClosing = \false): string
    {
        $result = '<' . $name;
        foreach ($attrs as $key => $value) {
            $result .= \sprintf(' %s="%s"', $key, self::convertAndEscape($value));
        }

        if ($selfClosing) {
            $result .= ' /';
        }

        $result .= '>';

        return $result;
    }

    /**
     * @param string|int|float|bool $value
     */
    private static function convertAndEscape($value): string
    {
        if (\is_string($value)) {
            return Xml::escape($value);
        }

        if (\is_int($value) || \is_float($value)) {
            return (string) $value;
        }

        if (\is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        // @phpstan-ignore-next-line
        throw new \InvalidArgumentException('$value must be a string, int, float, or bool');
    }

    private function findXmlRenderer(Node $node): XmlNodeRendererInterface
    {
        $class = \get_class($node);

        if (\array_key_exists($class, $this->rendererCache)) {
            return $this->rendererCache[$class];
        }

        foreach ($this->environment->getRenderersForClass($class) as $renderer) {
            if ($renderer instanceof XmlNodeRendererInterface) {
                return $this->rendererCache[$class] = $renderer;
            }
        }

        return $this->rendererCache[$class] = $this->fallbackRenderer;
    }
}
