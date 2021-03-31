<?php

namespace App\Controller;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use App\Security\UsersAuthenticator;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\EventRepository;
use App\Form\EventType;
use App\Form\FormationType;
use App\Entity\Formation;
use App\Form\SearchEventType;
use App\Form\SearchFormationType;
use App\Repository\FormationRepository;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class EventController extends AbstractController
{
    /**
     * @Route("/event", name="event")
     */
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }



    /**
     * @Route("/admin/listEvent",name="listEventA")
     */


    public function listEventA(Request $request, EventRepository $repository,PaginatorInterface $paginator)
    {


        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $lieu = $searchForm->getData()->getLieu();
            $resultOfSearch = $repository->searchEvent($lieu);
            return $this->render('event/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $events = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('event/listEvent.html.twig', array(
            "events" => $events,

            "searchEvent" => $searchForm->createView()));
    }


    /**
     * @Route("/TriS",name="TriS")
     */


    public function TriStart(Request $request, EventRepository $repository,PaginatorInterface $paginator)
    {


        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $lieu = $searchForm->getData()->getLieu();
            $resultOfSearch = $repository->searchEvent($lieu);
            return $this->render('event/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.start', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $events = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('event/listEvent.html.twig', array(
            "events" => $events,

            "searchEvent" => $searchForm->createView()));
    }

    /**
     * @Route("/TriCap",name="TriCap")
     */


    public function TriCap(Request $request, EventRepository $repository,PaginatorInterface $paginator)
    {


        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $lieu = $searchForm->getData()->getLieu();
            $resultOfSearch = $repository->searchEvent($lieu);
            return $this->render('event/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.capacite', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $events = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('event/listEvent.html.twig', array(
            "events" => $events,

            "searchEvent" => $searchForm->createView()));
    }



    /**
     * @Route("/TriL",name="TriL")
     */


    public function TriLieu(Request $request, EventRepository $repository,PaginatorInterface $paginator)
    {


        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $lieu = $searchForm->getData()->getLieu();
            $resultOfSearch = $repository->searchEvent($lieu);
            return $this->render('event/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.lieu', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $events = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('event/listEvent.html.twig', array(
            "events" => $events,

            "searchEvent" => $searchForm->createView()));
    }

    /**
     * @Route("/Tri",name="Tri")
     */


    public function TriTitre(Request $request, EventRepository $repository,PaginatorInterface $paginator)
    {


        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $lieu = $searchForm->getData()->getLieu();
            $resultOfSearch = $repository->searchEvent($lieu);
            return $this->render('event/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.title', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $events = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('event/listEvent.html.twig', array(
            "events" => $events,

            "searchEvent" => $searchForm->createView()));
    }


    /**
     * @Route("/TriE",name="TriE")
     */


    public function TriEnd(Request $request, EventRepository $repository,PaginatorInterface $paginator)
    {


        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $lieu = $searchForm->getData()->getLieu();
            $resultOfSearch = $repository->searchEvent($lieu);
            return $this->render('event/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.end', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $events = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('event/listEvent.html.twig', array(
            "events" => $events,

            "searchEvent" => $searchForm->createView()));
    }

    /**
     * @Route("/TriDescription",name="TriDescription")
     */


    public function TriDescription(Request $request, EventRepository $repository,PaginatorInterface $paginator)
    {


        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $lieu = $searchForm->getData()->getLieu();
            $resultOfSearch = $repository->searchEvent($lieu);
            return $this->render('event/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of events, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.description', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $events = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('event/listEvent.html.twig', array(
            "events" => $events,

            "searchEvent" => $searchForm->createView()));
    }










    /**
     * @param $id
     * @Route("/deleteEvent/{id}",name="deleteEvent")
     */
    public function deleteEvent($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository(Event::class)->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute("listEventA");


    }




    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/ajouterEvent" , name="ajouterEvent")
     */
    public function ajouterEvent(Request $request)
    {
        $event= new Event();
        $form= $this->createForm(EventType::class,$event);
        $form->add( 'ajouter', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile)
            {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $event->setImage($newFilename);
            }
            $em=$this->getDoctrine()->getManager();
            $em->persist($event);
            $em-> flush();
            return $this->redirectToRoute('listEventA');

        }
        return $this->render('event/addEvent.html.twig', ['formAjouterevent' => $form->createView()]);
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/admin/updateEvent/{id}", name="updateEvent")
     */
    public function updateEvent($id, Request $request)
    {
        $event= $this->getDoctrine()->getRepository(Event::class)->findBy(['id' => $id])[0];
        $form = $this->createForm(EventType::class, $event);
        $form->add( 'modifier', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile)
            {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $event->setImage($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listEventA');

        }
        return $this->render('event/updateEvent.html.twig', ['formModevent' => $form->createView()]);

    }



    /**
     * @Route("/show/{id}", name="showFormation")
     */
    public function showFormation($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);


        $formations= $this->getDoctrine()->getRepository(Formation::class)->listFormationByEvent($events->getId());
        return $this->render('event/show.html.twig', array(
            "formations" => $formations,
            "events"=>$events));
    }
    /**
     * @Route("/frontshow/{id}", name="frontshow")
     */
    public function showFormationF($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);


        $formations= $this->getDoctrine()->getRepository(Formation::class)->listFormationByEvent($events->getId());
        return $this->render('front/show.html.twig', array(
            "formations" => $formations,
            "events"=>$events));
    }
    /**
     * @Route("/frontshow3/{id}", name="frontshow3")
     */
    public function showFormationF3($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);


        $formations= $this->getDoctrine()->getRepository(Formation::class)->listFormationByEvent($events->getId());
        return $this->render('front3/show.html.twig', array(
            "formations" => $formations,
            "events"=>$events));
    }
    /**
     * @Route("/frontshow2/{id}", name="frontshow2")
     */
    public function showFormationF2($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);


        $formations= $this->getDoctrine()->getRepository(Formation::class)->listFormationByEvent($events->getId());
        return $this->render('front2/show.html.twig', array(
            "formations" => $formations,
            "events"=>$events));
    }
    /**
     * @Route("/statsf", name="statsf")
     */
    public function statistiques(FormationRepository $formationRepo){

        // On va chercher le nombre d'annonces publiées par date
        $formations = $formationRepo->countByEvent();

        $titles = [];
        $formationsCount = [];

        // On "démonte" les données pour les séparer tel qu'attendu par ChartJS
        foreach($formations as $formation){
            $titles[] = $formation['titre'];
            $formationsCount[] = $formation['formationsNombre'];
        }

        return $this->render('event/statf.html.twig', [

            'titles' => json_encode($titles),
            'formationsCount' => json_encode($formationsCount),
        ]);
    }

    /**
     * @Route("/mainE", name="mainE")
     */
    public function main(EventRepository $calendar)
    { $events=$calendar->findAll();
        $rdvs= [];
        foreach ($events as $events){
            $rdvs[]= [ 'id'=>$events->getId(),
                'start'=>$events->getStart()->format('Y-m-d H:i:s'),
                'lieu'=>$events->getLieu(),
                'image'=>$events->getImage(),
                'end'=>$events->getEnd()->format('Y-m-d H:i:s'),
                'title'=>$events->getTitle(),
                'description'=>$events->getDescription(),
                'all_day'=>$events->getAllDay(),

            ];


        }
        $data= json_encode($rdvs);
        return $this->render('event/main.html.twig',compact('data') );
    }
    /**
     * @Route("/mainEF", name="mainEF")
     */
    public function mainFront(EventRepository $calendar)
    { $events=$calendar->findAll();
        $rdvs= [];
        foreach ($events as $events){
            $rdvs[]= [ 'id'=>$events->getId(),
                'start'=>$events->getStart()->format('Y-m-d H:i:s'),
                'lieu'=>$events->getLieu(),
                'image'=>$events->getImage(),
                'end'=>$events->getEnd()->format('Y-m-d H:i:s'),
                'title'=>$events->getTitle(),
                'description'=>$events->getDescription(),
                'all_day'=>$events->getAllDay(),

            ];


        }
        $data= json_encode($rdvs);
        return $this->render('front/main.html.twig',compact('data') );
    }
    /**
     * @Route("/mainEF3", name="mainEF3")
     */
    public function mainFront3(EventRepository $calendar)
    { $events=$calendar->findAll();
        $rdvs= [];
        foreach ($events as $events){
            $rdvs[]= [ 'id'=>$events->getId(),
                'start'=>$events->getStart()->format('Y-m-d H:i:s'),
                'lieu'=>$events->getLieu(),
                'image'=>$events->getImage(),
                'end'=>$events->getEnd()->format('Y-m-d H:i:s'),
                'title'=>$events->getTitle(),
                'description'=>$events->getDescription(),
                'all_day'=>$events->getAllDay(),

            ];


        }
        $data= json_encode($rdvs);
        return $this->render('front3/main.html.twig',compact('data') );
    }

    /**
     * @Route("/mainEF2", name="mainEF2")
     */
    public function mainFront2(EventRepository $calendar)
    { $events=$calendar->findAll();
        $rdvs= [];
        foreach ($events as $events){
            $rdvs[]= [ 'id'=>$events->getId(),
                'start'=>$events->getStart()->format('Y-m-d H:i:s'),
                'lieu'=>$events->getLieu(),
                'image'=>$events->getImage(),
                'end'=>$events->getEnd()->format('Y-m-d H:i:s'),
                'title'=>$events->getTitle(),
                'description'=>$events->getDescription(),
                'all_day'=>$events->getAllDay(),

            ];


        }
        $data= json_encode($rdvs);
        return $this->render('front2/main.html.twig',compact('data') );
    }


    /**
    @Route("/CardForm",name="CardForm")
     */
    public function Card( Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {
        //All events
        $event = $repository->findAll();
        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $event = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );



        return $this->render('event/event.html.twig', array(
            "event" => $event,));
    }
    /**
     * @Route("/listEvent",name="listEvent")
     *  resource:   "@EndroidQrCodeBundle/Controller/"
       *  type:       annotation
       * prefix:     /qrcode
     */
    public function listEvent(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriCapacite",name="TriCapacite")
     */
    public function TriCapacite(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.capacite', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TristartF",name="TristartF")
     */
    public function TristartF(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.start', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TristartF3",name="TristartF3")
     */
    public function TristartF3(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu3
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front3/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.start', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front3/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TristartF2",name="TristartF2")
     */
    public function TristartF2(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front2/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.start', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front2/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriLieu3",name="TriLieu3")
     */
    public function TriLieuF3(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front3/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.lieu', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front3/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriLieu2",name="TriLieu2")
     */
    public function TriLieuF2(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front2/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.lieu', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front2/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriLieu",name="TriLieu")
     */
    public function TriLieuF(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.lieu', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriTitle3",name="TriTitle3")
     */
    public function TriTitleF3(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front3/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.title', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front3/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriTitle2",name="TriTitle2")
     */
    public function TriTitleF2(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front2/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.title', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front2/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriTitle",name="TriTitle")
     */
    public function TriTitleF(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.title', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/Triend3",name="Triend3")
     */
    public function TriEndF3(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front3/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.end', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front3/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/Triend2",name="Triend2")
     */
    public function TriEndF2(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front2/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.end', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front2/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/Triend",name="Triend")
     */
    public function TriEndF(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.end', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriDescription",name="TriDescription")
     */
    public function TriDescriptionF(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.description', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriDescription3",name="TriDescription3")
     */
    public function TriDescriptionF3(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front3/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.description', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front3/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriDescription2",name="TriDescription2")
     */
    public function TriDescriptionF2(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front2/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.description', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front2/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriCapacite",name="TriCapacite")
     */
    public function TriCapaciteF(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.capacite', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/TriCapacite2",name="TriCapacite2")
     */
    public function TriCapaciteF2(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front2/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.capacite', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front2/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }

    /**
     * @Route("/TriCapacite3",name="TriCapacite3")
     */
    public function TriCapaciteF3(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    {

        //search by lieu
        $searchForm = $this->createForm(SearchEventType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $title = $searchForm->getData()->getTitle();
            $resultOfSearch = $repository->searchEvent($title);
            return $this->render('front3/searchEvent.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchEvent" => $searchForm->createView()));


        }

        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->orderBy('p.capacite', 'ASC')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front3/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }

    /**
     * @Route("/listEvent3",name="listEvent3")
     */
    public function listEvent3(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    { $listEvent = $repository->findAll();


        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front3/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/listEvent2",name="listEvent2")
     */
    public function listEvent2(Request $request,EventRepository $repository,PaginatorInterface $paginator)
    { $listEvent = $repository->findAll();


        // pagination
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $appointmentsRepository = $em->getRepository(Event::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allAppointmentsQuery = $appointmentsRepository->createQueryBuilder('p')
            ->where('p.id != :id')
            ->setParameter('id', 'canceled')
            ->setParameter('id', 'canceled')
            ->getQuery();

        // Paginate the results of the query
        $listEvent = $paginator->paginate(
        // Doctrine Query, not results
            $allAppointmentsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2
        );


        return $this->render('front2/listEvent.html.twig', [
            'listEvent' => $listEvent
        ]);

    }
    /**
     * @Route("/pdf", name="pdf")
     */
    public function pdf(Request $request, EventRepository $repository)
    {
        //All events
        $events = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('event/mypdf.html.twig', [
            'title' => "Welcome to our PDF Test","events" => $events
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
     * @Route("/pdff", name="pdff")
     */
    public function pdff(Request $request, EventRepository $repository)
    {
        //All formations
        $events = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('front/pdf.html.twig', [
            'title' => "Welcome to our PDF Test","events" => $events
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
     * @Route("/pdff3", name="pdff3")
     */
    public function pdff3(Request $request, EventRepository $repository)
    {
        //All formations
        $events = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('front3/pdf.html.twig', [
            'title' => "Welcome to our PDF Test","events" => $events
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
     * @Route("/pdff2", name="pdff2")
     */
    public function pdff2(Request $request, EventRepository $repository)
    {
        //All formations
        $events = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('front2/pdf.html.twig', [
            'title' => "Welcome to our PDF Test","events" => $events
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
     * @Route("/pdff4", name="pdff4")
     */
    public function pdff4(Request $request, EventRepository $repository)
    {
        //All formations
        $events = $repository->findAll();

// Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('front2/pdf.html.twig', [
            'title' => "Welcome to our PDF Test","events" => $events
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
     * @Route("/map", name="map")
     */
    public function map(EventRepository $repository)
    {     //All events
        $events = $repository->findAll();
        return $this->render('event/map.html.twig', [
            'events' => $events
        ]);
    }

    /**
     * @Route("/mapf", name="mapf")
     */
    public function mapf(EventRepository $repository)
    {     //All events
        $events = $repository->findAll();
        return $this->render('front/map.html.twig', [
            'events' => $events
        ]);
    }
    /**
     * @Route("/mapf3", name="mapf3")
     */
    public function mapf3(EventRepository $repository)
    {     //All events
        $events = $repository->findAll();
        return $this->render('front3/map.html.twig', [
            'events' => $events
        ]);
    }
    /**
     * @Route("/mapf2", name="mapf2")
     */
    public function mapf2(EventRepository $repository)
    {     //All events
        $events = $repository->findAll();
        return $this->render('front2/map.html.twig', [
            'events' => $events
        ]);
    }
    /**


    /**
     * @Route("/MAPPED/{id}", name="MAPPED")
     */
    public function MAPPED($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);
        return $this->render('front/mapindiv.html.twig', array("events" => $events));
    }
    /**
     * @Route("/MAPPED3/{id}", name="MAPPED3")
     */
    public function MAPPED3($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);
        return $this->render('front3/mapindiv.html.twig', array("events" => $events));
    }
    /**
     * @Route("/MAPPED2/{id}", name="MAPPED2")
     */
    public function MAPPED2($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);
        return $this->render('front2/mapindiv.html.twig', array("events" => $events));
    }

    /**
     * @Route("/MAPPEDb/{id}", name="MAPPEDb")
     */
    public function MAPPEDb($id)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->find($id);
        return $this->render('event/mapindiv.html.twig', array("e" => $events));
    }


    /**
     * @Route("/rech", name="rech")
     */
    public function search(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $name= $request->get('q');
        $entities=$em->getRepository(Event::class)->Search($name);

        if(!$entities) {
            $result['entitiess']['error'] = "Aucun event trouvé";
        } else {
            $result['entitiess'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }



    public function getRealEntities($events){

        foreach ($events as $p){

            $realEntities[$p->getStart()] = [$p->getLieu(),$p->getTitle(),$p->getEnd(),$p->getCapacite(), $p->getDescription(),$p->getImage()];
        }

        return $realEntities;
    }





}
