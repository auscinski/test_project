<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
    * @return Integer
    */

    public function countByAvailable()
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p)')
            ->andWhere('p.available = :val')
            ->setParameter('val', true)
            ->getQuery()
            ->getResult()
        ;
    }



     /**
      * @return Product[] Returns an array of Product objects
      */

    public function findByNotAvailable($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.available = :val')
            ->setParameter('val', false)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getSearchClasses( $query=null )
    {
        $qb = $this->createQueryBuilder('p');

        if($query && $query !== '') {
            $qb->andWhere('p.name LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }

        return $qb->getQuery()->getResult();

    }




    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
