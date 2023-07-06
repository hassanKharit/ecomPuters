<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvoirsController extends AbstractController
{
    #[Route('/avoirs', name: 'app_avoirs')]
    public function index(): Response
    {
        return $this->render('avoirs/index.html.twig', [
            'controller_name' => 'AvoirsController',
        ]);
    }
}
