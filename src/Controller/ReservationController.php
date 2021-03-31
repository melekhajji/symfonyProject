<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Event;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/list4",name="list4")
     */
    public function list($id)
    {     $reservation = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $user = $this->getDoctrine()->getRepository(Users::class)->find($id);
        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();
        $Events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        //récupérer tous les articles de la table article de la BD
        // et les mettre dans le tableau $articles


        return $this->render('reservation/liste.html.twig', ['reservation'=>$reservation,'Event' => $Events,'user'=>$user,'users'=>$users]);
    }

    /**
     * @Route("/new5/{id}/{id1}")

     */
    public function new($id,$id1) {
        $reservation = new Reservation();
        $reservation-> setIduser($id);
        $reservation->setIdevent($id1);


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->redirectToRoute('list4',array('id' => $reservation-> getIduser()));
    }
    /**
     * @Route("/delete3/{id}/{id1}",name="delete3")

     */
    public function delete( $id,$id1) {
        $reservation = $this->getDoctrine()->getRepository(Reservation::class)->find($id1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($reservation);
        $entityManager->flush();

        $response = new Response();
        $response->send();

        return $this->redirectToRoute('list4',array('id' => $id));
    }
}
