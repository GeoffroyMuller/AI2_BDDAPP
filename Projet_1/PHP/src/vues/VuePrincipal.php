<?php

namespace gamepedia\vues;

use Slim\Slim as Slim;

class VuePrincipal
{
    private $elements;
    private $selecteur;
    private $app;
    private $urlServeur;
    public function __construct($tabAffichage, $selecteur)
    {
        $this->elements = $tabAffichage;
        $this->selecteur = $selecteur;
        $this->app = \Slim\Slim::getInstance();
        $this->urlServeur =  Slim::getInstance()->request()->getRootUri();
    }

    public function htmlquestion()
    {
        $urlQuestion1 = Slim::getInstance()->urlFor("PROJET1",['id' => 1]);
        $urlQuestion2 = Slim::getInstance()->urlFor("PROJET1",['id' => 2]);
        $urlQuestion3 = Slim::getInstance()->urlFor("PROJET1",['id' => 3]);
        $urlQuestion4 = Slim::getInstance()->urlFor("PROJET1",['id' => 4]);
        $urlQuestion5 = Slim::getInstance()->urlFor("PROJET1",['id' => 5]);

            $html = <<<END
<h3>Projet 1</h3>
<ul>
  <li><a href="$urlQuestion1">Question 1</a></li>
  <li><a href="$urlQuestion2">Question 2</a></li>
  <li><a href="$urlQuestion3">Question 3</a></li>
  <li><a href="$urlQuestion4">Question 4</a></li>
  <li><a href="$urlQuestion5">Question 5</a></li>
</ul>
<h3>Projet 2</h3>
END;

        return $html;
    }

    public function htmlquestionP1Q1()
    {
        $res = "<h3>Question n°1 : liste des jeux contenant Mario dans leur titre</h3>";
        foreach($this->elements as $game) {
            $res = $res."<p>Nom du jeu : $game->name </p>";
        }
        return $res;
    }
    public function htmlquestionP1Q2()
    {
        $html = <<<END
<p>question</p>
END;
        return $html;
    }
    public function htmlquestionP1Q3()
    {
        $html = <<<END
<p>question</p>
END;
        return $html;
    }
    public function htmlquestionP1Q4()
    {
        $html = <<<END
<p>question</p>
END;
        return $html;
    }
    public function htmlquestionP1Q5()
    {
        $html = <<<END
<p>question</p>
END;
        return $html;
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
<head><a href="$this->urlServeur/Principale">accueil</a></head>
<body>
 
<div>
 $content
</div>
</body></html>
END;

        echo $html;
    }
}