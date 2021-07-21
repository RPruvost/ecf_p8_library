<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }
    public function findByTitle($value)
    {
       return $this->createQueryBuilder('u')
            ->andWhere('u.title LIKE :title')
            ->setParameter('title', "%{$value}%")
            ->orderBy('u.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
        public function findByAuthorID($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.title LIKE :title')
            ->setParameter('title', "%{$value}%")
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findOneByAuthor($id)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.author', 'a')
            ->andWhere('a.id = :author')
            ->setParameter('author', $id)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findOneByGenre($value)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.genres', 'g')
            ->andWhere('g.name LIKE :genres')
            ->setParameter('genres', "%{$value}%")
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
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
    public function findOneBySomeField($value): ?Book
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
