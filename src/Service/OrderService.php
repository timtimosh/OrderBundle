<?php

namespace Mtt\OrderBundle\Service;


use Doctrine\Common\Persistence\ObjectRepository;
use Mtt\OrderBundle\Entity\OrderInterface;
use Mtt\OrderBundle\Entity\OrderItemInterface;
use Mtt\OrderBundle\Entity\OrderStatusInterface;

class OrderService implements OrderServiceInterface
{
    protected $orderEntity;
    protected $orderItemEntity;
    protected $orderStatusRepository;

    public function __construct(
        string $orderEntity,
        string $orderItemEntity,
        ObjectRepository $orderStatusRepository)
    {
        $this->orderEntity = $orderEntity;
        $this->orderItemEntity = $orderItemEntity;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    public function createOrder(): OrderInterface
    {
        return new $this->orderEntity;
    }

    public function createOrderItem(): OrderItemInterface
    {
        return new $this->orderItemEntity;
    }

    public function calculateOrderTotalPrice(OrderInterface $order): float
    {
        $total = 0;
        foreach ($order->getItems() as $orderItem) {
            $total += $orderItem->getPrice();
        }
        return $total;
    }

    public function getDefaultOrderStatus():?OrderStatusInterface{
        return $this->orderStatusRepository->findDefault();
    }

}