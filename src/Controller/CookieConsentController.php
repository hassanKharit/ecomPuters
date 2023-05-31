<?php


declare(strict_types=1);

namespace ConnectHolland\CookieConsentBundle\Controller;

use ConnectHolland\CookieConsentBundle\Cookie\CookieChecker;
use ConnectHolland\CookieConsentBundle\Form\CookieConsentType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class CookieConsentController
{
    private Environment $twigEnvironment;
    private FormFactoryInterface $formFactory;
    private CookieChecker $cookieChecker;
    private RouterInterface $router;
    private string $cookieConsentTheme;
    private string $cookieConsentPosition;
    private TranslatorInterface $translator;
    private bool $cookieConsentSimplified;
    private ?string $formAction;

    public function __construct(
        Environment $twigEnvironment,
        FormFactoryInterface $formFactory,
        CookieChecker $cookieChecker,
        RouterInterface $router,
        string $cookieConsentTheme,
        string $cookieConsentPosition,
        TranslatorInterface $translator,
        bool $cookieConsentSimplified = false,
        ?string $formAction = null
    ) {
        $this->twigEnvironment = $twigEnvironment;
        $this->formFactory = $formFactory;
        $this->cookieChecker = $cookieChecker;
        $this->router = $router;
        $this->cookieConsentTheme = $cookieConsentTheme;
        $this->cookieConsentPosition = $cookieConsentPosition;
        $this->translator = $translator;
        $this->cookieConsentSimplified = $cookieConsentSimplified;
        $this->formAction = $formAction;
    }

    #[Route('/cookie_consent', name: 'ch_cookie_consent.show')]
    public function show(Request $request): Response
    {
        $this->setLocale($request);

        $response = new Response(
            content: $this->twigEnvironment->render('@CHCookieConsent/cookie_consent.html.twig', [
                'form' => $this->createCookieConsentForm()->createView(),
                'theme' => $this->cookieConsentTheme,
                'position' => $this->cookieConsentPosition,
                'simplified' => $this->cookieConsentSimplified,
            ])
        );

        $response->setPrivate();
        $response->setMaxAge(0);

        return $response;
    }

    #[Route('/cookie_consent_alt', name: 'ch_cookie_consent.show_if_cookie_consent_not_set')]
    public function showIfCookieConsentNotSet(Request $request): Response
    {
        if (!$this->cookieChecker->isCookieConsentSavedByUser()) {
            return $this->show($request);
        }

        return new Response();
    }

    protected function createCookieConsentForm(): FormInterface
    {
        $form = match ($this->formAction) {
            null => $this->formFactory->create(CookieConsentType::class),
            default => $this->formFactory->create(CookieConsentType::class, null, ['action' => $this->router->generate($this->formAction)]),
        };

        return $form;
    }

    protected function setLocale(Request $request)
    {
        $locale = $request->get('locale');
        if (!empty($locale)) {
            $this->translator->setLocale($locale);
            $request->setLocale($locale);
        }
    }
}
