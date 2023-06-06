<?php

namespace App\Controller;

use App\Repository\CommentairesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, CommentairesRepository $ar): Response {

        $recherche = $request->query->get('search');

        if (!empty($recherche)) {
            $resultats = $ar->chercherCommentaire($recherche);
        } else {
            $resultats = $ar->findAll();
        }

        return $this->render('affichage', [
            'resultats' => $resultats
        ]);
    }
}
