<?php
declare(strict_types=1);

namespace Mtt\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\MappedSuperclass()
 */
abstract class OrderStatus implements OrderStatusInterface
{
    const ENTITY_ALIAS = 'mtt_order.order_status_entity_alias';

    const DEFAULT_ORDER = 1;
    const NOT_DEFAULT_ORDER = 0;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $statusIdErp;


    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $defaultStatus = self::NOT_DEFAULT_ORDER;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
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
     * @return int
     */
    public function getStatusIdErp(): ?string
    {
        return $this->statusIdErp;
    }

    /**
     * @param int $statusIdErp
     */
    public function setStatusIdErp(string $statusIdErp)
    {
        $this->statusIdErp = $statusIdErp;
    }


    public function isDefaultStatus(): bool
    {
        return $this->defaultStatus ? true : false;
    }

    public function setDefaultStatus(bool $default)
    {
        $this->defaultStatus = $default;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

