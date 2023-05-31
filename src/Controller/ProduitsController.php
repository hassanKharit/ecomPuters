<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use App\Repository\ProduitsRepository;
use App\Repository\CommentairesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/produits')]
class ProduitsController extends AbstractController
{
    #[Route('/', name: 'app_produits_index')]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_produits_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Produits $produits, CommentairesRepository $commentairesRepository): Response
    {
        $commentaire= new Commentaires();

        $form=$this->createForm(CommentairesType::class, $commentaire);
        $form->handleRequest($request);

        $commentaireparproduit=$commentairesRepository->findBy([
            'produit'=> $produits
        ]);
        
        if ($form->isSubmitted() && $form->isValid()){
            $commentaire->setCreatedAt(new \DateTimeImmutable());
            $commentaire->setUser($this->getUser());
            $commentaire->setProduit($produits);
            $commentairesRepository->save($commentaire,true);

            return $this->redirectToRoute('app_produits_show',['id'=>$produits->getId()], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('produits/show.html.twig', [
            'produit' => $produits,
            'les_commentaires'=> $commentaireparproduit,
            'form'=> $form
        ]);
    }

    public function search(Request $request, Produits $produits)
    {
        $form = $this->createForm(ProduitsSearchType::class);
        $form->handleRequest($request);

        $produits = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchTerm = $data['search'];

            $produits = $this->getDoctrine()
                ->getRepository(Produits::class)
                ->findBySearchTerm($searchTerm);
        }

        return $this->render('article/search.html.twig', [
            'form' => $form->createView(),
            'produit' => $Produits,
        ]);
    }

}
