<?php

declare(strict_types=1);

/*
 * Ce fichier fait partie du package ConnectHolland CookieConsentBundle.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\Enum;


class CookieNameEnum
{
    const COOKIE_CONSENT_NAME = 'Cookie_Consent';

    const COOKIE_CONSENT_KEY_NAME = 'Cookie_Consent_Key';

    const COOKIE_CATEGORY_NAME_PREFIX = 'Cookie_Categorie_';

    /**
     * Obtient le nom de la catégorie du cookie.
     */
    public static function getCookieCategoryName(string $category): string
    {
        return self::COOKIE_CATEGORY_NAME_PREFIX . $category;
    }
}


