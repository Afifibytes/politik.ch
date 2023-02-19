<?php

namespace App\Repository;

use App\Entity\MEP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MEP>
 *
 * @method MEP|null find($id, $lockMode = null, $lockVersion = null)
 * @method MEP|null findOneBy(array $criteria, array $orderBy = null)
 * @method MEP[]    findAll()
 * @method MEP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MEPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MEP::class);
    }

    public function save(MEP $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MEP $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneById($id): ?MEP
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.idNumber = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
