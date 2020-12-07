<?php /* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 * (c) Rezo Zero / Ambroise Maupate
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Extly\League\CommonMark\Extension\Footnote\Renderer;

use Extly\League\CommonMark\ElementRendererInterface;
use Extly\League\CommonMark\Extension\Footnote\Node\FootnoteBackref;
use Extly\League\CommonMark\HtmlElement;
use Extly\League\CommonMark\Inline\Element\AbstractInline;
use Extly\League\CommonMark\Inline\Renderer\InlineRendererInterface;
use Extly\League\CommonMark\Util\ConfigurationAwareInterface;
use Extly\League\CommonMark\Util\ConfigurationInterface;

final class FootnoteBackrefRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    /** @var ConfigurationInterface */
    private $config;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof FootnoteBackref)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . \get_class($inline));
        }

        $attrs = $inline->getData('attributes', []);
        $attrs['class'] = $attrs['class'] ?? $this->config->get('footnote/backref_class', 'footnote-backref');
        $attrs['rev'] = 'footnote';
        $attrs['href'] = \mb_strtolower($inline->getReference()->getDestination());
        $attrs['role'] = 'doc-backlink';

        return '&nbsp;' . new HtmlElement('a', $attrs, '&#8617;', true);
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->config = $configuration;
    }
}
