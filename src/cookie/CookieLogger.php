<?php

declare(strict_types=1);

/*
 * Ce fichier fait partie du paquet ConnectHolland CookieConsentBundle.
 * (c) Connect Holland.
 */

namespace ConnectHolland\CookieConsentBundle\Cookie;

use ConnectHolland\CookieConsentBundle\Entity\CookieConsentLog;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class CookieLogger
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var Request|null
     */
    private $request;

    public function __construct(ManagerRegistry $registry, ?Request $request)
    {
        $this->entityManager = $registry->getManagerForClass(CookieConsentLog::class);
        $this->request       = $request;
    }

    /**
     * Enregistre les préférences des utilisateurs dans la base de données.
     */
    public function log(array $categories, string $key): void
    {
        if ($this->request === null) {
            throw new \RuntimeException('Aucune requête trouvée');
        }

        $ip = $this->anonymizeIp($this->request->getClientIp());

        foreach ($categories as $category => $value) {
            $this->persistCookieConsentLog($category, $value, $ip, $key);
        }

        $this->entityManager->flush();
    }

    protected function persistCookieConsentLog(string $category, string $value, string $ip, string $key): void
    {
        $cookieConsentLog = (new CookieConsentLog())
            ->setIpAddress($ip)
            ->setCookieConsentKey($key)
            ->setCookieName($category)
            ->setCookieValue($value)
            ->setTimestamp(new \DateTime());

        $this->entityManager->persist($cookieConsentLog);
    }

    /**
     * L'IP doit être anonymisée conformément au RGPD.
     */
    protected function anonymizeIp(?string $ip): string
    {
        if ($ip === null) {
            return 'inconnu';
        }

        $lastDot = strrpos($ip, '.') + 1;

        return substr($ip, 0, $lastDot).str_repeat('x', strlen($ip) - $lastDot);
    }
}
