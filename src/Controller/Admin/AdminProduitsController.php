<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/produits')]
class AdminProduitsController extends AbstractController
{
    #[Route('/', name: 'app_admin_produits_index', methods: ['GET'])]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('admin/produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_produits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitsRepository $produitsRepository): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->save($produit, true);

            return $this->redirectToRoute('app_admin_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_produits_show', methods: ['GET'])]
    public function show(Produits $produit): Response
    {
        return $this->render('admin/produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_admin_produits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        

        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->save($produit, true);

            return $this->redirectToRoute('app_admin_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_produits_delete', methods: ['POST'])]
    public function delete(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitsRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_admin_produits_index', [], Response::HTTP_SEE_OTHER);
    }
}
