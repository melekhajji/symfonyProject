<?php

namespace App\Repository;

use App\Entity\Quiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    public function findLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.theme LIKE :titre or a.nbquestion LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.theme')
            ->setMaxResults(5)
            ->getQuery()
            ->execute()
            ;
    }
    public function findAllLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.theme LIKE :titre or a.nbquestion LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.theme')
            ->getQuery()
            ->execute()
            ;
    }

    public function findAllBy($dureeMin,$dureeMax,$nbMin,$nbMax)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.duree BETWEEN :dureeMin AND :dureeMax AND a.nbquestion BETWEEN :nbMin AND :nbMax')
            ->setParameter( 'dureeMin', $dureeMin)
            ->setParameter( 'dureeMax', $dureeMax)
            ->setParameter( 'nbMin', $nbMin)
            ->setParameter( 'nbMax', $nbMax)
            ->orderBy('a.theme')
            ->getQuery()
            ->execute()
            ;
    }




    public function orderByTheme()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.theme', 'ASC')
            ->getQuery()
            ->getResult();
    }







    // /**
    //  * @return Quiz[] Returns an array of Quiz objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Quiz
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
