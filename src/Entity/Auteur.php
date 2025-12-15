<?php
declare(strict_types=1);

namespace App\Entity;

abstract class Auteur
{
    protected string $nom;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
}
