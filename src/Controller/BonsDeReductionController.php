<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BonsDeReductionController extends AbstractController
{
    #[Route('/bons/de/reduction', name: 'app_bons_de_reduction')]
    public function index(): Response
    {
        return $this->render('bons_de_reduction/index.html.twig', [
            'controller_name' => 'BonsDeReductionController',
        ]);
    }
}
