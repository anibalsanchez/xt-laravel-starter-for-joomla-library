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

namespace Extly\Symfony\Component\Translation\Loader;

use Extly\Symfony\Component\Config\Resource\FileResource;
use Extly\Symfony\Component\Config\Util\XmlUtils;
use Extly\Symfony\Component\Translation\Exception\InvalidResourceException;
use Extly\Symfony\Component\Translation\Exception\NotFoundResourceException;
use Extly\Symfony\Component\Translation\Exception\RuntimeException;
use Extly\Symfony\Component\Translation\MessageCatalogue;

/**
 * QtFileLoader loads translations from QT Translations XML files.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 */
class QtFileLoader implements LoaderInterface
{
    /**
     * {@inheritdoc}
     */
    public function load($resource, string $locale, string $domain = 'messages')
    {
        if (!class_exists(XmlUtils::class)) {
            throw new RuntimeException('Loading translations from the QT format requires the Symfony Config component.');
        }

        if (!stream_is_local($resource)) {
            throw new InvalidResourceException(sprintf('This is not a local file "%s".', $resource));
        }

        if (!file_exists($resource)) {
            throw new NotFoundResourceException(sprintf('File "%s" not found.', $resource));
        }

        try {
            $dom = XmlUtils::loadFile($resource);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidResourceException(sprintf('Unable to load "%s".', $resource), $e->getCode(), $e);
        }

        $internalErrors = libxml_use_internal_errors(true);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->evaluate('//TS/context/name[text()="'.$domain.'"]');

        $catalogue = new MessageCatalogue($locale);
        if (1 == $nodes->length) {
            $translations = $nodes->item(0)->nextSibling->parentNode->parentNode->getElementsByTagName('message');
            foreach ($translations as $translation) {
                $translationValue = (string) $translation->getElementsByTagName('translation')->item(0)->nodeValue;

                if (!empty($translationValue)) {
                    $catalogue->set(
                        (string) $translation->getElementsByTagName('source')->item(0)->nodeValue,
                        $translationValue,
                        $domain
                    );
                }
                $translation = $translation->nextSibling;
            }

            if (class_exists(FileResource::class)) {
                $catalogue->addResource(new FileResource($resource));
            }
        }

        libxml_use_internal_errors($internalErrors);

        return $catalogue;
    }
}