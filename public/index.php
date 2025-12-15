<?php


require_once __DIR__ . '/../autoload.php';

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Livre;
use App\Entity\Utilisateur;
use App\Logger\EchoLogger;
use App\Service\Bibliotheque;
use App\AucunExemplaireDisponibleException;
use App\Entity\AuteurSimple;

// 1) Créer plusieurs auteurs, catégories, livres
$auteur1 = new AuteurSimple('Victor Hugo');
$auteur2 = new AuteurSimple('Jules Verne');


$categorieRoman = new Categorie('Roman');
$categorieSF = new Categorie('Science-fiction');

$livre1 = new Livre('Les Misérables', $auteur1, $categorieRoman);
$livre2 = new Livre('Notre-Dame de Paris', $auteur1, $categorieRoman);
$livre3 = new Livre('Vingt mille lieues sous les mers', $auteur2, $categorieSF);

// 2) Créer une bibliothèque
$logger = new EchoLogger();
$biblio = new Bibliotheque('Bibliothèque Centrale', $logger);

// 3) Ajouter les livres dans la bibliothèque
$ex1 = $biblio->ajouterLivre($livre1);
$ex2 = $biblio->ajouterLivre($livre2);
$ex3 = $biblio->ajouterLivre($livre3);

echo '<h3>4) Livres disponibles</h3>';
$biblio->afficherTousLesLivresDisponibles();

// 5) Rechercher par auteur et par catégorie
echo '<h3>5) Recherche par auteur : Victor Hugo</h3>';
foreach ($biblio->rechercherParAuteur('Victor Hugo') as $ex) {
    echo $ex->getLivre()->getDescription() . '<br>';
}

echo '<h3>5) Recherche par catégorie : Science-fiction</h3>';
foreach ($biblio->rechercherParCategorie('Science-fiction') as $ex) {
    echo $ex->getLivre()->getDescription() . '<br>';
}

// 6) Créer un utilisateur
$utilisateur = new Utilisateur('Alice', 'alice@mail.com', $logger);

// 7) Lui faire emprunter un livre (try/catch si indisponible)
echo '<h3>7) Emprunt</h3>';

try {
    $utilisateur->emprunter($ex3, $biblio); // emprunte le livre SF
    // On tente de ré-emprunter le même exemplaire pour provoquer l'exception
    $utilisateur->emprunter($ex3, $biblio);
} catch (AucunExemplaireDisponibleException $e) {
    echo 'Exception : ' . $e->getMessage() . '<br>';
}

// 8) Afficher ses emprunts
echo '<h3>8) Emprunts de l’utilisateur</h3>';
$utilisateur->afficherLivresEmpruntes();

// 9) Réafficher les livres disponibles
echo '<h3>9) Livres disponibles après emprunt</h3>';
$biblio->afficherTousLesLivresDisponibles();
