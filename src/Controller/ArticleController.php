<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\ArticleType;
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
        $form->handleRequest($req);
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
            return $this->redirectToRoute('affichage_blog_Back');
        }

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
    public function afficherArticleBack(){
        $listArticle=$this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('article/afficherArticleBack.html.twig',array('articles'=>$listArticle));
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
        return $this->redirectToRoute("affichage_blog_Back");
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
                return $this->redirectToRoute('affichage_blog_Back');
            }
            catch(Error $e){}
        }
        return $this->render('article/modifierArticle.html.twig',array('article'=>$articleToModify));
    }
}
