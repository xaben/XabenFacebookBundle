<?php

namespace Xaben\FacebookBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('xaben_facebook');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->enumNode('default_mode')->values(array('html5', 'xfbml', 'iframe', 'url'))->defaultValue('html5')->end()
                ->scalarNode('app_id')->end()
                ->scalarNode('locale')->defaultValue('en_US')->end()
            ->end();

        $this->addLikeSection($rootNode);
        $this->addShareSection($rootNode);
        $this->addCommentSection($rootNode);

        return $treeBuilder;
    }

    private function addLikeSection(ArrayNodeDefinition $node){

        $node->children()
                ->arrayNode('like')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('width')->defaultValue('450')->end()
                        ->enumNode('layout')->values(array('standard', 'box_count', 'button_count', 'button'))->defaultValue('standard')->end()
                        ->enumNode('action')->values(array('like', 'recommend'))->defaultValue('like')->end()
                        ->booleanNode('show_faces')->defaultValue(false)->end()
                        ->booleanNode('share')->defaultValue(false)->end()
                        ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
                        ->booleanNode('kid_directed_site')->defaultValue(false)->end()
                        ->scalarNode('ref')->defaultValue(null)->end()
                    ->end()
                ->end()
            ->end();
    }

    private function addShareSection(ArrayNodeDefinition $node){

        $node->children()
            ->arrayNode('share')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('width')->defaultValue('1')->end()
            ->enumNode('layout')->values(array('box_count', 'button_count', 'button', 'icon', 'icon_link', 'link'))->defaultValue('button')->end()
            ->end()
            ->end()
            ->end();
    }

    private function addCommentSection(ArrayNodeDefinition $node){

        $node->children()
                ->arrayNode('comments')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('width')->defaultValue('550')->end()
                        ->enumNode('order_by')->values(array('social', 'reverse_time', 'time'))->defaultValue('social')->end()
                        ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
                        ->integerNode('num_posts')->defaultValue(10)->end()
                    ->end()
                ->end()
            ->end();
    }
}
