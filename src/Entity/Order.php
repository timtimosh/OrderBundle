<?php
declare(strict_types=1);

namespace Mtt\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass()
 */
abstract class Order implements OrderInterface
{

    const ENTITY_ALIAS = 'mtt_order.order_entity_alias';


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    protected $email;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    protected $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $comment;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $customerFirstname;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @Assert\NotBlank(message="Set order status first. if there is no order status marked as default - create it and try again!")
     * @ORM\ManyToOne(targetEntity="Mtt\OrderBundle\Entity\OrderStatusInterface", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $status;

    /**
     * @Assert\NotBlank(message="Attach some items to order first")
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order", fetch="EXTRA_LAZY", cascade={"persist"})
     */
    protected $items;


    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function updatedTimestamps()
    {
        $this->updatedAt = new \DateTime('now');
        if ($this->createdAt === null) {
            $this->createdAt = new \DateTime('now');
        }
    }


    public function getStatus(): ?OrderStatusInterface
    {
        return $this->status;
    }


    public function setStatus(OrderStatusInterface $status)
    {
        $this->status = $status;
    }


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }


    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }


    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }


    public function removeItem(OrderItem $item)
    {
        $this->items->removeElement($item);
    }

    public function addItem(OrderItem $item)
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
        }
    }


    public function getItems(): ?Collection
    {
        return $this->items;
    }


    public function setItems(array $items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }


    public function getEmail():?string
    {
        return $this->email;
    }


    public function setEmail(?string $email)
    {
        $this->email = $email;
    }


    public function getTelephone():?string
    {
        return $this->telephone;
    }


    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }


    public function getComment():?string
    {
        return $this->comment;
    }


    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }


    public function getCustomerFirstname():?string
    {
        return $this->customerFirstname;
    }


    public function setCustomerFirstname(?string $customerFirstname)
    {
        $this->customerFirstname = $customerFirstname;
    }

}

