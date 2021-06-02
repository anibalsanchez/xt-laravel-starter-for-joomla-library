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

namespace Extly\Symfony\Component\Mime\DependencyInjection;

use Extly\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Extly\Symfony\Component\DependencyInjection\ContainerBuilder;
use Extly\Symfony\Component\DependencyInjection\Reference;

/**
 * Registers custom mime types guessers.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class AddMimeTypeGuesserPass implements CompilerPassInterface
{
    private $mimeTypesService;
    private $mimeTypeGuesserTag;

    public function __construct(string $mimeTypesService = 'mime_types', string $mimeTypeGuesserTag = 'mime.mime_type_guesser')
    {
        if (0 < \func_num_args()) {
            XT_trigger_deprecation('symfony/mime', '5.3', 'Configuring "%s" is deprecated.', __CLASS__);
        }

        $this->mimeTypesService = $mimeTypesService;
        $this->mimeTypeGuesserTag = $mimeTypeGuesserTag;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->has($this->mimeTypesService)) {
            $definition = $container->findDefinition($this->mimeTypesService);
            foreach ($container->findTaggedServiceIds($this->mimeTypeGuesserTag, true) as $id => $attributes) {
                $definition->addMethodCall('registerGuesser', [new Reference($id)]);
            }
        }
    }
}
