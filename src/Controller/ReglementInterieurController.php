<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReglementInterieurController extends AbstractController
{
    #[Route('/reglement/interieur', name: 'app_reglement_interieur')]
    public function index(): Response
    {
        return $this->render('reglement_interieur/index.html.twig', [
            'controller_name' => 'ReglementInterieurController',
        ]);
    }
}
