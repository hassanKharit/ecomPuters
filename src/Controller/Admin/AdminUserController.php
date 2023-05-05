<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class AdminUserController extends AbstractController
{
    #[Route('/profiles', name: 'app_admin_profiles_index', methods: ['GET'])]
    public function index(UserRepository $userRepository ): Response
    {
        
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/profile/{id}', name: 'app_admin_profile_show', methods: ['GET'])]
    public function adminShow(User $user): Response
    {   
        return $this->render('admin/user/show.html.twig', [
            'user' => $user
        ]);
    }

    // #[Route('/modifier', name: 'app_user_profile_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, UserRepository $userRepository): Response
    // {
    //     $monuser=$this->getUser();
    //     $form = $this->createForm(EditProfileType::class, $monuser);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $userRepository->save($monuser, true);

    //         // $user->setUpdatedAt(new \DateTimeImmutable());

    //         return $this->redirectToRoute('app_user_profile_show', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('user/edit.html.twig', [
    //         'user' => $monuser,
    //         'form' => $form,
    //     ]);
    // }
}