<?php
namespace gamepedia\vues;

use Slim\Slim as Slim;

class VuePrincipal
{
    private $elements;
    private $app;
    private $urlServeur;
    public function __construct($tabAffichage)
    {
        $this->elements = $tabAffichage;
        $this->app = \Slim\Slim::getInstance();
        $this->urlServeur =  Slim::getInstance()->request()->getRootUri();
    }

    public function htmlquestion()
    {
        $app = Slim::getInstance();
        $urlProjet1Question1 = $app->urlFor("PROJET1",['id' => 1]);
        $urlProjet1Question2 = $app->urlFor("PROJET1",['id' => 2]);
        $urlProjet1Question3 =$app->urlFor("PROJET1",['id' => 3]);
        $urlProjet1Question4 = $app->urlFor("PROJET1",['id' => 4]);
        $urlProjet1Question5 = $app->urlFor("Projet1_Q5");

        $urlProjet2Question1 = $app->urlFor("PROJET2",['id' => 1]);
        $urlProjet2Question2 = $app->urlFor("PROJET2",['id' => 2]);
        $urlProjet2Question3 = $app->urlFor("PROJET2",['id' => 3]);
        $urlProjet2Question4 = $app->urlFor("PROJET2",['id' => 4]);
        $urlProjet2Question5 = $app->urlFor("PROJET2",['id' => 5]);
        $urlProjet2Question6 = $app->urlFor("PROJET2",['id' => 6]);
        $urlProjet2Question7 = $app->urlFor("PROJET2",['id' => 7]);

        $urlProjet3Question1 = $app->urlFor("PROJET3",['id' => 1]);
        $urlProjet3Question2 = $app->urlFor("PROJET3",['id' => 2]);
        $urlProjet3Question4 = $app->urlFor("PROJET3",['id' => 4]);
        $urlProjet3Question3 = $app->urlFor("PROJET3",['id' => 3]);
        $urlProjet3Question5 = $app->urlFor("PROJET3",['id' => 5]);
        $urlProjet3Question6 = $app->urlFor("PROJET3",['id' => 6]);
        $urlProjet3Question7 = $app->urlFor("PROJET3",['id' => 7]);
        $urlProjet3Question8 = $app->urlFor("PROJET3",['id' => 8]);
        $urlProjet3Question9 = $app->urlFor("PROJET3",['id' => 9]);
        $urlProjet3Question10 = $app->urlFor("PROJET3",['id' => 10]);
        $urlProjet3Question11 = $app->urlFor("PROJET3",['id' => 11]);
        $urlProjet3Question12 = $app->urlFor("PROJET3",['id' => 12]);
        $urlProjet3Question13 = $app->urlFor("PROJET3",['id' => 13]);
        $urlProjet3Question14 = $app->urlFor("PROJET3",['id' => 14]);


        $urlProjet4Question1 = $app->urlFor("PROJET4",['id' => 1]);
        $urlProjet4Question2 = $app->urlFor("PROJET4",['id' => 2]);
        $urlProjet4Question3 = $app->urlFor("PROJET4",['id' => 3]);
        $urlProjet4Question4 = $app->urlFor("PROJET4",['id' => 4]);
        $urlProjet4Question5 = $app->urlFor("PROJET4",['id' => 5]);

        $urlAPI_AccesJeu1 = $app->urlFor("API_GAME",['id' => 1]);
        $urlAPI_Jeux = $app->urlFor("API_GAMES");


            $html = <<<END
                <h3>Projet 1</h3>
                <ul>
                  <li><a href="$urlProjet1Question1">Question 1</a></li>
                  <li><a href="$urlProjet1Question2">Question 2</a></li>
                  <li><a href="$urlProjet1Question3">Question 3</a></li>
                  <li><a href="$urlProjet1Question4">Question 4</a></li>
                  <li><a href="$urlProjet1Question5">Question 5</a></li>
                </ul>
                <h3>Projet 2</h3>
                <ul>
                    <li><a href="$urlProjet2Question1">Question 1</a></li>
                    <li><a href="$urlProjet2Question2">Question 2</a></li>
                    <li><a href="$urlProjet2Question3">Question 3</a></li>
                    <li><a href="$urlProjet2Question4">Question 4</a></li>
                    <li><a href="$urlProjet2Question5">Question 5</a></li>
                    <li><a href="$urlProjet2Question6">Question 6</a></li>
                    <li><a href="$urlProjet2Question7">Question 7</a></li>
                </ul>
            <h3>Projet 3</h3>
                <ul>
                    <li><a href="$urlProjet3Question1">Question 1</a></li>
                    <li><a href="$urlProjet3Question2">Question 2</a></li>
                    <li><a href="$urlProjet3Question3">Question 3</a></li>
                    <li><a href="$urlProjet3Question4">Question 4</a></li>
                    <li><a href="$urlProjet3Question5">Mesures temps index (Partie 1)</a></li>
                    <li><a href="$urlProjet3Question6">Logs jeux Mario</a></li>
                    <li><a href="$urlProjet3Question7">Logs nom des personnages du jeu 12342</a></li>
                    <li><a href="$urlProjet3Question8">Logs nom des personnages apparus pour la 1ere fois dans un jeu Mario</a></li>
                    <li><a href="$urlProjet3Question9">Logs nom des personnages de Mario</a></li>
                    <li><a href="$urlProjet3Question10">Logs jeux développé par Sony</a></li>
                    <li><a href="$urlProjet3Question12">Nom des personnages de Mario - chargement lié</a></li>
                    <li><a href="$urlProjet3Question11">Logs nom des personnages de Mario - chargement lié</a></li>
                    <li><a href="$urlProjet3Question13">Jeux développé par Sony chargement lié</a></li>
                    <li><a href="$urlProjet3Question14">Logs jeux développé par Sony - chargement lié</a></li>
                </ul>
            <h3>Projet 4</h3>
                <ul>
                <li><a href="$urlProjet4Question1">Ajouter 2 utilisateurs et leurs 3 commentaires</a></li>
                <li><a href="$urlProjet4Question2">Generer aleatoirement 25000 utilisateurs</a></li>
                <li><a href="$urlProjet4Question3">Generer aleatoirement 250 000 commentaires</a></li>
                <li><a href="$urlProjet4Question4">Rechercher les commentaires d'un l'utilisateur</a></li>
                <li><a href="$urlProjet4Question5">Utilisateurs avec plus de 5 commentaires</a></li>
                </ul>
            <h3>API</h3>
                <ul>
                <li><a href="$urlAPI_AccesJeu1">Test API Jeu 1</a></li>
                <li><a href="$urlAPI_Jeux">Test API Jeux</a></li>
                </ul>
END;

        return $html;
    }

    public function render()
    {
        $menu = $this->htmlquestion();
        $content = $this->elements;
        $html = <<<END
<!DOCTYPE html>
<html>
<head>
<title>Projet BDD</title>
<link rel="stylesheet" type="text/css" href="$this->urlServeur/css/style.css">
</head>
<body>
<a href="$this->urlServeur">Accueil</a>
 <div class="menu">
 $menu
</div>
<div>
 $content
</div>
</body></html>
END;

        echo $html;
    }
}
