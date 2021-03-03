<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\DBAL\Driver\SQLSrv\Exception\Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        if ($req->isMethod("post")){
            $article->setTitre($req->get("titre"));
            $article->setDescription($req->get("description"));
            $time = new \DateTime();
            $article->setCreatedAt($time);
            $article->setImage($req->get('image'));

           /* $ImageFile = $req->get('brochure')->getData();
            if ($ImageFile) {
                $ImageFile = $file->upload($ImageFile);
                $article->setImage($ImageFile);
            }*/
            try{
                $em->persist($article);
                $em->flush();
            }
            catch(Error $e){

            }


        }
        return $this->render('article/ajouterArticle.html.twig', [
            'controller_name' => 'ArticleController',
        ]);

    }
    /**
     * @Route("/afficher", name="affichage_blog")
     */
    public function afficherArticle(){
        $listArticle=$this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('front/blog.html.twig',array('articles'=>$listArticle));
    }
}
