<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StageController extends AbstractController
{

    /** 
     * Lister tous les stages. 
     * @Route("/stage/", name="stage.list") 
     * @return Response 
     */
    public function list(): Response
    {
        $stages = $this->getDoctrine()->getRepository(Stage::class)->findAll();

        return $this->render('stage/list.html.twig', [
            'stages' => $stages,
        ]);
    }
}
