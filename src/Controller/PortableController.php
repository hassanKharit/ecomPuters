<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortableController extends AbstractController
{
    #[Route('/portable', name: 'app_portable')]
    public function index(): Response
    {
        return $this->render('portable/index.html.twig', [
            'controller_name' => 'PortableController',
        ]);
    }
}
