<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formation[]    findAll()
 * @method Formation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }


    /**
     * Requête QueryBuilder
     * */


    public function searchFormation($nom)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.nom LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%')
            ->getQuery()
            ->execute();
    }




    public function listFormationByEvent($id)
    {
        return $this->createQueryBuilder('s')
            ->join('s.event', 'c')
            ->addSelect('c')
            ->where('c.id=:id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult();
    }


    public function countByEvent(){
        return $this->createQueryBuilder('a')
            ->join('a.event', 'c')
            ->addSelect('c.title as titre ,COUNT(a) as formationsNombre')
            ->groupBy('c')
            ->getQuery()
            ->getResult();

    }












}
