<?php

namespace App\Repository;

use App\Entity\BookImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookImages>
 *
 * @method BookImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookImages[]    findAll()
 * @method BookImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookImages::class);
    }

//    /**
//     * @return BookImages[] Returns an array of BookImages objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BookImages
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
