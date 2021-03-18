<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;

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

    /**
     * Chercher et afficher un stage.
     * @Route("/stage/{id}", name="stage.show", requirements={"id" = "\d+"})
     * @param Stage $stage
     * @return Response 
     */
    public function show(Stage $stage): Response
    {
        return $this->render(
            'stage/show.html.twig',
            [
                'stage' => $stage,
            ]
        );
    }
}
