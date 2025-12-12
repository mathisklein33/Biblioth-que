<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Livre;
use App\Entity\ExemplaireLivre;
use App\Logger\LoggerInterface;

class Bibliotheque
{
    private string $nom;
    private array $exemplaires = [];
    private LoggerInterface $logger;

    public function __construct(string $nom, LoggerInterface $logger)
    {
        $this->nom = $nom;
        $this->logger = $logger;
    }

    public function ajouterLivre(Livre $livre): ExemplaireLivre
    {
        $exemplaire = ExemplaireLivre::creer($livre);
        $this->exemplaires[] = $exemplaire;

        $this->logger->info(
            'Ajout du livre : ' . $livre->getTitre()
        );

        return $exemplaire;
    }
}
