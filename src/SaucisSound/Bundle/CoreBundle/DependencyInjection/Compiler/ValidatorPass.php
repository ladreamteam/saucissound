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
     * @var string
     */
    private $dir;

    /**
     * Inits the ValidatorPass for the given bundle
     *
     * @param string $dir the directory of the bundle using the validator pass
     */
    public function __construct($dir)
    {
        $this->setDir($dir);
    }

    /**
     * Adds every Bundle/Resources/validation/* to the validation
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $validatorBuilder = $container->getDefinition('validator.builder');
        $finder           = new Finder();
        $files = $finder->files()->in(sprintf('%s/Resources/config/validation', $this->getDir()));
        $validatorFiles   = [];

        /** @var \Symfony\Component\HttpFoundation\File\File $file */
        foreach ($files as $file) {
            $validatorFiles[] = $file->getRealPath();
        }

        $validatorBuilder->addMethodCall('addYamlMappings', [$validatorFiles]);
    }

    /**
     * @return string
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * @param string $dir
     *
     * @return $this
     */
    public function setDir($dir)
    {
        $this->dir = (string)$dir;

        return $this;
    }
}