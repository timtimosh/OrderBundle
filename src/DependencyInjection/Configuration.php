<?php

namespace Mtt\OrderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mtt_order');

        $rootNode
            ->children()
                ->scalarNode('easy_admin_integration')->defaultNull()
            ->end()
        ->end();

        $this->loadEntities($rootNode);
        return $treeBuilder;
    }

    protected function loadEntities($node){
        $node->children()
                ->arrayNode('entities')->cannotBeEmpty()
                            ->children()
                                ->scalarNode('order_entity')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('order_item_entity')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('order_status_entity')->isRequired()->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                ->end();
    }
}
