<?php

namespace App\Controller;
use App\Repository\FormationRepository;
use App\Form\SearchFormationType;
use App\Entity\Formation;
use App\Entity\Event;
use App\Form\FormationType;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;
use Spipu\Html2Pdf\Html2Pdf;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class FormationController extends AbstractController
{



    /**
     * @Route("/admin/listFormation",name="listFormationA")

     */
    public function listFormation(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {


        //search by nom
        $searchForm = $this->createForm(SearchFormationType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $nom = $searchForm->getData()->getNom();
            $resultOfSearch = $repository->searchFormation($nom);
            return $this->render('formation/searchFormation.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchFormation" => $searchForm->createView()));
        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );


        return $this->render('formation/listFormation.html.twig', array(
            "formations" => $formations,

            "searchFormation" => $searchForm->createView()));
    }




    /**
     * @Route("/admin/TriD",name="TriD")
     */
    public function TriDuree(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {


        //search by nom
        $searchForm = $this->createForm(SearchFormationType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $nom = $searchForm->getData()->getNom();
            $resultOfSearch = $repository->searchFormation($nom);
            return $this->render('formation/searchFormation.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchFormation" => $searchForm->createView()));
        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.duree', 'ASC')

            ->getQuery();


        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        return $this->render('formation/listFormation.html.twig', array(

            "formations" => $formations,
            "searchFormation" => $searchForm->createView()));
    }
    /**
     * @Route("/admin/TriT",name="TriT")
     */
    public function TriType(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {


        //search by nom
        $searchForm = $this->createForm(SearchFormationType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $nom = $searchForm->getData()->getNom();
            $resultOfSearch = $repository->searchFormation($nom);
            return $this->render('formation/searchFormation.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchFormation" => $searchForm->createView()));
        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.type', 'ASC')

            ->getQuery();


        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        return $this->render('formation/listFormation.html.twig', array(

            "formations" => $formations,
            "searchFormation" => $searchForm->createView()));
    }
    /**
     * @Route("/admin/TriN",name="TriN")
     */
    public function TriNom(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {


        //search by nom
        $searchForm = $this->createForm(SearchFormationType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $nom = $searchForm->getData()->getNom();
            $resultOfSearch = $repository->searchFormation($nom);
            return $this->render('formation/searchFormation.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchFormation" => $searchForm->createView()));
        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.nom', 'ASC')

            ->getQuery();


        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        return $this->render('formation/listFormation.html.twig', array(

            "formations" => $formations,
            "searchFormation" => $searchForm->createView()));
    }

    /**
     * @Route("/admin/TriPA",name="TriPA")
     */
    public function TriPrix(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {


//search by nom
        $searchForm = $this->createForm(SearchFormationType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $nom = $searchForm->getData()->getNom();
            $resultOfSearch = $repository->searchFormation($nom);
            return $this->render('formation/searchFormation.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchFormation" => $searchForm->createView()));
        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.prix', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        return $this->render('formation/listFormation.html.twig', array(

            "formations" => $formations,
            "searchFormation" => $searchForm->createView()));
    }


    /**
     * @Route("/deleteFormation/{id}", name="deleteFormation")
     */
    public function deleteFormation($id)
    {
        $formation = $this->getDoctrine()->getRepository(Formation::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($formation);
        $em->flush();
        return $this->redirectToRoute("listFormationA");
    }

    /**
     * @Route("/admin/updateFormation/{id}", name="updateFormation")
     */
    public function updateFormation(Request $request, $id)
    {
        $formation = $this->getDoctrine()->getRepository(Formation::class)->find($id);
        $form = $this->createForm(FormationType::class, $formation);
        $form->add('modifier', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listFormationA');
        }
        return $this->render("Formation/updateFormation.html.twig", array('form' => $form->createView()));
    }

    /**
     * @Route("/admin/addFormation", name="addFormation")
     */
    public function addFormation(Request $request)
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->add('ajouter', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
            return $this->redirectToRoute('listFormationA');
        }
        return $this->render("formation/addFormation.html.twig", array('form' => $form->createView()));
    }


    /**
     * @Route("/default", name="default")
     */
    public function pdf(Request $request, FormationRepository $repository)
    {
        //All formations
        $formations = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('formation/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test", "formations" => $formations
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

    }

    /**
     * @Route("/default2", name="default2")
     */
    public function pdf2(Request $request, FormationRepository $repository)
    {
        //All formations
        $listFormation = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('front/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test", "formations" => $listFormation
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

    }
    /**
     * @Route("/default3", name="default3")
     */
    public function pdf3(Request $request, FormationRepository $repository)
    {
        //All formations
        $listFormation = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('front3/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test", "formations" => $listFormation
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

    }

    /**
     * @Route("/default4", name="default4")
     */
    public function pdf4(Request $request, FormationRepository $repository)
    {
        //All formations
        $listFormation = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('front2/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test", "formations" => $listFormation
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

    }

    /**
     * @Route("/listFormation",name="listFormation")
     *  *  resource:   "@EndroidQrCodeBundle/Controller/"
     *  type:       annotation
     * prefix:     /qrcode
     */
    public function listForm(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriPrix1",name="TriPrix1")
     */
    public function TriPrix1(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.prix', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriPrix3",name="TriPrix3")
     */
    public function TriPrix3(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.prix', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front3/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriPrix2",name="TriPrix2")
     */
    public function TriPrix2(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.prix', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front2/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriDuree3",name="TriDuree3")
     */
    public function TriDuree3(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.type', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front3/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriDuree1",name="TriDuree1")
     */
    public function TriDuree1(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.type', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriDuree2",name="TriDuree2")
     */
    public function TriDuree2(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.type', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front2/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriType3",name="TriType3")
     */
    public function TriType3(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.type', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front3/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriType2",name="TriType2")
     */
    public function TriType2(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.type', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front2/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriNom1",name="TriNom1")
     */
    public function TriNom1(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.nom', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriNom3",name="TriNom3")
     */
    public function TriNom3(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.nom', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front3/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }

    /**
     * @Route("/TriType1",name="TriType1")
     */
    public function TriType1(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.type', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }
    /**
     * @Route("/TriNom2",name="TriNom2")
     */
    public function TriNom2(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.nom', 'ASC')
            ->getQuery();
        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front2/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }

    /**
     * @Route("/listFormation2",name="listFormation2")
     */
    public function listForm2(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front2/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }


    /**
     * @Route("/listFormation3",name="listFormation3")
     *  resource:   "@EndroidQrCodeBundle/Controller/"
     *  type:       annotation
     * prefix:     /qrcode
     */
    public function listForm3(Request $request, FormationRepository $repository, PaginatorInterface $paginator)
    {

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Formation::class);

        // Find all the  formations on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $formations = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );


        return $this->render('front3/listFormation.html.twig', array(
            "listFormation" => $formations,));
    }


}