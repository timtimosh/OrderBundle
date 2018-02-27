<?php

namespace Mtt\OrderBundle\Service;


use Mtt\OrderBundle\Entity\OrderInterface;
use Mtt\OrderBundle\Entity\OrderItemInterface;

class OrderService implements OrderServiceInterface
{
    protected $orderEntity;
    protected $orderItemEntity;

    public function __construct(string $orderEntity, string $orderItemEntity)
    {
        $this->orderEntity = $orderEntity;
        $this->orderItemEntity = $orderItemEntity;
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

}