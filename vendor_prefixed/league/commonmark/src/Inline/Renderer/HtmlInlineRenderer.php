<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * Original code based on the CommonMark JS reference parser (https://bitly.com/commonmark-js)
 *  - (c) John MacFarlane
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\League\CommonMark\Inline\Renderer;

use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\EnvironmentInterface;
use Extly\League\CommonMark\Inline\Element\AbstractInline;
use Extly\League\CommonMark\Inline\Element\HtmlInline;
use Extly\League\CommonMark\Util\ConfigurationAwareInterface;
use Extly\League\CommonMark\Util\ConfigurationInterface;

final class HtmlInlineRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    /**
     * @var ConfigurationInterface
     */
    protected $config;

    /**
     * @param HtmlInline               $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return string
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof HtmlInline)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . \get_class($inline));
        }

        if ($this->config->get('html_input') === EnvironmentInterface::HTML_INPUT_STRIP) {
            return '';
        }

        if ($this->config->get('html_input') === EnvironmentInterface::HTML_INPUT_ESCAPE) {
            return \htmlspecialchars($inline->getContent(), \ENT_NOQUOTES);
        }

        return $inline->getContent();
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->config = $configuration;
    }
}
