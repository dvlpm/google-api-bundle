<?php

namespace DoubleStarSystems\Bundle\GoogleApiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class GoogleApiExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
        
        $container->getDefinition('DoubleStarSystems\Bundle\GoogleApiBundle\ClientFactory')
            ->setArguments([$config])
        ;
        $command = $container->getDefinition('DoubleStarSystems\Bundle\GoogleApiBundle\Command\CreateTokenCommand');
        $command->setArgument('$configuration', $config);
    }
}
