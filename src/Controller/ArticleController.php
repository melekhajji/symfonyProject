<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleLike;
use App\Entity\Commentaire;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Form\SearchArticleType;
use Doctrine\DBAL\Driver\SQLSrv\Exception\Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/ajouter", name="ajout_article")
     */
    public function ajouterArticle(Request $req){
        $em= $this->getDoctrine()->getManager();
        $article=new Article();
        $form=$this->createForm(ArticleType::class,$article);
        $today=new \DateTime();
        $article->setCreatedAt($today);
        $form->handleRequest($req); //recuperer les varibales du formulaires
        if($form->isSubmitted() && $form->isValid()){
            $file=$article->getImage();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $em=$this->getDoctrine()->getManager();
            $article->setImage($fileName);
            try{
                $file->move(
                    $this->getParameter('ArticleImage_directory'),
                    $fileName
                );
            }
            catch(FileException $e){}
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article2');// thzk l affichage
        }
// kn moch valid u submitted tarja3 l formulaire ta ajout
        return $this->render('article/ajouterArticle.html.twig', array(
            'form' => $form->createView()
        ));
    }
    /**
     * @Route("/afficher", name="affichage_blog")
     */
    public function afficherArticle(){
        $listArticle=$this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('front/blog.html.twig',array('articles'=>$listArticle));
    }

    /**
     * @Route("/afficherback", name="affichage_blog_Back")
     */
    public function  afficherArticleBack(Request $request, ArticleRepository $repository)
    {

        $articles = $repository->findAll();


        //search
        $searchForm = $this->createForm(SearchArticleType::class);
        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $titre = $searchForm->getData()->getTitre();
            $resultOfSearch = $repository->searchArticle($titre);
            return $this->render('article/searchArticle.html.twig', array(
                "resultOfSearch" => $resultOfSearch,
                "searchArticle" => $searchForm->createView()));
        }
        return $this->render('article/afficherArticleBack.html.twig', array(
            "articles" => $articles,

            "searchArticle" => $searchForm->createView()));
    }
    /**
     * @Route("/afficherOne/{id}", name="affichageSingleblog")
     */
    public function afficherSingleArticle($id){
        $article=$this->getDoctrine()->getRepository(Article::class)->find($id);
        $comments=$this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idArticle'=>$article));
        $nbr=count($comments);
        return $this->render('front/blog-single.html.twig', array('article'=>$article,'comments'=>$comments,'nbr'=>$nbr));
    }

    /**
     * @Route("/delete/{id}", name="delete_blog")
     */
    public function supprimerArticle($id){
        $em=$this->getDoctrine()->getManager();
        $articleToRemove= $this->getDoctrine()->getRepository(Article::class)->find($id);
        $em->remove($articleToRemove);
        $em->flush();
        return $this->redirectToRoute("article2");
    }
    /**
     * @Route("/modifier/{id}", name="modifier_article")
     */
    public function modifierArticle(Request $req, $id) {
        $em=$this->getDoctrine()->getManager();
        $articleToModify=$this->getDoctrine()->getRepository(Article::class)->find($id);
        if ($req->isMethod("post")){
            try{
                $articleToModify->setTitre($req->get('titre'));
                $articleToModify->setDescription($req->get('description'));
                $em->merge($articleToModify);
    $em->flush();
                return $this->redirectToRoute('article2');// yarjalii l affichage b donée jdod
            }
            catch(Error $e){}
        }
        return $this->render('article/modifierArticle.html.twig',array('article'=>$articleToModify));
    }




    /**
     * @Route("/article2", name="article2")
     */
    public function affichage(Request $request){
        $search =$request->query->get('article');
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repo->findMulti($search);

        return $this->render('article/recherche.html.twig',
            ["articles" => $articles]);




    }




    /**
     * @Route("/show/{id}", name="show_blog", methods={"GET"})
     */
    public function showArticle(Article $article): Response
    {
        $em=$this->getDoctrine()->getManager();
        $isArticleAlreadyLiked = $em->getRepository(ArticleLike::class)->countByBlog($article);
        return $this->render('front/blog2.html.twig',
            ["article" => $article,
                "isArticleAlreadyLiked" => $isArticleAlreadyLiked]);
    }


}
