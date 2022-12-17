<?php

namespace App\Repository;

use App\Entity\NiveauEtudes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NiveauEtudes>
 *
 * @method NiveauEtudes|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauEtudes|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauEtudes[]    findAll()
 * @method NiveauEtudes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauEtudesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NiveauEtudes::class);
    }

    public function save(NiveauEtudes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NiveauEtudes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NiveauEtudes[] Returns an array of NiveauEtudes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NiveauEtudes
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
