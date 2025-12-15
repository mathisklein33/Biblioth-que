<?php

declare(strict_types=1);



class Utilisateur extends \App\Personne
{
    use \LoggerTrait;

    private string $email;


    private array $emprunts = [];

    public function __construct(string $nom, string $email, \LoggerInterface $logger)
    {
        \App\Personne::__construct($nom);
        $this->email = $email;
        $this->setLogger($logger);
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function getEmprunts(): array
    {
        return $this->emprunts;
    }


    public function ajouterEmprunt(\App\Emprunt $emprunt): void
    {
        $this->emprunts[] = $emprunt;
    }


    public function emprunter(\ExemplaireLivre $exemplaire, \App\Bibliotheque $bibliotheque): void
    {
        if (! $exemplaire->estDisponible()) {
            throw new \App\AucunExemplaireDisponibleException(
                sprintf(
                    'Aucun exemplaire disponible pour le livre "%s".',
                    $exemplaire->getLivre()->getTitre()
                )
            );
        }


        $exemplaire->marquerEmprunte();

        $emprunt = new \App\Emprunt($this, $exemplaire, new \DateTimeImmutable());
        $this->ajouterEmprunt($emprunt);

        $this->getLogger()->log(sprintf(
            'Utilisateur "%s" a emprunté le livre "%s" à la bibliothèque "%s".',
            $this->getNom(),
            $exemplaire->getLivre()->getTitre(),
            $bibliotheque->getNom()
        ));
    }


    public function afficherLivresEmpruntes(): void
    {
        foreach ($this->emprunts as $emprunt) {
            $livre = $emprunt->getExemplaire()->getLivre();
            echo $livre->getDescription() . '<br>';
        }
    }


    public function getType(): string
    {
        return 'utilisateur';
    }
}
