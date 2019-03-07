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