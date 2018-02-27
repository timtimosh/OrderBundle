<?php
declare(strict_types=1);

namespace Mtt\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Ldap\Adapter\ExtLdap\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass()
 */
abstract class OrderItem implements OrderItemInterface
{

    const ENTITY_ALIAS = 'mtt_order.order_item_entity_alias';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var float
     * @Assert\Type(type="float", message="The value {{ value }} is not a valid {{ type }}.")
     * @ORM\Column(name="price", type="float", scale=2, nullable=false)
     */
    protected $price = 0.00;

    /**
     * @var string
     *
     * @ORM\Column(type="object", nullable=true)
     */
    protected $detailItemInfo;


    /**
     * @Assert\GreaterThan(0)
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    protected $quantity;

    /**
     * @return int
     */
    public function getQuantity():int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="items", cascade={"remove"})
     */
    protected $order;

    /**
     * @return int
     */
    public function getId():?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName():?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice():?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDetailItemInfo()
    {
        return $this->detailItemInfo;
    }

    /**
     * @param string $detailItemInfo
     */
    public function setDetailItemInfo($detailItemInfo)
    {
        $this->detailItemInfo = $detailItemInfo;
    }

    /**
     * @return mixed
     */
    public function getOrder():?OrderInterface
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;
    }

    public function __toString()
    {
        return $this->getName();
    }

}

