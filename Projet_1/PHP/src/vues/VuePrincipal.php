<?php

namespace gamepedia\vues;

class VuePrincipal
{
    private $content;
    private $selecteur;
    private $app;

    public function __construct()
    {
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
            case QUESTION_VIEW :
                {
                    $content = $this->htmlquestion();
                    break;
                }
        }
        $html = <<<END
        <!DOCTYPE html>
        <html>
        <head> <h3>Projet</h3></head>
        <body>
         …
        <div class="content">
            $content
        </div>
        </body><html>
        END;

    }

}
