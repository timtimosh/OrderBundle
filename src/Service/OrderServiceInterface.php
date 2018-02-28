<?php

namespace Mtt\OrderBundle\Service;

use Mtt\OrderBundle\Entity\OrderInterface;
use Mtt\OrderBundle\Entity\OrderItemInterface;
use Mtt\OrderBundle\Entity\OrderStatusInterface;

interface OrderServiceInterface
{
    public function createOrder(): OrderInterface;

    public function createOrderItem(): OrderItemInterface;

    public function calculateOrderTotalPrice(OrderInterface $order): float;

    public function getDefaultOrderStatus(): ?OrderStatusInterface;
}
