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

    public function render()
    {
        switch ($this->selecteur) {
            case "QUESTION_VIEW" :
                {
                    $content = $this->htmlquestion();
                    break;
                }
            case "Q1" :
                {

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