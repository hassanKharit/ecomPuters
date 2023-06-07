<?php

namespace App\Controller;


use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    // #[Route('/search', name: 'app_search')]
    // public function index(Request $request, ProduitsRepository $produitsRepository): Response {

    //     $recherche = $request->query->get('search');

    //     if (!empty($recherche)) {
    //         $resultats = $produitsRepository->chercherProduits($recherche);
    //     } else {
    //         $resultats = $produitsRepository->findAll();
    //     }
    //     dd($recherche);
    //     return $this->render('base.html.twig', [
    //         'resultats' => $resultats,
    //     ]);
    // }
}
