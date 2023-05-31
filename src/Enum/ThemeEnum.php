<?php

declare(strict_types=1);

/*
 * Ce fichier fait partie du package ConnectHolland CookieConsentBundle.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\Enum;


class ThemeEnum
{
    public const THEME_LIGHT = 'clair';
    public const THEME_DARK  = 'sombre';

    /**
     * @var array
     */
    private static $themes = [
        self::THEME_LIGHT,
        self::THEME_DARK,
    ];

    /**
     * Récupère tous les thèmes de consentement aux cookies disponibles.
     */
    public static function getAvailableThemes(): array
    {
        return self::$themes;
    }
}
