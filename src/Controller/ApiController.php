<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class ApiController extends AbstractController
{

    /**
     * @Route("/api/{id}/edit", name="api_event_edit",methods={"PUT"})

     */

    public function majEvent(?Event $events,Request $request): Response
    {
        // On décode les données envoyées


        $donnees = json_decode($request->getContent());
        if(isset($donnees->start) && !empty($donnees->start)&&
 isset($donnees->lieu) && !empty($donnees->lieu)&&
  isset($donnees->image) && !empty($donnees->image)&&
   isset($donnees->title) && !empty($donnees->title)&&
     isset($donnees->end) && !empty($donnees->end)&&
       isset($donnees->description) && !empty($donnees->description)&&
         isset($donnees->allday) && !empty($donnees->allday)&&
           isset($donnees->backgroundcolor) && !empty($donnees->backgroundcolor)&&
             isset($donnees->bordercolor) && !empty($donnees->bordercolor)&&
               isset($donnees->textcolor) && !empty($donnees->textcolor))

        {
// les données sont completes

//on verifie si l'id existe
            if(!$events)
            {
                // on instacier un event
                $events=new Event();


                //on hydrate l'objet avec les données
              //  $events= $this->getDoctrine()->getRepository(Event::class)->findBy(['id' => $id])[0];
                $events->setStart(new DateTime($donnees->start));
                $events->setLieu($donnees->lieu);
                $events->setImage($donnees->image);
                $events->setTitle($donnees->title);
                $events->setStart(new DateTime($donnees->start));
                if($donnees->allday){
                    $events->setEnd(new DateTime($donnees->start));
                }
                else {    $events->setEnd(new DateTime($donnees->end));                         }

                $events->setDescription($donnees->description);
                $events->setAllDay($donnees->allday);
                $events->setBackgroundColor($donnees->backgroundcolor);
                $events->setBorderColor($donnees->bordercolor);
                $events->setTextColor($donnees->textcolor);




                // On sauvegarde en base
                $em = $this->getDoctrine()->getManager();


                $em->persist($events);
                $em->flush();
                //on retourne le code
                return  new Response('ok',201);

                }

        }
        else{


//les données ne sont pas completes

            return new Response('Failed', 404);

    }







        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }




}
