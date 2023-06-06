<?php

namespace App\Controller;

use App\Repository\CommentairesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search', methods: ['GET'])]
    public function index(Request $request, CommentairesRepository $commentairesRepository): Response
    {
        $searchTerm = $request->query->get('search');
        $results = [];

        if ($searchTerm) {
            // Effectuer la recherche dans le repository en utilisant la méthode chercherCommentaire()
            $results = $commentairesRepository->chercherCommentaire($searchTerm);
        }

        return $this->render('search/index.html.twig', [
            'results' => $results,
            'searchTerm' => $searchTerm,
        ]);
    }
}
