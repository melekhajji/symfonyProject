<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }
    /**
     * @Route("/ajoutercommentaire/{id}", name="Ajoutcommentaire")
     */
    public function ajouterCommenataire(Request $req,$id){
        $em=$this->getDoctrine()->getManager();
        $article= $this->getDoctrine()->getRepository(Article::class)->find($id);
        $listCommentaire=$this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idArticle'=>$article));
        $nbreC=count($listCommentaire);
        var_dump($nbreC);
        $commentaire=new Commentaire();
        if($req->isMethod('post')){
            $today=new \DateTime();
            $commentaire->setCreatedAt($today);
            $commentaire->setEmail($req->get('email'));
            $commentaire->setIdArticle($article);
            $commentaire->setMessage($req->get('message'));
            $commentaire->setName($req->get('name'));
            $commentaire->setWebsite($req->get('website'));
            try{
                $em->persist($commentaire);
                $em->flush();
                return $this->redirectToRoute('Ajoutcommentaire',array('id'=>$id));
            }
            catch(Exception $e){}
        }
  return $this->render('front/blog-single.html.twig',array('article'=>$article,'comments'=>$listCommentaire,'nbr'=>$nbreC));
    }
    /**
     * @Route("/afficherCommentaire/{id}", name="afficherCommentaire")
     */
    public function afficherCommentairesParArticle($id){
        $article= $this->getDoctrine()->getRepository(Article::class)->find($id);
        $listCommentaire=$this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idArticle'=>$article));
        $nbr=count($listCommentaire);
        return $this->render('front/blog-single.html.twig',array('comments'=>$listCommentaire,'article'=>$article,'nbr'=>nbr));
    }
}
