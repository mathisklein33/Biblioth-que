<?php

declare(strict_types=1);

namespace App;

class Bibliotheque
{
    private array $livres = [];

    public function ajouterLivre(Livre $livre): void
    {
        $this->livres[] = $livre;
    }

    public function afficherTous(): void
    {
        foreach ($this->livres as $livre) {
            echo $livre->afficher();
        }
    }

    public function afficherParAuteur(string $nom): void
    {
        foreach ($this->livres as $livre) {
            if ($livre->getAuteur()->getNom() === $nom) {
                echo $livre->afficher();
            }
        }
    }
}

