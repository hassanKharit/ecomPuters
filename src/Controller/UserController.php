<?php

namespace App\Controller;

use App\Form\EditProfileType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/profile')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_profile_show', methods: ['GET'])]
    public function show(): Response
    {
        $monuser=$this->getUser();
        return $this->render('user/show.html.twig', [
            'user' => $monuser,
        ]);
    }

    #[Route('/modifier', name: 'app_user_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository): Response
    {
        $monuser=$this->getUser();
        $form = $this->createForm(EditProfileType::class, $monuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monuser->setUpdatedAt(new \DateTimeImmutable());
            $userRepository->save($monuser, true);


            return $this->redirectToRoute('app_user_profile_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $monuser,
            'form' => $form,
        ]);
    }
}

