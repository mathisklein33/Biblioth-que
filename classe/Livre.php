<?php

declare(strict_types=1);

namespace App;

class Livre
{
    private string $titre;
    private Auteur $auteur;
    private Catégorie $catégorie;

    private ?int $anneePublication = null;

    private static int $compteur = 0;

    public function __construct(string $titre, Auteur $auteur, Catégorie $catégorie)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->catégorie = $catégorie;

        self::$compteur++;
    }


    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getAuteur(): Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(Auteur $auteur): void
    {
        $this->auteur = $auteur;
    }

    public function getCategorie(): Catégorie
    {
        return $this->catégorie;
    }

    public function setCategorie(Catégorie $catégorie): void
    {
        $this->catégorie = $catégorie;
    }

    public function getAnneePublication(): ?int
    {
        return $this->anneePublication;
    }

    public function setAnneePublication(?int $anneePublication): void
    {
        $this->anneePublication = $anneePublication;
    }


    public function getDescription(): string
    {
        return sprintf(
            "%s — %s (%s)",
            $this->titre,
            $this->auteur->getNom(),
            $this->categorie->getLibelle()
        );
    }


    public static function getCompteur(): int
    {
        return self::$compteur;
    }

    public static function create(string $titre, Auteur $auteur, Catégorie $catégorie): self
    {
        return new self($titre, $auteur, $catégorie);
    }
}