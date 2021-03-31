<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Entity\Reclamation;
use App\Form\EntretienType;
use App\Repository\EntretienRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EntretienController extends AbstractController
{
    /**
     * @Route("/entretien", name="entretien")
     */
    public function index(): Response
    {
        return $this->render('entretien/index.html.twig', [
            'controller_name' => 'EntretienController',
        ]);
    }
    /**
     * @Route("/ajouterEntretien", name="ajouterEntretien")
     */
    public function ajouterEntretien(Request $request)
    {
        $entretien = new Entretien();
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entretien);
            $em->flush();
            return $this->redirectToRoute('listentretien3');
        }
        return $this->render("front3/ajouterentretien.html.twig", array('form' => $form->createView()));
    }
    /**
     * @Route("/admin/ajouterEntretien", name="ajouterEntretienb")
     */
    public function ajouterEntretienb(Request $request)
    {
        $entretien = new Entretien();
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entretien);
            $em->flush();
            return $this->redirectToRoute('listentretienb');
        }
        return $this->render("entretien/admin/ajouterentretien.html.twig", array('form' => $form->createView()));
    }
    /**
     * @Route("/listentretien", name="listentretien")
     */
    public function listentretien()
    {
        $listEntretien = $this->getDoctrine()->getRepository(Entretien::class)->findAll();
        return $this->render('front/afficherE.html.twig', [
            'listentretien' => $listEntretien
        ]);
    }
    /**
     * @Route("/listentretien3", name="listentretien3")
     */
    public function listentretien3()
    {
        $listEntretien = $this->getDoctrine()->getRepository(Entretien::class)->findAll();
        return $this->render('front3/afficher.html.twig', [
            'listentretien3' => $listEntretien
        ]);
    }
    /**
     * @Route("/admin/listentretien", name="listentretienb")
     */
    public function listentretienb()
    {
        $listEntretien = $this->getDoctrine()->getRepository(Entretien::class)->findAll();
        return $this->render('entretien/admin/afficher.html.twig', [
            'listentretienb' => $listEntretien
        ]);
    }
    /**
     * @Route("/modifierentretien/{id}", name="modifierentretien")
     */
    public function modifierEntretien(Request $request, $id)
    {
        $entretien = $this->getDoctrine()->getRepository(Entretien::class)->find($id);
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listentretien3');
        }
        return $this->render("front3/modifierentretien.html.twig", array('form' => $form->createView()));
    }
    /**
     * @Route("/modifierentretienb/{id}", name="modifierentretienb")
     */
    public function modifierEntretienb(Request $request, $id)
    {
        $entretien = $this->getDoctrine()->getRepository(Entretien::class)->find($id);
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listentretienb');
        }
        return $this->render("entretien/admin/modifierentretien.html.twig", array('form' => $form->createView()));
    }
    /**
     * @Route("/supprimerentretien/{id}",name="supprimerentretien")
     */
    public function deleteentreb($id)
    {
        $entre = $this->getDoctrine()->getRepository(Entretien
        ::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($entre);
        $em->flush();
        return $this->redirectToRoute("listentretien3");
    }

    /**
     * @Route("/supprimerentretienb/{id}",name="supprimerentretienb")
     */
    public function deleteentre($id)
    {
        $entre = $this->getDoctrine()->getRepository(Entretien
        ::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($entre);
        $em->flush();
        return $this->redirectToRoute("listentretienb");
    }
    /**
     * @Route("/rechercheentretien",name="recherche")
     */
    function Recherche(EntretienRepository $repository,Request $request){
    $data=$request->get('search');
    $entretien=$repository->findBy(['Adresse'=>$data]);
    return $this->render('front/afficher.html.twig',
    ['listentretien'=>$entretien]);
    }
    /**
     * @Route("/rechercheentretien3",name="recherche3")
     */
    function Recherche3(EntretienRepository $repository,Request $request){
        $data=$request->get('search');
        $entretien=$repository->findBy(['Adresse'=>$data]);
        return $this->render('front3/afficher.html.twig',
            ['listentretien3'=>$entretien]);
    }
    /**
     * @Route("/rechercheentretienb",name="rechercheb")
     */
    function Rechercheb(EntretienRepository $repository,Request $request){
        $data=$request->get('search');
        $entretien=$repository->findBy(['Adresse'=>$data]);
        return $this->render('entretien/admin/afficher.html.twig',
            ['listentretienb'=>$entretien]);
    }
}
