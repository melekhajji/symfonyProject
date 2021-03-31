<?php

namespace App\Controller;
use App\Entity\Reclamation;
use App\Entity\Users;
use App\Form\SearchReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;


class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="reclamation")
     */
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    /**
     * @Route("/listReclamation", name="listReclamation")
     */
    public function listReclamation(Request $request, ReclamationRepository $repository)
    {

        $reclamations = $repository->findAll();



        $searchForm = $this->createForm(SearchReclamationType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $type = $searchForm->getData()->getType();
            $resultOfSearch = $repository->searchReclamation($type);
            return $this->render('reclamation/searchReclamation.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchReclamation" => $searchForm->createView()));
        }
        return $this->render('reclamation/list.html.twig', array(
            "reclamations" => $reclamations,

            "searchReclamation" => $searchForm->createView()));
    }


    /**
     * @Route("/delete/{id}", name="deleteReclamation")
     */
    public function deleteReclamation($id)
    {
        $reclamations = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($reclamations);
        $em->flush();
        return $this->redirectToRoute("listReclamation");
    }


    /**
     * @Route("/addReclamation", name="addReclamation")
     */
    public function addReclamation(Request $request)
    {
        $reclamation = new Reclamation();


        $reclamation->setCreatedAt(new \Datetime('now'));
       // die(var_dump(new \Datetime('now')));
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
          //  return $this->redirectToRoute('listReclamation');
        }
        return $this->render("front/add.html.twig",array('form'=>$form->createView()));
    }

    /**
     * @Route("/addReclamationf3", name="addReclamationf3")
     */
    public function addReclamation2(Request $request)
    {
        $reclamation = new Reclamation();


        $reclamation->setCreatedAt(new \Datetime('now'));
        // die(var_dump(new \Datetime('now')));
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            //  return $this->redirectToRoute('listReclamation');
        }
        return $this->render("front3/add.html.twig",array('form'=>$form->createView()));
    }

    /**
     * @Route("/update/{id}", name="updateReclamation")
     */
    public function updateReclamation(Request $request,$id)
    {
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listReclamation');
        }
        return $this->render("reclamation/update.html.twig",array('form'=>$form->createView()));
    }








}
