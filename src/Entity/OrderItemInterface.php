<?php
namespace Mtt\OrderBundle\Entity;


interface OrderItemInterface
{

    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name);

    public function getPrice(): ?float;

    public function setPrice(float $price);

    public function getDetailItemInfo();

    public function setDetailItemInfo($detailItemInfo);

    public function getOrder(): ?OrderInterface;

    public function setOrder(OrderInterface $order);

    public function getQuantity():int;

    public function setQuantity(int $quantity);
}

