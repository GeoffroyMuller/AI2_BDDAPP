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
        $urlAccueil = $app->urlFor("Accueil");
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
        $urlAPI_testCommentaire = $app->urlFor("ADD_COMMENT_API_TESTER");


            $html = <<<END
            <ul id="navigation_menu">
            
            
                <li class="menu_item">
                
                <div class="menu_button"><a id="home_link" href="$urlAccueil">Accueil</a></div>
                
                
                </li>
                <li class="menu_item">
                
                    <div class="menu_button"><a href="">Seance 1</a></div>
                 
                    <div class="menu_content">
                        <a href="$urlProjet1Question1">Question 1</a>
                        <a href="$urlProjet1Question2">Question 2</a>
                        <a href="$urlProjet1Question3">Question 3</a>
                        <a href="$urlProjet1Question4">Question 4</a>
                        <a href="$urlProjet1Question5">Question 5</a>
                    </div>
                </li>
                <li class="menu_item">
                 
                    <div class="menu_button"><a href="">Seance 2</a></div>
                 
                    <div class="menu_content">
                         <a href="$urlProjet2Question1">Question 1</a>
                         <a href="$urlProjet2Question2">Question 2</a>
                         <a href="$urlProjet2Question3">Question 3</a>
                         <a href="$urlProjet2Question4">Question 4</a>
                         <a href="$urlProjet2Question5">Question 5</a>
                         <a href="$urlProjet2Question6">Question 6</a>
                         <a href="$urlProjet2Question7">Question 7</a>
                    </div>
                </li>
                <li class="menu_item">
                  
                    <div class="menu_button"><a href="">Seance 3</a></div>
                 
                    <div class="menu_content">
                        <a href="$urlProjet3Question1">Question 1</a>
                        <a href="$urlProjet3Question2">Question 2</a>
                        <a href="$urlProjet3Question3">Question 3</a>
                        <a href="$urlProjet3Question4">Question 4</a>
                        <a href="$urlProjet3Question5">Mesures temps index (Partie 1)</a>
                        <a href="$urlProjet3Question6">Logs jeux Mario</a>
                        <a href="$urlProjet3Question7">Logs nom des personnages du jeu 12342</a>
                        <a href="$urlProjet3Question8">Logs nom des personnages apparus pour la 1ere fois dans un jeu Mario</a>
                        <a href="$urlProjet3Question9">Logs nom des personnages de Mario</a>
                        <a href="$urlProjet3Question10">Logs jeux développé par Sony</a>
                        <a href="$urlProjet3Question12">Nom des personnages de Mario - chargement lié</a>
                        <a href="$urlProjet3Question11">Logs nom des personnages de Mario - chargement lié</a>
                        <a href="$urlProjet3Question13">Jeux développé par Sony chargement lié</a>
                        <a href="$urlProjet3Question14">Logs jeux développé par Sony - chargement lié</a>
                    </div>
                </li>
                <li class="menu_item">
                    
                    <div class="menu_button"><a href="">Seance 4</a></div>
                 
                    <div class="menu_content">
                        <a href="$urlProjet4Question1">Ajouter 2 utilisateurs et leurs 3 commentaires</a>
                        <a href="$urlProjet4Question2">Generer aleatoirement 25000 utilisateurs</a>
                        <a href="$urlProjet4Question3">Generer aleatoirement 250 000 commentaires</a>
                        <a href="$urlProjet4Question4">Rechercher les commentaires d'un utilisateur</a>
                        <a href="$urlProjet4Question5">Utilisateurs avec plus de 5 commentaires</a>
                    </div>
                </li>
                <li class="menu_item">
                
                    <div class="menu_button"><a href="">Seances 5 et 6 (API)</a></div>
                 
                <div class="menu_content">
                <a href="$urlAPI_AccesJeu1">Test API : afficher un jeu (jeu n°1)</a>
                <a href="$urlAPI_Jeux">Test API : afficher tous les jeux (page n°1)</a>
                <a href="$urlAPI_Jeux?page=12">Test API : afficher tous les jeux (page n°12)</a>
                <a href="$urlAPI_AccesJeu1/characters">Test API : afficher les personnages d'un jeu (jeu n°1)</a>
                <a href="$urlAPI_AccesJeu1/comments">Test API : afficher les commentaires d'un jeu (jeu n°1)</a>
                <a href="$urlAPI_testCommentaire">Tester l'insertion de commentaire JSON (jeu n°12342)</a>
                </li>
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
<div class="menu">
 $menu
</div>
<div>
 $content
</div>
</body>
<br>
<footer>
PALMIERI Adrien &nbsp;&nbsp;&nbsp;MULLER Geoffroy &nbsp;&nbsp;&nbsp;KIRCHER Nicolas &nbsp;&nbsp;&nbsp;PLAID Justin
</footer>
</div></html>
END;

        echo $html;
    }
}
