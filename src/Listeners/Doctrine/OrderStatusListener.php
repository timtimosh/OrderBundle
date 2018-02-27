<?php
namespace Mtt\OrderBundle\Listeners\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Mtt\OrderBundle\Entity\OrderStatusInterface;
use Mtt\OrderBundle\Repository\OrderStatusRepository;


class OrderStatusListener
{
    /**
     * @var OrderStatusRepository
     */
    protected $orderTypeRepository;

    public function __construct(
        EntityRepository $orderTypeRepository)
    {
        $this->orderTypeRepository = $orderTypeRepository;
    }


    public function preRemove(OrderStatusInterface $entity, LifecycleEventArgs $event)
    {

    }

}