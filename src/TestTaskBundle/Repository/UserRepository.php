<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package TestTaskBundle\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getUsers()
    {
        $qb = $this->createQueryBuilder('u');
        $qb->leftJoin('u.accounts', 'a');

        $qb->addSelect($qb->expr()->count('a'));
        $qb->addSelect($qb->expr()->max('a.added'));

        $qb->groupBy('u');

        return $qb->getQuery()->getResult();
    }
}