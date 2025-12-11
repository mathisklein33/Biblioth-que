<?php

declare(strict_types=1);

namespace App;

interface LoggerInterface
{
    public function info(string $message): void;
}

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

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getExemplaires(): array
    {
        return $this->exemplaires;
    }

    public function ajouterLivre(Livre $livre): ExemplaireLivre
    {
        $exemplaire = new ExemplaireLivre($livre);
        $this->exemplaires[] = $exemplaire;

        $this->logger->info(sprintf(
            'Ajout d’un exemplaire du livre "%s" dans la bibliothèque "%s".',
            $livre->getTitre(),
            $this->nom
        ));

        return $exemplaire;
    }

    public function rechercherParAuteur(string $nomAuteur): array
    {
        $resultats = [];

        foreach ($this->exemplaires as $exemplaire) {
            $livre = $exemplaire->getLivre();

            if ($livre->getAuteur()->getNom() === $nomAuteur) {
                $resultats[] = $exemplaire;
            }
        }

        return $resultats;
    }

    public function rechercherParCategorie(string $libelleCategorie): array
    {
        $resultats = [];

        foreach ($this->exemplaires as $exemplaire) {
            $livre = $exemplaire->getLivre();

            if ($livre->getCategorie()->getLibelle() === $libelleCategorie) {
                $resultats[] = $exemplaire;
            }
        }

        return $resultats;
    }
    
    public function afficherTousLesLivresDisponibles(): void
    {
        foreach ($this->exemplaires as $exemplaire) {
            if ($exemplaire->estDisponible()) {
                echo $exemplaire->getLivre()->getDescription() . '<br>';
            }
        }
    }

    public function emprunterExemplaire(ExemplaireLivre $exemplaire): void
    {
        if (! $exemplaire->estDisponible()) {
            return;
        }

        $exemplaire->marquerEmprunte();

        $this->logger->info(sprintf(
            'Emprunt d’un exemplaire du livre "%s" dans la bibliothèque "%s".',
            $exemplaire->getLivre()->getTitre(),
            $this->nom
        ));
    }
}

