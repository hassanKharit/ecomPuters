<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisationResponsableController extends AbstractController
{
    #[Route('/utilisation/responsable', name: 'app_utilisationresponsable')]
    public function index(): Response
    {
        return $this->render('utilisation_responsable/index.html.twig', [
            'controller_name' => 'UtilisationResponsableController',
        ]);
    }
}
