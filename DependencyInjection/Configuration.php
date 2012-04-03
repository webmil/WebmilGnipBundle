<?php

namespace Webmil\GnipBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for WebmilGnipBundle
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Get config tree
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $root = $treeBuilder->root('webmil_gnip');

        $root
            ->children()
                ->scalarNode('login')->cannotBeEmpty()->end()
                ->scalarNode('password')->cannotBeEmpty()->end()
                ->scalarNode('datacollectorhost')->cannotBeEmpty()->end()
                ->arrayNode('datacollectors')->useAttributeAsKey('datacollectors')->requiresAtLeastOneElement()->prototype('variable')
            ->end();
        //

        return $treeBuilder;
    }

}