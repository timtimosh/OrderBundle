<?php

namespace Mtt\OrderBundle\DependencyInjection;

use Mtt\OrderBundle\Entity\Order;
use Mtt\OrderBundle\Entity\OrderItem;
use Mtt\OrderBundle\Entity\OrderStatus;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MttOrderExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

    }

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $myBundleConfig = $this->processConfiguration(new Configuration(), $configs);


        $container->setParameter(Order::ENTITY_ALIAS, $myBundleConfig['entities']['order_entity']);
        $container->setParameter(OrderStatus::ENTITY_ALIAS, $myBundleConfig['entities']['order_status_entity']);
        $container->setParameter(OrderItem::ENTITY_ALIAS, $myBundleConfig['entities']['order_item_entity']);

        if(!empty($myBundleConfig['easy_admin_integration'])) {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../EasyAdminIntegration/Resources/config'));
            $loader->load('superadmin.yml');
        }
    }
}
