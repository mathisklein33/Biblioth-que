<?php

declare(strict_types=1);

namespace App;

class Bibliotheque
{
    private string $nom;

    /** @var ExemplaireLivre[] */
    private array $exemplaires = [];

    private LoggerInterface $logger;

    public function __construct(string $nom, LoggerInterface $logger)
    {
        $this->nom = $nom;
        $this->logger = $logger;
    }

    public function ajouterLivre(Livre $livre): ExemplaireLivre
    {
        // ✅ composition : on passe par la factory (constructeur privé)
        $exemplaire = ExemplaireLivre::creer($livre);

        $this->exemplaires[] = $exemplaire;

        $this->logger->info(sprintf(
            'Ajout d’un exemplaire du livre "%s" dans la bibliothèque "%s".',
            $livre->getTitre(),
            $this->nom
        ));

        return $exemplaire;
    }

    // ... le reste de tes méthodes peut rester identique
}
