<?php

namespace gamepedia\controleurs;

use gamepedia\models\Game;
use gamepedia\models\RatingBoard;
use gamepedia\vues\VuePrincipal as VuePrincipal;
use Slim\Slim as Slim;

class ControleurGame
{

public function tempsExecutionJeuxWhere() {
          $res = "<h3> Temps d'execution pour lister différents jeux : </h3>";
          $tempsDepart = microtime(true);
          $jeu = Game::where('name','LIKE', 'Mario%')->first();
          $tempsFin = microtime(true);
          $duree = $tempsFin - $tempsDepart;
          $res .= "<p>Temps d'execution jeux mario : $duree</p>";

          $tempsDepart = microtime(true);
          $jeu = Game::where('name','LIKE', 'Racing%')->first();
          $tempsFin = microtime(true);
          $duree = $tempsFin - $tempsDepart;
          $res .= "<p>Temps d'execution jeux racing: $duree</p>";

          $tempsDepart = microtime(true);
          $jeu = Game::where('name','LIKE', '3-D')->first();
          $tempsFin = microtime(true);
          $duree = $tempsFin - $tempsDepart;
          $res .= "<p>Temps d'execution jeux 3-D: $duree</p>
                   <br><h3>Utilisation de l'index : </h3><p>L'utilisation de l'index a démontré lors de nos tests le résultat suivant : </p>
                   <br><h5>Avant l'index : </h5><p>Temps d'execution jeux mario : 0.019865036010742<br>Temps d'execution jeux racing: 0.0016639232635498<br>Temps d'execution jeux 3-D: 0.15950608253479</p>
                   <br><h5>Apres l'index : </h5><p>Temps d'execution jeux mario : 0.011046007156372<br>Temps d'execution jeux racing: 0.0012261867523193<br>Temps d'execution jeux 3-D: 0.00049304962158203</p>
                   <br><p> On remarque un gain considérable de temps pour la troisième requête.</p>";
          (new VuePrincipal($res))->render();

      }


public function tempsExecutionPersosMario()
    {
        $res = "<h3>Temps d'execution pour afficher les personnages des jeux commencant par Mario</h3>";
        $tempsDepart = microtime(true);

        $marioGames = Game::where('name','LIKE','Mario%')->get();
        foreach($marioGames as $marioGame) {
            foreach($marioGame->personnages as $personnage) {

            }
        }

        $tempsFin = microtime(true);

        $duree = $tempsFin - $tempsDepart;

        $res .= "<p>Temps d'execution : $duree</p>";

        (new VuePrincipal($res))->render();
    }


public function tempsExecutionListerJeux() {

        $res = "<h3>Question n°1 Temps d'execution pour lister tout les jeux : </h3>";
        $tempsDepart = microtime(true);
        $jeux = Game::all();
        $tempsFin = microtime(true);

        $duree = $tempsFin - $tempsDepart;

        $res .= "<p>Temps d'execution : $duree</p>";
        (new VuePrincipal($res))->render();
    }


public function  tempsExecutionListerJeuxMario(){
        $res = "<h3>Question n°2 : Temps d'execution pour lister tout les jeux dont le nom contient Mario: </h3>";
        $tempsDepart = microtime(true);
        $games = Game::where('name', 'LIKE', '%mario%')->get();
        $tempsFin = microtime(true);

        $duree = $tempsFin - $tempsDepart;

        $res .= "<p>Temps d'execution : $duree</p>";
        (new VuePrincipal($res))->render();
    }


public function personnagesJeu12342() {
        $res = "<h3>Question n°1 : personnages du jeu 12342</h3>
           <br><br>
            <table style=\"width:100 % \">
            <tr>
                <th>ID du personnage:</th>
                <th>Nom du personnage:</th>
                <th>Deck:</th>
                <th>Description :</th>
                <th>Date de création :</th>
            </tr>";
        $jeu = Game::where('id','=','12342')->first();
        $charactersFor12342 = $jeu->personnages;
        foreach($charactersFor12342 as $personnage) {
            $res .= "<tr>
                        <td>$personnage->id</td>
                        <td>$personnage->name</td>
                        <td>$personnage->deck</td>
                        <td>$personnage->description</td>
                        <td>$personnage->created_at</td>
                        </tr>";  }
        $res .= "</table></body>";
        (new VuePrincipal($res))->render();

    }


public function ratingBoardMario() {
    $games = Game::where('name', 'LIKE', '%mario%')->get();
    $res = "<h3>Question n°4 : rating boards des jeux contenant Mario</h3>
            <br><br><table style='width:100%'>
            <tr>
                <th>ID du board :</th>
                <th>Nom du board :</th>
                <th>Deck du board :</th>
                
            </tr>";

    foreach($games as $marioGame) {
        $ratingsMario = $marioGame->ratings;
        foreach($ratingsMario as $ratingMario) {
            $ratingBoard = RatingBoard::where('id', '=',$ratingMario->rating_board_id)->first();
            $res .= "<tr>
                        <td>$ratingBoard->id</td>
                        <td>$ratingBoard->name</td>
                        <td>$ratingBoard->deck</td>
                      </tr>";
        }
    }

    $res .= "</table>";
    (new VuePrincipal($res))->render();
}


public function jeuxDebutMario4Persos() {
    $res = "<h3>Question n°5 : jeux dont le nom commence par Mario avec au moins 4 personnages</h3>
            <br><br>
            <table style=\"width:100%\">
            <tr>
            <th>ID jeu:</th>
            <th>Titre du jeu:</th>
            <th>Alias du jeu:</th>
            <th>Description :</th>
            <th>Date de création :</th>
            </tr>";
    $marioGames = Game::where('name','LIKE','Mario%')->get();
    foreach($marioGames as $game) {
        if($game->personnages()->count() > 3) {
            $res .= "<tr>
                        <td>$game->id</td>
                        <td>$game->name</td>
                        <td>$game->alias</td>
                        <td>$game->description</td>
                        <td>$game->created_at</td>
                </tr>";
        }
    }
    $res .= "</table>";
    (new VuePrincipal($res))->render();
}


public function jeuxMario3Plus() {
    $res = "<h3>Question n°6 : jeux dont le nom commence par mario et classés 3+ en rating</h3>
            <br><br>
            <table style=\"width:100%\">
            <tr>
            <th>ID jeu:</th>
            <th>Titre du jeu:</th>
            <th>Alias du jeu:</th>
            <th>Description :</th>
            <th>Date de création :</th>
            </tr>";
    $marioGames = Game::where('name','LIKE','Mario%')->get();
    foreach($marioGames as $game) {
        $ratings = $game->ratings()->where('name','like','%3+%','and','game_id','=',$game->id)->count();
        if($ratings >= 1) {
            $res .= "<tr>
                    <td>$game->id</td>
                    <td>$game->name</td>
                    <td>$game->alias</td>
                    <td>$game->description</td>
                    <td>$game->created_at</td>
                    </tr>";
        }

    }
    $res .= "</table>";
    (new VuePrincipal($res))->render();
}


public function tempsExecutionListerMario3Plus() {

        $res = "<h3> Temps d'execution pour lister tout les jeux dont le nom commence par mario et classés 3+ en rating</h3>";
        $tempsDepart = microtime(true);
        $marioGames = Game::where('name','LIKE','Mario%')->get();
        foreach($marioGames as $game) {
            $ratings = $game->ratings()->where('name','like','%3+%','and','game_id','=',$game->id)->count();
            if($ratings >= 1) {
                $res1 = "Jeu 3+ commençant par Mario : $game->name <br>";
            }

        }
        $tempsFin = microtime(true);

        $duree = $tempsFin - $tempsDepart;

        $res .= "<p>Temps d'execution : $duree</p></body></html>";
        (new VuePrincipal($res))->render();
    }


public function personnagesJeuxDebutMario(){
        $res = "<h3>Question n°2 : personnages des jeux commençant par mario</h3><br><br><table style=\"width:100 % \">
                <tr>
                <th>ID du personnage:</th>
                <th>Nom du personnage:</th>
                <th>Deck:</th>
                <th>Description :</th>
                <th>Date de création :</th>
                </tr>";
        $marioGames = Game::where('name','LIKE','Mario%')->distinct()->get();
        foreach($marioGames as $marioGame) {
            foreach($marioGame->personnages as $personnage) {
                $res .= "<tr>
                        <td>$personnage->id</td>
                        <td>$personnage->name</td>
                        <td>$personnage->deck</td>
                        <td>$personnage->description</td>
                        <td>$personnage->created_at</td>
                        </tr>";
            }
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();
    }


public function personnagesJeuxDebutMarioOpti(){
        $res = "<h3>Chargement lié : personnages des jeux commençant par mario</h3><br><br><table style=\"width:100 % \">
                <tr>
                <th>ID du personnage:</th>
                <th>Nom du personnage:</th>
                <th>Deck:</th>
                <th>Description :</th>
                <th>Date de création :</th>
                </tr>";
        $marioGames = Game::where('name','LIKE','Mario%')->distinct()->get();
        foreach($marioGames as $marioGame) {
            foreach($marioGame->personnages as $personnage) {
                $res .= "<tr>
                        <td>$personnage->id</td>
                        <td>$personnage->name</td>
                        <td>$personnage->deck</td>
                        <td>$personnage->description</td>
                        <td>$personnage->created_at</td>
                        </tr>";
            }
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();
    }


public function afficherJeuxMario()
    {
        $res = "<h3>Question n°1 : liste des jeux contenant Mario dans leur titre</h3><br><br><table style=\"width:100%\">
                <tr>
                <th>ID jeu:</th>
                <th>Titre du jeu:</th>
                <th>Alias du jeu:</th>
                <th>Description :</th>
                <th>Date de création :</th>
                </tr>";
        $games = Game::where('name', 'LIKE', '%mario%')->get();
        foreach($games as $game) {
            $res .= "<tr>
                    <td>$game->id</td>
                    <td>$game->name</td>
                    <td>$game->alias</td>
                    <td>$game->description</td>
                    <td>$game->created_at</td>
                    </tr>";
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();
    }


public function afficherJeuxAPartir()
    {

        $res = "<h3>Question n°4 : liste de 442 jeux à partir du 21173ème</h3><br><br><table style=\"width:100 %\">
                <tr>
                <th>ID jeu:</th>
                <th>Titre du jeu:</th>
                <th>Alias du jeu:</th>
                <th>Description :</th>
                <th>Date de création :</th>
                </tr>";
        for ($i = 0; $i < 443; $i++) {
            $game = Game::where('id', '=', '21173' + $i)->first();
            $res .= "<tr>
                    <td>$game->id</td>
                    <td>$game->name</td>
                    <td>$game->alias</td>
                    <td>$game->description</td>
                    <td>$game->created_at</td>
                    </tr>";
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();
    }


public function paginationJeux()
    {
        $idmax = Game::select('id')->get();
        $nbPages = (count($idmax) / 500) + 1;
        $numPage = 1;
        $numeroPage = Slim::getInstance()->request->post('numeroPage');
        if (isset($numeroPage)) {
            $numPage = $numeroPage;
        }
        $valeurMax = $numPage * 500;
        $urlQuestion5 = Slim::getInstance()->urlFor("Projet1_Q5");
        $formulaireQuestion5 = "<form action='$urlQuestion5' method='post'><select name='numeroPage'>";
        for ($i = 1; $i < $nbPages; $i++) {
            $formulaireQuestion5 .= " <option value='$i'>$i</option> ";
        }
        $formulaireQuestion5 .= " </select> <input type='submit' value='Valider'> </form> ";

        $res = "<h3>Question n°5 : lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500)</h3>
                <br><br>$formulaireQuestion5<br><table style='width:100%'>
                <tr>
                <th>ID jeu:</th>
                <th>Titre du jeu:</th>
                <th>Deck :</th>
                </tr>
                ";

        for ($valeurMin = $valeurMax - 499; $valeurMin < $valeurMax + 1; $valeurMin++) {
            $jeuAffiche = Game::where('id', '=', $valeurMin)->first();
            if ($jeuAffiche != null) {
              $res .= "<tr>
                        <td>$jeuAffiche->id</td>
                        <td>$jeuAffiche->name</td>
                        <td>$jeuAffiche->deck</td>
                       </tr>";
            }
        }

        $res .= "</table>";

        $res .= $formulaireQuestion5;
        (new VuePrincipal($res))->render();

    }

}
