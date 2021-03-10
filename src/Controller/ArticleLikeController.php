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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleLikeController extends AbstractController
{
    /**
     * @Route("/articlelike/like-unlike", name="article_Like_Unlike")
     */
    public function Like(Request $request): Response
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $articleId = $request->request->get('entityId');

            $article = $em->getRepository(Article::class)->findOneBy(array('id' => $articleId));

            if(!$article) {
                return new JsonResponse();
            }




                $articleAlreadyLiked =$em->getRepository(articleLike::class)->findOneBy(
                    array('article' =>$article)
                );

                if($articleAlreadyLiked) {
                    $em->remove($articleAlreadyLiked);
                    $em->remove($articleAlreadyLiked);
                    $em->flush();
                    return new JsonResponse();
                }
                else{
                    $like = new ArticleLike();
                    $like->setArticle($article);
                    $em->persist($like);
                    $em->flush();
                }
            }




        return new JsonResponse();

    }



}
