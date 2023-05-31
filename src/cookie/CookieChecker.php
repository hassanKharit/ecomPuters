<?php

declare(strict_types=1);

/*
 * Ce fichier fait partie du paquet ConnectHolland CookieConsentBundle.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\Cookie;

use ConnectHolland\CookieConsentBundle\Enum\CookieNameEnum;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;

class CookieChecker
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Vérifie si le consentement aux cookies a déjà été enregistré.
     */
    public function isCookieConsentSavedByUser(): bool
    {
        return $this->request->cookies->has(CookieNameEnum::COOKIE_CONSENT_NAME);
    }

    /**
     * Vérifie si la catégorie de cookie donnée est autorisée par l'utilisateur.
     */
    public function isCategoryAllowedByUser(string $category): bool
    {
        return $this->request->cookies->get(CookieNameEnum::getCookieCategoryName($category)) === 'true';
    }
}
