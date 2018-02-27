<?php

namespace Mtt\OrderBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Mtt\OrderBundle\Entity\OrderStatusInterface;
use OrderBundle\Entity\OrderStatus;

class OrderStatusRepository extends EntityRepository
{

    public function findDefault(): ?OrderStatusInterface
    {
        $qb = $this->createOrderTypeQuery();
        $this->defaultStatusQuery($qb);
        $qb->setMaxResults(1);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $qb QueryBuilder
     */
    protected function defaultStatusQuery(QueryBuilder $qb)
    {
        $qb->where('ot.defaultStatus = :default_status');
        // ->andWhere('f.end <= :end')
        $qb->setParameter('default_status', OrderStatus::DEFAULT_ORDER);
    }

    public function createOrderTypeQuery(): QueryBuilder
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('ot')
            ->from($this->_entityName, 'ot');
        return $qb;
    }

}