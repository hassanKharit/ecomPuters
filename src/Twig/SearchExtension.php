<?php

namespace App\Twig;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use App\Repository\ProduitsRepository;


class SearchExtension extends AbstractExtension
{
    private $produitsRepository;

    public function __construct(ProduitsRepository $produitsRepository)
    {
        $this->produitsRepository = $produitsRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('search', [$this, 'getProduits'])
        ];
    }

    public function getCategories()
    {
        return $this->produitsRepository->findAll();
    }
}