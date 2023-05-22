<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/cart')]

class CartController extends AbstractController
{
    #[Route('/ajouter/{id}', name: 'app_cart_add')]
    public function addcart($id, CartService $cartService )
    {
        $cartService->add($id);

        return $this->redirectToRoute("app_cart_show",[], Response::HTTP_SEE_OTHER);

    }

    #[Route('/show', name: 'app_cart_show')]
    public function show( CartService $cartService )
    {
        return $this->render('cart/index.html.twig', [
            'panier'=> $cartService->show(),
            'totalcomplet'=> $cartService->getTotalAll(),

        ]);

    }

    #[Route('/clear', name: 'app_cart_clear')]
    public function clear( CartService $cartService )
    {
        $cartService->clear();

        return $this->redirectToRoute("app_produits_index",[], Response::HTTP_SEE_OTHER);

    }

    #[Route('/remove/{id}', name: 'app_cart_remove')]
    public function remove( CartService $cartService, $id )
    {
        $cartService->remove_all($id);

        return $this->redirectToRoute("app_cart_show",[], Response::HTTP_SEE_OTHER);

    }

    #[Route('/removequantite/{id}', name: 'app_cart_removequantite')]
    public function removequantite( CartService $cartService, $id )
    {
        $cartService->remove($id);

        return $this->redirectToRoute("app_cart_show",[], Response::HTTP_SEE_OTHER);

    }
    

    
}