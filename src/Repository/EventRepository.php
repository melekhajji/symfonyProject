<?php

namespace App\Repository;

use App\Entity\Event;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Formation;
/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */








   /* public function formation_par_event($formations){

        $em =$this-> getEntityManager();
        $query=$em->createQuery('SELECT datedebut,datefin,nom,type,duree,prix,capacite FROM App\Entity\Event e INNER JOIN  App\Entity\Formation f ON f.nom=e.formations WHERE formations== :formations')->setParameter('formations', $formations);
        return $query->getResult();



    }
    public function listFormationByEvent($formations)
    {
        return $this->createQueryBuilder('s')
            ->from('Event', 's')
            ->innerJoin('s.formations', 'for')
            ->addSelect('for')
            ->where('for.formations = :fr')
            ->setParameter('gr', $formations)
        ->getQuery()
        ->getResult();
    } */



    public function searchEvent($title)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.title LIKE :lieu')
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->execute();
    }

    /**
     * @return Event[] Returns an array of Produit objects
     */
    public function Search($word){
        $qry=$this->createQueryBuilder('m')
            ->where('m.start LIKE :param')
            ->setParameter('param', '%'.$word.'%')
            ->orWhere('m.lieu LIKE :des')
            ->setParameter('des', '%'.$word.'%')
            ->orWhere('m.title LIKE :pr')
            ->setParameter('pr', '%'.$word.'%');
        return $qry->getQuery()->getResult();

    }

}
