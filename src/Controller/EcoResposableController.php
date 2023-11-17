<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EcoResposableController extends AbstractController
{
    #[Route('/ecoresposable', name: 'app_ecoresposable')]
    public function index(): Response
    {
        return $this->render('ecoresposable/index.html.twig', [
            'controller_name' => 'EcoResposableController',
        ]);
    }
}
