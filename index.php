<?php


require_once 'autoload.php';

use App\Auteur;
use App\Livre;
use App\Bibliotheque;

$livre1 = new Livre("1984", new Auteur("George Orwell"));
$livre2 = new Livre("Les Misérables", new Auteur("Victor Hugo"));

$biblio = new Bibliotheque();
$biblio->ajouterLivre($livre1);
$biblio->ajouterLivre($livre2);

echo "<h3>Tous les livres :</h3>";
$biblio->afficherTous();

echo "<h3>Livres de Victor Hugo :</h3>";
$biblio->afficherParAuteur("Victor Hugo");



