<?php
namespace Mtt\OrderBundle\DependencyInjection\Compiler;

use Doctrine\ORM\Version;
use Mtt\CatalogBundle\Entity\Category;
use Mtt\CatalogBundle\Entity\Product;
use Mtt\OrderBundle\Entity\Order;
use Mtt\OrderBundle\Entity\OrderItem;
use Mtt\OrderBundle\Entity\OrderStatus;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineResolveTargetEntityPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        // resolve_target_entities
        $definition = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        $interfaces = [
            'Mtt\OrderBundle\Entity\OrderInterface' => $container->getParameter(Order::ENTITY_ALIAS),
            'Mtt\OrderBundle\Entity\OrderItemInterface' => $container->getParameter(OrderItem::ENTITY_ALIAS),
            'Mtt\OrderBundle\Entity\OrderStatusInterface' => $container->getParameter(OrderStatus::ENTITY_ALIAS)
        ];

        foreach ($interfaces as $entityInterface => $resolvedClass){
            $definition->addMethodCall('addResolveTargetEntity', array($entityInterface, $resolvedClass, array()));
        }

        if (version_compare(Version::VERSION, '2.5.0-DEV') < 0) {
            $definition->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
        } else {
            $definition->addTag('doctrine.event_subscriber', array('connection' => 'default'));
        }
    }
}