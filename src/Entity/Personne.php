<?php

declare(strict_types=1);

namespace App;

abstract class Personne
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
    

    // Exemple : une autre propriété possible
    protected ?int $age = null;

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    // Méthode abstraite
    abstract public function getType(): string;
}

class Auteur extends Personne
{
    public function getType(): string
    {
        return 'auteur';
    }
}