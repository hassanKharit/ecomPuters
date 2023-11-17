<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsDurablesController extends AbstractController
{
    #[Route('/produitsdurables', name: 'app_produitsdurables')]
    public function index(): Response
    {
        return $this->render('produits_durables/index.html.twig', [
            'controller_name' => 'ProduitsDurablesController',
        ]);
    }
}
