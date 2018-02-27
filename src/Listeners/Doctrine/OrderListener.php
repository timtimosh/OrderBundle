<?php
namespace Mtt\OrderBundle\Listeners\Doctrine;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Mtt\OrderBundle\Entity\OrderInterface;
use Mtt\OrderBundle\Repository\OrderStatusRepository;
use Mtt\OrderBundle\Repository\OrderTypeRepository;


class OrderListener
{
    /**
     * @var OrderStatusRepository
     */
    protected $orderStatusRepository;

    public function __construct(
        EntityRepository $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function prePersist(OrderInterface $entity, LifecycleEventArgs $event)
    {
        $entity->updatedTimestamps();
        if(null === $entity->getStatus()){
            $defaultStatus = $this->orderStatusRepository->findDefault();
            if(null === $defaultStatus){
                throw new \Exception("Set order status first. if there is no order status marked as default - create it and try again!");
            }
            $entity->setStatus($defaultStatus);
        }

    }


    public function preUpdate(OrderInterface $entity, PreUpdateEventArgs $event){
        $entity->updatedTimestamps();
    }

}