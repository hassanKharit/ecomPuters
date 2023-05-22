<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailService
{
    private $mailer;

    public function __construct(MailerInterface $mailerInterface)
    {
        $this->mailer = $mailerInterface;
    }

    public function sendMail($email, $subject, $htmlContent, $textContent)
    {
        $email = (new Email())
            ->from($email)
            ->to('log@adei-france.fr')
            ->subject($subject)
            ->text($textContent)
            ->html($htmlContent);

        $this->mailer->send($email);
    }
}
