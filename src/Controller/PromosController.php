<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromosController extends AbstractController
{
    #[Route('/promos', name: 'app_promos')]
    public function index(): Response
    {
        return $this->render('promos/index.html.twig', [
            'controller_name' => 'PromosController',
        ]);
    }
}
