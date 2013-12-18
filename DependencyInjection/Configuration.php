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

        $this->addLikeButtonSection($rootNode);
        $this->addShareButtonSection($rootNode);
        $this->addSendButtonSection($rootNode);
        $this->addEmbeddedPostsSection($rootNode);
        $this->addFollowSection($rootNode);
        $this->addCommentsSection($rootNode);
        $this->addActivityFeedSection($rootNode);
        $this->addRecommendationsFeedSection($rootNode);
        $this->addRecommendationsBarSection($rootNode);
        $this->addLikeBoxSection($rootNode);
        $this->addFacepileSection($rootNode);

        return $treeBuilder;
    }

    private function addLikeButtonSection(ArrayNodeDefinition $node)
    {
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

    private function addShareButtonSection(ArrayNodeDefinition $node)
    {
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

    private function addSendButtonSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('send')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('width')->defaultValue('450')->end()
            ->scalarNode('height')->defaultValue('0')->end()
            ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
            ->booleanNode('kid_directed_site')->defaultValue(false)->end()
            ->scalarNode('ref')->defaultValue(null)->end()
            ->end()
            ->end()
            ->end();
    }

    private function addEmbeddedPostsSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('embedded_posts')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('width')->defaultValue('500')->end() // 350 .. 750
            ->end()
            ->end()
            ->end();
    }

    private function addFollowSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('follow')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('width')->defaultValue('450')->end()
            ->scalarNode('height')->defaultValue('80')->end()
            ->enumNode('layout')->values(array('standard', 'box_count', 'button_count'))->defaultValue('standard')->end()
            ->booleanNode('show_faces')->defaultValue(false)->end()
            ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
            ->booleanNode('kid_directed_site')->defaultValue(false)->end()
            ->end()
            ->end()
            ->end();
    }

    private function addCommentsSection(ArrayNodeDefinition $node)
    {
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

    private function addActivityFeedSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('activity_feed')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('action')->defaultValue('')->end()
            ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
            ->scalarNode('filter')->defaultValue('')->end()
            ->booleanNode('header')->defaultValue(true)->end()
            ->scalarNode('height')->defaultValue('300')->end()
            ->scalarNode('linktarget')->defaultValue('_blank')->end()
            ->scalarNode('max_age')->defaultValue('0')->end()  // 0.. 180
            ->booleanNode('recommendations')->defaultValue(false)->end()
            ->scalarNode('ref')->defaultValue('')->end()
            ->scalarNode('site')->defaultValue('')->end()
            ->scalarNode('width')->defaultValue('300')->end()
            ->end()
            ->end()
            ->end();
    }

    private function addRecommendationsFeedSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('recommendations_feed')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('action')->defaultValue('')->end()
            ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
            ->booleanNode('header')->defaultValue(true)->end()
            ->scalarNode('height')->defaultValue('300')->end()
            ->scalarNode('linktarget')->defaultValue('_blank')->end()
            ->scalarNode('max_age')->defaultValue('0')->end()  // 0.. 180
            ->scalarNode('ref')->defaultValue('')->end()
            ->scalarNode('site')->defaultValue('')->end()
            ->scalarNode('width')->defaultValue('300')->end()
            ->end()
            ->end()
            ->end();
    }

    private function addRecommendationsBarSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('recommendations_bar')
            ->addDefaultsIfNotSet()
            ->children()
            ->enumNode('action')->values(array('like', 'recommend'))->defaultValue('like')->end()
            ->scalarNode('max_age')->defaultValue('0')->end()  // 0.. 180
            ->scalarNode('num_recommendations')->defaultValue('2')->end()  // 1.. 5
            ->scalarNode('read_time')->defaultValue('30')->end() //10..30
            ->scalarNode('ref')->defaultValue('')->end()
            ->enumNode('side')->values(array('left', 'right'))->defaultValue('left')->end()
            ->scalarNode('site')->defaultValue('')->end()
            ->scalarNode('trigger')->defaultValue('')->end()
            ->end()
            ->end()
            ->end();
    }

    private function addLikeBoxSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('like_box')
            ->addDefaultsIfNotSet()
            ->children()
            ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
            ->booleanNode('force_wall')->defaultValue(false)->end()
            ->booleanNode('header')->defaultValue(true)->end()
            ->scalarNode('height')->defaultValue('556')->end()
            ->booleanNode('show_border')->defaultValue(true)->end()
            ->booleanNode('show_faces')->defaultValue(true)->end()
            ->booleanNode('stream')->defaultValue(true)->end()
            ->scalarNode('width')->defaultValue('300')->end()
            ->end()
            ->end()
            ->end();
    }

    private function addFacepileSection(ArrayNodeDefinition $node)
    {
        $node->children()
            ->arrayNode('facepile')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('action')->defaultValue('like')->end()
            ->enumNode('colorscheme')->values(array('light', 'dark'))->defaultValue('light')->end()
            ->scalarNode('max_rows')->defaultValue('1')->end()
            ->enumNode('size')->values(array('small', 'medium', 'large'))->defaultValue('medium')->end()
            ->scalarNode('width')->defaultValue('300')->end()
            ->end()
            ->end()
            ->end();
    }

}
