<?php

namespace App\Repository;

use App\Entity\Borrower;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Borrower|null find($id, $lockMode = null, $lockVersion = null)
 * @method Borrower|null findOneBy(array $criteria, array $orderBy = null)
 * @method Borrower[]    findAll()
 * @method Borrower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BorrowerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Borrower::class);
    }

    public function findOneByName($value){
        $qb = $this->createQueryBuilder('s');
        return $qb->where($qb->expr()->orX(
                $qb->expr()->like('s.firstname', ':value'),
                $qb->expr()->like('s.lastname', ':value')
            ))
            ->setParameter('value', "%{$value}%")
            ->orderBy('s.firstname', 'ASC')
            ->orderBy('s.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByPhone($value){
        return $this->createQueryBuilder('b')
            ->andWhere('b.phoneNumber LIKE :phoneNumber')
            ->setParameter('phoneNumber', '%{$value}%')
            ->orderBy('b.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByDate(string $value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.creationDate < :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByActive($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.active = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByUser(User $user)
    {

         return $this->createQueryBuilder('p')

            ->innerJoin('p.user', 'u')
            ->andWhere('p.user = :user')
            ->andWhere('role', "%{$roles}%")
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult()
            ;
    }


    // /**
    //  * @return Borrower[] Returns an array of Borrower objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Borrower
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}