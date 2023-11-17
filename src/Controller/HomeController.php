<?php

namespace App\Controller;

use App\Entity\CategoriesHome;
use App\Repository\CategoriesHomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoriesHomeRepository $categoriesHomeRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categoriesHome' => $categoriesHomeRepository->findAll(),
        ]);
    }
}
