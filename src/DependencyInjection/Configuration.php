<?php

namespace DoubleStarSystems\Bundle\GoogleApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('google_api');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('scopes')
                  ->prototype('scalar')->end()
                ->end() // app
                ->scalarNode('credential_file')
                    ->defaultValue('%kernel.root_dir%/config/google_api_bundle/credentials.json')
                ->end() //credential_file
                ->scalarNode('application_name')
                    ->defaultValue('A Symfony Application')
                ->end() //application_name
            ->end()
        ;

        return $treeBuilder;
    }
}
