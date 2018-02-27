<?php
namespace Mtt\OrderBundle\Entity;

use Doctrine\Common\Collections\Collection;

interface OrderInterface
{
    public function getStatus(): ?OrderStatusInterface;

    public function setStatus(OrderStatusInterface $status);

    public function getId(): ?int;

    public function getCreatedAt(): ?\DateTime;

    public function setCreatedAt(\DateTime $createdAt);

    public function getUpdatedAt(): ?\DateTime;

    public function setUpdatedAt(\DateTime $updatedAt);

    public function removeItem(OrderItem $item);

    public function addItem(OrderItem $item);

    public function getItems(): ?Collection;

    public function getEmail():?string;

    public function setEmail(?string $email);

    public function getTelephone():?string;


    public function setTelephone(string $telephone);

    public function getComment():?string;

    public function setComment(string $comment);


    public function getCustomerFirstname():?string;

    public function setCustomerFirstname(?string $customerFirstname);


}

