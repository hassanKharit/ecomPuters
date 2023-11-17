<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SAVController extends AbstractController
{
    #[Route('/sav', name: 'app_sav')]
    public function index(): Response
    {
        return $this->render('sav/index.html.twig', [
            'controller_name' => 'SAVController',
        ]);
    }
}
