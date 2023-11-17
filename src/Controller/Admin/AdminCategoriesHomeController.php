<?php

namespace App\Controller\Admin;

use App\Entity\CategoriesHome;
use App\Form\CategoriesHomeType;
use App\Repository\CategoriesHomeRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/categories-home')]
class AdminCategoriesHomeController extends AbstractController
{
    #[Route('/', name: 'app_admin_categories_home_index', methods: ['GET'])]
    public function index(CategoriesHomeRepository $categoriesHomeRepository): Response
    {
        return $this->render('admin/categories-home/index.html.twig', [
            'categories_homes' => $categoriesHomeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_categories_home_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriesHomeRepository $categoriesHomeRepository, FileUploader $fileUploader): Response
    {
        $categoriesHome = new CategoriesHome();
        $form = $this->createForm(CategoriesHomeType::class, $categoriesHome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // on recupere l'image issue du formulaire
            // "image" est le nom de notre image dans le form
            $imageCategoriesHome = $form->get('image')->getData();
            // dd($imageproduit);
            
            // le cas ou l'image a été posté
            if ($imageCategoriesHome) {
                // on utilise le service fileUploader
                // pour envoyé l'image dans le public/img
                $imageCategoriesHome_nom = $fileUploader->upload($imageCategoriesHome);
                
                // envoyé dans l'entité le nom de l'image
                $categoriesHome->setImage($imageCategoriesHome_nom);
            }
            $categoriesHomeRepository->save($categoriesHome, true);

            return $this->redirectToRoute('app_admin_categories_home_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/categories-home/new.html.twig', [
            'categories_home' => $categoriesHome,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_categories_home_show', methods: ['GET'])]
    public function show(CategoriesHome $categoriesHome): Response
    {
        return $this->render('admin/categories-home/show.html.twig', [
            'categories_home' => $categoriesHome,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_categories_home_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoriesHome $categoriesHome, CategoriesHomeRepository $categoriesHomeRepository): Response
    {
        $form = $this->createForm(CategoriesHomeType::class, $categoriesHome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesHomeRepository->save($categoriesHome, true);

            return $this->redirectToRoute('app_admin_categories_home_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/categories-home/edit.html.twig', [
            'categories_home' => $categoriesHome,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_categories_home_delete', methods: ['POST'])]
    public function delete(Request $request, CategoriesHome $categoriesHome, CategoriesHomeRepository $categoriesHomeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriesHome->getId(), $request->request->get('_token'))) {
            $categoriesHomeRepository->remove($categoriesHome, true);
        }

        return $this->redirectToRoute('app_admin_categories_home_index', [], Response::HTTP_SEE_OTHER);
    }
}
