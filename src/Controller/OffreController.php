<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\{TextType,ButtonType,EmailType,HiddenType,PasswordType,TextareaType,SubmitType,NumberType,DateType,MoneyType,BirthdayType};

class OffreController extends AbstractController
{
    /**
     * @Route("/offre", name="offre")
     */
    public function index(): Response
    {
        return $this->render('offre/index.html.twig', [
            'controller_name' => 'OffreController',
        ]);
    }
    /**
     * @Route("/listoffre",name="listoffre")
     */
    public function listoffre(){

        $listOffre=$this->getDoctrine()->getRepository(Offre::class)->findAll();

        return $this->render('front/afficher.html.twig', [
            'listoffre' => $listOffre
        ]);

    }
    /**
     * @Route("/listoffreAcui",name="listoffreAcui")
     */
    public function listoffreAcui(){

        $listOffre=$this->getDoctrine()->getRepository(Offre::class)->findAll();

        return $this->render('front2/afficher.html.twig', [
            'listoffre' => $listOffre
        ]);

    }
    /**
     * @Route("/listoffre3",name="listoffre3")
     */
    public function listoffre3(){

        $listOffre=$this->getDoctrine()->getRepository(Offre::class)->findAll();

        return $this->render('front3/afficherO.html.twig', [
            'listoffre' => $listOffre
        ]);

    }


    /**
     * @Route("/admin/listoffre",name="listoffreb")
     */
    public function listoffreb(){

        $listOffre=$this->getDoctrine()->getRepository(Offre::class)->findAll();

        return $this->render('offre/admin/afficher.html.twig', [
            'listoffreb' => $listOffre
        ]);

    }



    /**
     * @Route("/ajouterOffre", name="ajouterOffre")
     */
    public function ajouterOffre(Request $request){
        $offre = new Offre();
        $formu = $this->createFormBuilder ($offre)->add ('titre',TextType::class)->add ('entreprise',TextType::class)->add ('adresse',TextType::class)->add ('postes_vacants',TextType::class)->add ('type_contrat',TextType::class)->add ('experience',TextType::class)->add ('remuneration',TextType::class)->add ('langues',TextType::class)->add ('description',TextType::class)->add ('date_expiration',DateType::class)->add('Ajouter',SubmitType::class ,['label'=> 'Ajouter'])->getForm();
        $formu ->handleRequest($request);
        if ($formu->isSubmitted()){
            $offre = $formu->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
            return $this->redirectToRoute('listoffre3');
        }
        return $this->render('front3/ajouteroffre.html.twig' , ['form' => $formu->createView()

        ]);
    }



    /**
     * @Route("/admin/ajouterOffre", name="ajouteroffrea")
     */
    public function ajouterOffreb(Request $request){
        $offre = new Offre();
        $formu = $this->createFormBuilder ($offre)->add ('titre',TextType::class)->add ('entreprise',TextType::class)->add ('adresse',TextType::class)->add ('postes_vacants',TextType::class)->add ('type_contrat',TextType::class)->add ('experience',TextType::class)->add ('remuneration',TextType::class)->add ('langues',TextType::class)->add ('description',TextType::class)->add ('date_expiration',DateType::class)->add('Ajouter',SubmitType::class ,['label'=> 'Ajouter'])->getForm();
        $formu ->handleRequest($request);
        if ($formu->isSubmitted()){
            $offre = $formu->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
            return $this->redirectToRoute('listoffreb');
        }
        return $this->render('offre/admin/ajouteroffre.html.twig' , ['form' => $formu->createView()

        ]);
    }
    /**
     * @Route("/modifieroffre/{id}", name="modifieroffre")
     */
    public function modifieroffre( Request $request , $id){
        $offre = $this->getDoctrine()->getRepository(Offre::class)->find($id); #}

        $form = $this->createFormBuilder ($offre)
            ->add ('titre',TextType::class)
            ->add ('entreprise',TextType::class)
            ->add ('adresse',TextType::class)
            ->add ('postes_vacants',TextType::class)
            ->add ('type_contrat',TextType::class)
            ->add ('experience',TextType::class)
            ->add ('remuneration',TextType::class)
            ->add ('langues',TextType::class)
            ->add ('description',TextType::class)
            ->add ('date_expiration',DateType::class)
            ->add('modifier',SubmitType::class ,['label'=> 'Modifier'])
            ->getForm();
        $form ->handleRequest($request);
        if ($form->isSubmitted()){
            $entity = $this->getDoctrine()->getManager();
            $entity->flush();
            return $this->redirectToRoute('listoffre3');
        }
        return $this->render('front3/modifieroffre.html.twig' , [ 'form' => $form->createView()]);
    }


    /**
     * @Route("/admin/modifieroffre/{id}", name="modifieroffreb")
     */
    public function modifieroffreb( Request $request , $id){
        $offre = $this->getDoctrine()->getRepository(Offre::class)->find($id); #}

        $form = $this->createFormBuilder ($offre)
            ->add ('titre',TextType::class)
            ->add ('entreprise',TextType::class)
            ->add ('adresse',TextType::class)
            ->add ('postes_vacants',TextType::class)
            ->add ('type_contrat',TextType::class)
            ->add ('experience',TextType::class)
            ->add ('remuneration',TextType::class)
            ->add ('langues',TextType::class)
            ->add ('description',TextType::class)
            ->add ('date_expiration',DateType::class)
            ->add('modifier',SubmitType::class ,['label'=> 'Modifier'])
            ->getForm();
        $form ->handleRequest($request);
        if ($form->isSubmitted()){
            $entity = $this->getDoctrine()->getManager();
            $entity->flush();
            return $this->redirectToRoute('listoffreb');
        }
        return $this->render('offre/admin/modifieroffre.html.twig' , [ 'form' => $form->createView()]);
    }




    /**
     * @param $id
     * @Route("/supprimer/{id}",name="supprimer")
     */
    public function supprimer($id)
    {
        $em= $this->getDoctrine()->getManager();
        $offre=$em->getRepository( Offre::class)->find($id);
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute( "listoffre3");



    }




    /**
     * @param $id
     * @Route("/admin/supprimer/{id}",name="supprimerb")
     */
    public function supprimerb($id)
    {
        $em= $this->getDoctrine()->getManager();
        $offre=$em->getRepository( Offre::class)->find($id);
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute( "listoffreb");



    }
    /**
     * @Route("/rechercheoffre",name="rechercheO")
     */
    function Recherche(OffreRepository $repository,Request $request){
        $data=$request->get('searchO');
        $entretien=$repository->findBy(['Adresse'=>$data]);
        return $this->render('front/afficher.html.twig',
            ['listoffre'=>$entretien]);
    }
    /**
     * @Route("/recherche3",name="recherche3")
     */
    function Recherche3(OffreRepository $repository,Request $request){
        $data=$request->get('searchO');
        $entretien=$repository->findBy(['Adresse'=>$data]);
        return $this->render('front3/afficher.html.twig',
            ['listoffre'=>$entretien]);
    }
    /**
     * @Route("/admin/rechercheoffre",name="rechercheOb")
     */
    function Rechercheb(OffreRepository $repository,Request $request){
        $data=$request->get('searchOb');
        $entretien=$repository->findBy(['Adresse'=>$data]);
        return $this->render('offre/admin/afficher.html.twig',
            ['listoffreb'=>$entretien]);
    }
}
