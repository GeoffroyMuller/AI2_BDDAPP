<?php

namespace gamepedia\controleurs;

use gamepedia\models\Game;
use gamepedia\vues\VuePrincipal;

class ControleurGame
{

    public function afficherJeuxMario()
    {

        $games = Game::where('name', 'LIKE', '%mario%')->get();
        $vue = new \gamepedia\vues\VuePrincipal($games, "P1Q1");
        $vue->render();
    }

    public function afficherJeuxAPartir()
    {
        $res = "";
        for ($i = 0; $i < 443; $i++) {
            $jeu = Game::where('id', '=', '21173' + $i)->first();
            $res = $res . "id: $jeu->id,  nom: $jeu->name <br>";
        }
        $vue = new \gamepedia\vues\VuePrincipal($res, "P1Q4");
        $vue->render();
    }

    public function paginationJeux()
    {
        $res = "";
        $idmax = Game::select('id')->get();
        $nbPages = (count($idmax) / 500) + 1;
        $numPage = 1;

        // Lors du passage avec Slim, utilisez la methode post de Slim.
        if (isset($_POST['numeroPage'])) {
            $numPage = $_POST['numeroPage'];
        }

        $valeurMax = $numPage * 500;
        for ($valeurMin = $valeurMax - 499; $valeurMin < $valeurMax + 1; $valeurMin++) {
            $jeuAffiche = Game::where('id', '=', $valeurMin)->first();
            if ($jeuAffiche != null) {
                $res = $res . "<ul>";
                $res = $res . "<li>Identifiant du jeu: $jeuAffiche->id</li>";
                $res = $res . "<li>Nom du jeu: $jeuAffiche->name</li>";
                $res = $res . "<li>Description du deck: $jeuAffiche->deck</li>";
                $res = $res . "</ul>";
            }

        }

        $formulaireQuestion5 = "<form action='index.php' method='post'><select name='numeroPage'>";
        for ($i = 1; $i < $nbPages; $i++) {
            $formulaireQuestion5 .= " <option value='$i'>$i</option> ";
        }
        $formulaireQuestion5 .= " </select> <input type='submit' value='Valider'> </form> ";
        $res .= $formulaireQuestion5 . " </body></html> ";
        (new \gamepedia\vues\VuePrincipal($res, "P1Q5"))->render();

    }

}
