<?php

namespace Xaben\FacebookBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XabenFacebookExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //load paramters
        $container->setParameter("xaben.facebook.default_mode", $config["default_mode"]);
        $container->setParameter("xaben.facebook.app_id", $config["app_id"]);
        $container->setParameter("xaben.facebook.locale", $config["locale"]);

        $container->setParameter("xaben.facebook.like.width", $config["like"]["width"]);
        $container->setParameter("xaben.facebook.like.layout", $config["like"]["layout"]);
        $container->setParameter("xaben.facebook.like.action", $config["like"]["action"]);
        $container->setParameter("xaben.facebook.like.show_faces", $config["like"]["show_faces"]);
        $container->setParameter("xaben.facebook.like.share", $config["like"]["share"]);
        $container->setParameter("xaben.facebook.like.colorscheme", $config["like"]["colorscheme"]);
        $container->setParameter("xaben.facebook.like.kid_directed_site", $config["like"]["kid_directed_site"]);
        $container->setParameter("xaben.facebook.like.ref", $config["like"]["ref"]);

        $container->setParameter("xaben.facebook.share.width", $config["share"]["width"]);
        $container->setParameter("xaben.facebook.share.layout", $config["share"]["layout"]);

        $container->setParameter("xaben.facebook.comments.width", $config["comments"]["width"]);
        $container->setParameter("xaben.facebook.comments.colorscheme", $config["comments"]["colorscheme"]);
        $container->setParameter("xaben.facebook.comments.order_by", $config["comments"]["order_by"]);
        $container->setParameter("xaben.facebook.comments.num_posts", $config["comments"]["num_posts"]);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
