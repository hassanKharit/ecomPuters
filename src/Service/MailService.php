<?php

namespace App\Service;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{
    private $mailer;

    public function __construct(MailerInterface $mailerInterface)
    {
        $this->mailer = $mailerInterface;
    }
    public function sendMail($from, $to, $subject, $template, $context): void
    {
        $email = (new TemplatedEmail())
        ->from($from) //$contact->getEmail()
        ->to($to) //'log@adei-france.fr'
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        ->replyTo($from)//$contact->getEmail()
        //->priority(Email::PRIORITY_HIGH)
        ->subject($subject)//$contact->getSubject()
              // chemin du template de la twig à la vue(view)
        ->htmlTemplate("emails/$template.html.twig")//contact
              
              // passer la variable (nom => valeur) au template
              ->context($context); //['contact' => $contact,]

          $this->mailer->send($email);
    }
}
