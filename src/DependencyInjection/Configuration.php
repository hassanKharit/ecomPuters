<?php

declare(strict_types=1);

/*
 * Ce fichier fait partie du paquet ConnectHolland CookieConsentBundle.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\DependencyInjection;

use root;
use ConnectHolland\CookieConsentBundle\Enum\ThemeEnum;
use ConnectHolland\CookieConsentBundle\Enum\CategoryEnum;
use ConnectHolland\CookieConsentBundle\Enum\PositionEnum;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('ch_cookie_consent');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // Couche de compatibilité pour symfony/config 4.1 et versions antérieures
            $rootNode = /* @scrutinizer ignore-deprecated */ $treeBuilder->root('ch_cookie_consent');
        }

        $rootNode
            ->children()
                ->variableNode('categories')
                    ->defaultValue([CategoryEnum::CATEGORY_TRACKING, CategoryEnum::CATEGORY_MARKETING, CategoryEnum::CATEGORY_SOCIAL_MEDIA])
                ->end()
                ->enumNode('theme')
                    ->defaultValue(ThemeEnum::THEME_LIGHT)
                    ->values(ThemeEnum::getAvailableThemes())
                ->end()
                ->enumNode('position')
                    ->defaultValue(PositionEnum::POSITION_TOP)
                    ->values(PositionEnum::getAvailablePositions())
                ->end()
                ->booleanNode('use_logger')
                    ->defaultTrue()
                ->end()
                ->booleanNode('simplified')
                    ->defaultFalse()
                ->end()
                ->booleanNode('http_only')
                    ->defaultTrue()
                ->end()
                ->scalarNode('form_action')
                    ->defaultNull()
                ->end()
                ->booleanNode('csrf_protection')
                    ->defaultTrue()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
