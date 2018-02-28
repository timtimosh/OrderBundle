<?php

namespace Mtt\OrderBundle\Listeners\Doctrine;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Mtt\OrderBundle\Entity\OrderInterface;
use Mtt\OrderBundle\Repository\OrderStatusRepository;
use Mtt\OrderBundle\Repository\OrderTypeRepository;


class OrderListener
{

    public function prePersist(OrderInterface $entity, LifecycleEventArgs $event)
    {
        $entity->updatedTimestamps();
    }


    public function preUpdate(OrderInterface $entity, PreUpdateEventArgs $event)
    {
        $entity->updatedTimestamps();
    }

}