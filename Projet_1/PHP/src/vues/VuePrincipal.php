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
<p>question</p>
END;
        return $html;
    }
    public function htmlquestionP1Q1()
    {
        $res = "<h3>Question n°1 : liste des jeux contenant Mario dans leur titre</h3><br>";
        foreach($this->elements as $game) {
            $res = $res."<p>Nom du jeu : $game->name </p><br>";
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
            case "QUESTION_VIEW" :
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
<head><h3>Projet</h3></head>
<body>
 
<div>
 $content
</div>
</body></html>
END;

        return $html;
    }
}