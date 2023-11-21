<?php

namespace App\Controller;

use App\Form\EditProfileType;
use App\Service\FileUploader;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/profile')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_profile_show', methods: ['GET'])]
    public function show(): Response
    {
        $monuser = $this->getUser();
        return $this->render('user/show.html.twig', [
            'user' => $monuser,
        ]);
    }

    #[Route('/modifier', name: 'app_user_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, SluggerInterface $slugger, FileUploader $fileUploader): Response
    {
        $monuser = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $monuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monuser->setUpdatedAt(new \DateTimeImmutable());

            $avatar = $form->get('avatar')->getData();
            if ($avatar) {
                // on utilise le service fileUploader
                // pour envoyé l'image dans le public/img
                $avatar_nom = $fileUploader->upload($avatar);
                
                // envoyé dans l'entité le nom de l'image
                $monuser->setAvatar($avatar_nom);
            }

            $userRepository->save($monuser, true);

            $this->addFlash(
                'message',
                'Profil mis a jour'
            );

            return $this->redirectToRoute('app_user_profile_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $monuser,
            'form' => $form,
        ]);
    }
}
