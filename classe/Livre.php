<?php

declare(strict_types=1);

namespace App;

class Livre
{
    private string $titre;
    private Auteur $auteur;

    public function __construct(string $titre, Auteur $auteur)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
    }

    public function afficher(): string
    {
        return $this->titre . ' - ' . $this->auteur->getNom() . '<br>';
    }

    public function getAuteur(): Auteur
    {
        return $this->auteur;
    }
}


