<?php

declare(strict_types=1);

/*
 * Ce fichier fait partie du package ConnectHolland CookieConsentBundle.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\EventSubscriber;

use ConnectHolland\CookieConsentBundle\Cookie\CookieHandler;
use ConnectHolland\CookieConsentBundle\Cookie\CookieLogger;
use ConnectHolland\CookieConsentBundle\Enum\CookieNameEnum;
use ConnectHolland\CookieConsentBundle\Form\CookieConsentType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CookieConsentFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var CookieLogger
     */
    private $cookieLogger;

    /**
     * @var CookieHandler
     */
    private $cookieHandler;

    /**
     * @var bool
     */
    private $useLogger;

    public function __construct(FormFactoryInterface $formFactory, CookieLogger $cookieLogger, CookieHandler $cookieHandler, bool $useLogger)
    {
        $this->formFactory   = $formFactory;
        $this->cookieLogger  = $cookieLogger;
        $this->cookieHandler = $cookieHandler;
        $this->useLogger     = $useLogger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
           KernelEvents::RESPONSE => ['onResponse'],
        ];
    }

    /**
     * Vérifie si le formulaire a été soumis et enregistre les préférences des utilisateurs dans les cookies en appelant CookieHandler.
     */
    public function onResponse(KernelEvent $event): void
    {
        if ($event instanceof FilterResponseEvent === false && $event instanceof ResponseEvent === false) {
            throw new \RuntimeException('Aucune classe ResponseEvent trouvée');
        }

        $request  = $event->getRequest();
        $response = $event->getResponse();

        $form = $this->createCookieConsentForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleFormSubmit($form->getData(), $request, $response);
        }
    }

    /**
     * Gère la soumission du formulaire.
     */
    protected function handleFormSubmit(array $categories, Request $request, Response $response): void
    {
        $cookieConsentKey = $this->getCookieConsentKey($request);

        $this->cookieHandler->save($categories, $cookieConsentKey, $response);

        if ($this->useLogger) {
            $this->cookieLogger->log($categories, $cookieConsentKey);
        }
    }

    /**
     * Récupère la clé de consentement aux cookies existante depuis les cookies ou en crée une nouvelle.
     */
    protected function getCookieConsentKey(Request $request): string
    {
        return $request->cookies->get(CookieNameEnum::COOKIE_CONSENT_KEY_NAME) ?? uniqid();
    }

    /**
     * Crée le formulaire de consentement aux cookies.
     */
    protected function createCookieConsentForm(): FormInterface
    {
        return $this->formFactory->create(CookieConsentType::class);
    }
}
