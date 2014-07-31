<?php

namespace SaucisSound\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;

/**
 * Class ValidatorPass
 * @package SaucisSound\Bundle\CoreBundle\DependencyInjection\Compiler
 */
class ValidatorPass implements CompilerPassInterface
{
    /**
     * Adds every Bundle/Resources/validation/* to the validation
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $validatorBuilder = $container->getDefinition('validator.builder');
        $finder           = new Finder();
        $files            = $finder->files()->in(__DIR__.'/../../Resources/config/validation');
        $validatorFiles   = [];

        /** @var \Symfony\Component\HttpFoundation\File\File $file */
        foreach ($files as $file) {
            $validatorFiles[] = $file->getRealPath();
        }

        $validatorBuilder->addMethodCall('addYamlMappings', [$validatorFiles]);
    }
}