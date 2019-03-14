<?php

namespace gamepedia\vues;

class VuePrincipal
{
    private $elements;
    private $selecteur;
    private $app;

    public function __construct($tabAffichage, $selecteur)
    {
        $this->elements = $tabAffichage;
        $this->selecteur = $selecteur;
        $this->app = \Slim\Slim::getInstance();
    }

    public function htmlquestion()
    {
            $html = <<<END
<h3>Projet 1</h3>
<ul>
  <li><a href="/projet1/question/1">Question 1</a></li>
  <li><a href="/projet1/question/2">Question 2</a></li>
  <li><a href="/projet1/question/3">Question 3</a></li>
  <li><a href="/projet1/question/4">Question 4</a></li>
  <li><a href="/projet1/question/5">Question 5</a></li>
</ul>
<h3>Projet 2</h3>
END;

        return $html;
    }

    public function htmlquestionP1Q1()
    {
        $res = "<h3>Question n°1 : liste des jeux contenant Mario dans leur titre</h3>";
        foreach($this->elements as $game) {
            $res = $res."Nom du jeu : $game->name </br>";
        }
        return $res;
    }
    public function htmlquestionP1Q2()
    {
        $res = "<h3>Question n°2 : liste des compagnies installees au japon</h3>";
        foreach($this->elements as $company) {
            $res = $res."Nom de la compagnie : $company->name <br>";
        }
        return $res;
    }
    public function htmlquestionP1Q3()
    {
        $res = "<h3>Question n°3 : liste des plateformes ayant plus de 10M d'installations</h3>";
        foreach($this->elements as $platform) {
            $res = $res."Nom de la plateforme : $platform->name <br>";
        }
        return $res;
    }
    public function htmlquestionP1Q4()
    {
        $res = "<h3>Question n°4 : liste de 442 jeux à partir du 21173ème</h3>";
        $res = $res.$this->elements;
        return $res;
    }
    public function htmlquestionP1Q5()
    {
        $res = "<h3>Question n°5 : lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500)</h3>";
        $res = $res.$this->elements;
        return $res;
    }

    public function render()
    {
        switch ($this->selecteur) {
            case "ALL_VIEW" :
                {
                    $content = $this->htmlquestion();
                    break;
                }
            case "P1Q1" :
                {
                    $content = $this->htmlquestionP1Q1();
                    break;
                }
            case "P1Q2" :
                {
                    $content = $this->htmlquestionP1Q2();
                    break;
                }
            case "P1Q3" :
                {
                    $content = $this->htmlquestionP1Q3();
                    break;
                }
            case "P1Q4" :
                {
                    $content = $this->htmlquestionP1Q4();
                    break;
                }
            case "P1Q5" :
                {
                    $content = $this->htmlquestionP1Q5();
                    break;
                }
        }
        $html = <<<END
<!DOCTYPE html>
<html>
<head><a href="/Principale">accueil</a></head>
<body>
 
<div>
 $content
</div>
</body></html>
END;

        echo $html;
    }
}