<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid())
        {
            $contact=$form->getData();

            if($this->getUser())
            {
                $contact->setNom($this->getUser()->getNom()).
                $contact->setPrenom($this->getUser()->getPrenom())
                    ->setEmail($this->getUser()->getEmail());
            }

            $manager->persist($contact);
            $manager->flush();

            // $email = (new TemplatedEmail())
            // ->from($contact->getEmail())
            // ->to('log@adei-france.fr')
            // //->cc('cc@example.com')
            // //->bcc('bcc@example.com')
            // //->replyTo('fabien@example.com')
            // //->priority(Email::PRIORITY_HIGH)
            // ->subject($contact->getSubject())
            //       // chemin du template de la twig à la vue(view)
            // ->htmlTemplate('emails/contact.html.twig')
                  
            //       // passer la variable (nom => valeur) au template
            //       ->context([
            //           'contact' => $contact,
            //       ]);

            //   $mailer->send($email);

                  $this->addFlash(
                      'succes',
                      'Votre demande a été envoyé avec succès !'
                  );

            $this->addFlash(
                'succes',
                'Votre demande a été envoyé avec succès !'
            );


        }


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}