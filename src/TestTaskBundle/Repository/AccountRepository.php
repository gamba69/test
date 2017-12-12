<?php
/**
 * User: idulevich
 */

namespace TestTaskBundle\Repository;

use Doctrine\ORM\EntityRepository;
use TestTaskBundle\Entity\User;

/**
 * Class AccountRepository
 * @package TestTaskBundle\Repository
 */
class AccountRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return array
     */
    public function getAccountsByUser(User $user)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->andWhere('a.user = :user')
            ->setParameter('user', $user);
        $qb->addOrderBy('a.added', 'desc');

        return $qb->getQuery()->getResult();
    }
}