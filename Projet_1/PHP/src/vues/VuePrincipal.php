
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
        $urlProjet3Question5 = $app->urlFor("PROJET3",['id' => 5]);
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
                    <li><a href="$urlProjet3Question4">Question 4</a></li>
                    <li><a href="$urlProjet3Question5">Question 1 (Partie 2)</a></li>
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
<head><a href="$this->urlServeur">accueil</a></head>
<body>
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
