<?php
namespace App\Controller;
use App\Form\QuestionType;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\QuizType;

use App\Repository\QuizRepository;
use Knp\Component\Pager\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class IndexController extends AbstractController

{
    /**
     * @Route("/admin/listQuestion",name="questionlist")
     */

    public function home()
    {
        $questions = $this->getDoctrine()->getRepository(Question::class)->findAll();
        return $this->render('front/index.html.twig', ['questions' => $questions]);
    }


    public function getRealEntities($posts)
    {
        foreach ($posts as $post) {
            $realEntities[$post->getId()] = [$post->getTheme()];

        }
        return $realEntities;
    }


    /**
     * @Route("/search/",name="search")
     */
    public function search(Request $request)
    {
        $requestString = $request->get('q');
        $posts = $this->getDoctrine()->getRepository(Quiz::class)->findLike($requestString);
        if (!$posts) {
            $result['posts']['error'] = 'Aucun quiz trouvé';
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }


    /**
     * @Route("/searchAll/",name="searchAll")
     */
    public function searchAll(Request $request, PaginatorInterface $paginator)
    {
        $questions = $this->getDoctrine()->getRepository(Quiz::class)->findAllLike($_POST['mot']);
        if (!isset($_POST['mot']))
            $questions = $this->getDoctrine()->getRepository(Quiz::class)->findAll();
        $quizs = $paginator->paginate(
            $questions, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('front/affichageQuiz.html.twig', ['quizs' => $quizs]);
    }


    /**
     * @Route("/admin/ajouterQuestion", name="ajouterQuestion")
     * Method({"GET", "POST"})
     */

    public function new(Request $request)
    {
        $question = new Question();

        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('questionlist');
        }
        return $this->render('questions/new.html.twig', ['form' => $form->createView()]);
    }




    /**
     * @Route("/admin/detailQuestion/{id}", name ="questionShow")
     */

    public function show($id)
    {
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);

        return $this->render('questions/show.html.twig', array('question' => $question));
    }

    /**
     * @Route("/admin/modifierQuestion/{id}", name="modifierQuestion")
     * Method({"GET", "POST"})
     */


    public function edit(Request $request, $id)
    {
        $question = new Question();
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);

        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('questionlist');
        }

        return $this->render('questions/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/deleteQustion/{id}",name="delete_question")
     * @Method({"GET"})
     */

    public function delete(Request $request, $id)
    {
        $question = $this->getDoctrine()->getRepository(Question::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($question);
        $entityManager->flush();

        return $this->redirectToRoute('questionlist');
    }

    /**
     * @Route("/admin/ajoutQuiz", name="ajoutQuiz")
     * Method({"GET", "POST"})
     */

    public function newQuiz(Request $request)
    {
        $quiz = new Quiz();

        $form = $this->createForm(QuizType::class, $quiz);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quiz = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quiz);
            $entityManager->flush();
            return $this->redirectToRoute('listQuiz');
        }
        return $this->render('questions/newQuiz.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("admin/listQuiz",name="listQuiz")
     */

    public function homeQuiz()
    {

        $quizs = $this->getDoctrine()->getRepository(Quiz::class)->findAll();
        return $this->render('quiz/index.html.twig', ['quizs' => $quizs]);
    }


    /**
     * @Route("/suppQuiz/{id}",name="suppQuiz")
     * @Method({"GET"})
     */

    public function deleteQuiz(Request $request, $id)
    {
        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($quiz);
        $entityManager->flush();

        return $this->redirectToRoute('listQuiz');
    }

    /**
     * @Route("admin/modifierQuiz/{id}", name="modifierQuiz")
     * Method({"GET", "POST"})
     */


    public function editQuiz(Request $request, $id)
    {
        $quiz = new Quiz();
        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);

        $form = $this->createForm(QuizType::class, $quiz);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('listQuiz');
        }

        return $this->render('questions/editQuiz.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/detailQuiz/{id}",name="detailQuestion")
     */

    public function detailQuiz($id)
    {
        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);
        $questions = $this->getDoctrine()->getRepository(Question::class)->findBy(array('quiz' => $quiz));
        return $this->render('front/detailQuiz.html.twig', ['questions' => $questions]);
    }


    /**
     * @Route("/listQuizF",name="listQuizF")
     */

    public function homeQuizF(Request $request, PaginatorInterface $paginator)
    {

        $quizs1 = $this->getDoctrine()->getRepository(Quiz::class)->findAll();
        $quizs = $paginator->paginate(
            $quizs1, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('front/affichageQuiz.html.twig', ['quizs' => $quizs]);
    }

    /**
     * @Route("/FiltrerQuizF",name="FiltrerQuizF")
     */

    public function FiltrerQuizF(Request $request, PaginatorInterface $paginator)
    {
        $quizs1 = $this->getDoctrine()->getRepository(Quiz::class)->findAllBy($_POST['dureeMin'], $_POST['dureeMax'], $_POST['nbMin'], $_POST['nbMax']);
        $quizs = $paginator->paginate(
            $quizs1, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('front/affichageQuiz.html.twig', ['quizs' => $quizs]);
    }

    /**
     * @Route("/Quiz/{id}",name="Quiz", methods={"GET","POST"})

     */


    public function detailQuizF($id,Request $request): Response
    {
        $quiz = $this->getDoctrine()->getRepository(Quiz::class)->find($id);;
        $Questionrep = $this->getDoctrine()->getRepository(Question::class)->findOneBy(array('quiz' => $id));

        $que = new Question();

        $form = $this->createFormBuilder($que)
            ->add('reponse', TextType::class)
            ->add('btn', SubmitType::class, ['label' => 'Valider'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {
            $data = $form["reponse"]->getData();
            if($data==$Questionrep->getReponse())
            {
                //ken s7i7
                var_dump($quiz->getNbquestion());

            }
            else
            {
                //ken 8alet

            }

        }
        return $this->render('front/quizF.html.twig', ['quiz' => $quiz,'form' => $form->createView()]);
    }








    /**
     * @Route("/trierq",name="trierq")
     */
    public function Triquiz (Request $request, QuizRepository $repository)
    {
        $quizs = $repository->orderByTheme();
        return $this->render('quiz/index.html.twig', array( "quizs" => $quizs,));
    }

}