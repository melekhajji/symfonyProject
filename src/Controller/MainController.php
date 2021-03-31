<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    /**
     * @Route("/affindex", name="affindex")
     */
    public function index2(): Response
    {
        return $this->render('homefront.html.twig');

    }

    /**
     * @Route("/affindex2", name="affindex2")
     */
    public function index3(): Response
    {
        return $this->render('candidat.html.twig');

    }

    /**
     * @Route("/affindex3", name="affindex3")
     */
    public function index4(): Response
    {
        return $this->render('entreprisefront.html.twig');

    }
}
