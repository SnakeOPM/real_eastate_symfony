<?php

namespace App\Repository;

use App\Entity\FlatType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FlatType>
 *
 * @method FlatType|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlatType|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlatType[]    findAll()
 * @method FlatType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlatTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlatType::class);
    }

//    /**
//     * @return FlatType[] Returns an array of FlatType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FlatType
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
