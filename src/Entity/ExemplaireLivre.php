<?php

declare(strict_types=1);


class ExemplaireLivre
{
    private Livre $livre;
    private bool $estEmprunte = false;


    private function __construct(Livre $livre)
    {
        $this->livre = $livre;
    }


    public static function creer(Livre $livre): self
    {
        return new self($livre);
    }


    public function marquerEmprunte(): void
    {
        $this->estEmprunte = true;
    }

    public function marquerRendu(): void
    {
        $this->estEmprunte = false;
    }


    public function estDisponible(): bool
    {
        return ! $this->estEmprunte;
    }

    public function getLivre(): Livre
    {
        return $this->livre;
    }
}