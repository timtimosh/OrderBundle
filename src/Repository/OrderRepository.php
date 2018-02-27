<?php

namespace Mtt\OrderBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{


    /**
     * @param $qb QueryBuilder
     */
    public function activeQuery($qb){
        $qb->where('c.active = :active');
        // ->andWhere('f.end <= :end')
        $qb->setParameter('active', Category::CATEGORY_ACTIVE);
    }

    public function createOrderTypeQuery(){
        $qb = $this->_em->createQueryBuilder();
        $qb->select('c')
            ->from($this->_entityName, 'c');
        return $qb;
    }

}