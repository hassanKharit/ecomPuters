<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CookieConsentLogRepository;
use Symfony\Component\Validator\Constraints\DateTime;

#[ORM\Entity(repositoryClass: CookieConsentLogRepository::class)]
class CookieConsentLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    // private ?int $id = null;

    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $ipAddress;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $cookieConsentKey;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $cookieName;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $cookieValue;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var DateTime
     */
    protected $timestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setIpAddress(string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function setCookieConsentKey(string $cookieConsentKey): self
    {
        $this->cookieConsentKey = $cookieConsentKey;

        return $this;
    }

    public function getCookieConsentKey(): string
    {
        return $this->cookieConsentKey;
    }

    public function setCookieName(string $cookieName): self
    {
        $this->cookieName = $cookieName;

        return $this;
    }

    public function getCookieName(): string
    {
        return $this->cookieName;
    }

    public function setCookieValue(string $cookieValue): self
    {
        $this->cookieValue = $cookieValue;

        return $this;
    }

    public function getCookieValue(): string
    {
        return $this->cookieValue;
    }

    public function setTimestamp(DateTime $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

}
