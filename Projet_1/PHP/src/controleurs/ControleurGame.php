<?php

namespace gamepedia\controleurs;

use gamepedia\models\Game;
use gamepedia\models\RatingBoard;
use gamepedia\vues\VuePrincipal as VuePrincipal;
use Slim\Slim as Slim;

class ControleurGame
{



    public function tempsExecutionListerJeux() {

        $res = "<h3> Temps d'execution pour lister tout les jeux : </h3>";
        $tempsDepart = microtime(true);
        $jeux = Game::all();
        $tempsFin = microtime(true);

        $duree = $tempsFin - $tempsDepart;

        $res .= "<p>Temps d'execution : $duree</p>";
        (new VuePrincipal($res))->render();
    }
    public function personnagesJeu12342() {
        $res = "<h3>Question n°1 : personnages du jeu 12342</h3>";
        $jeu = Game::where('id','=','12342')->first();
        $charactersFor12342 = $jeu->personnages;
        foreach($charactersFor12342 as $character) {
           $res .= "Personnage : $character->name || Deck : $character->deck <br>";
        }
        (new VuePrincipal($res))->render();

    }

public function ratingBoardMario() {
    $games = Game::where('name', 'LIKE', '%mario%')->get();
    $res = "<h3>Question n°4 : rating boards des jeux contenant Mario</h3>";
    foreach($games as $marioGame) {
        $ratingsMario = $marioGame->ratings;
        foreach($ratingsMario as $ratingMario) {
            $ratingBoard = RatingBoard::where('id', '=',$ratingMario->rating_board_id)->first();
            $res .= " Rating Board : $ratingBoard->name ($ratingBoard->deck) <br>";
        }
    }
    (new VuePrincipal($res))->render();
}

public function jeuxDebutMario4Persos() {
    $res = "<h3>Question n°5 : jeux dont le nom commence par Mario avec au moins 4 personnaes</h3>";
    $marioGames = Game::where('name','LIKE','Mario%')->get();
    foreach($marioGames as $game) {
        if($game->personnages()->count() > 3) {
            $res .= "Jeu commençant par Mario avec au moins 4 personnages : $game->name <br>";
        }
    }
    (new VuePrincipal($res))->render();
}

public function jeuxMario3Plus() {
    $res = "<h3>Question n°6 : jeux dont le nom commence par mario et classés 3+ en rating</h3>";
    $marioGames = Game::where('name','LIKE','Mario%')->get();
    foreach($marioGames as $game) {
        $ratings = $game->ratings()->where('name','like','%3+%','and','game_id','=',$game->id)->count();
        if($ratings >= 1) {
            $res .= "Jeu 3+ commençant par Mario : $game->name <br>";
        }

    }
    (new VuePrincipal($res))->render();
}
    public function personnagesJeuxDebutMario(){
        $res = "<h3>Question n°2 : personnages des jeux commençant par mario</h3>";
        $marioGames = Game::where('name','LIKE','Mario%')->get();
        foreach($marioGames as $marioGame) {
            foreach($marioGame->personnages as $personnage) {
                $res .= "Personnage du jeu commençant par Mario : $personnage->name <br>";
            }
        }
        (new VuePrincipal($res))->render();
    }
    public function afficherJeuxMario()
    {
        $res = "<h3>Question n°1 : liste des jeux contenant Mario dans leur titre</h3>";
        $games = Game::where('name', 'LIKE', '%mario%')->get();
        foreach($games as $game) {
            $res .= "Nom du jeu : $game->name </br>";
        }
        (new VuePrincipal($res))->render();
    }

    public function afficherJeuxAPartir()
    {

        $res = "<h3>Question n°4 : liste de 442 jeux à partir du 21173ème</h3>";
        for ($i = 0; $i < 443; $i++) {
            $jeu = Game::where('id', '=', '21173' + $i)->first();
            $res .= "id: $jeu->id,  nom: $jeu->name <br>";
        }
        (new VuePrincipal($res))->render();
    }

    public function paginationJeux()
    {
        $res = "<h3>Question n°5 : lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500)</h3>";
        $idmax = Game::select('id')->get();
        $nbPages = (count($idmax) / 500) + 1;
        $numPage = 1;
        $numeroPage = Slim::getInstance()->request->post('numeroPage');
        if (isset($numeroPage)) {
            $numPage = $numeroPage;
        }
        $valeurMax = $numPage * 500;
        for ($valeurMin = $valeurMax - 499; $valeurMin < $valeurMax + 1; $valeurMin++) {
            $jeuAffiche = Game::where('id', '=', $valeurMin)->first();
            if ($jeuAffiche != null) {
                $res .="<ul>";
                $res .="<li>Identifiant du jeu: $jeuAffiche->id</li>";
                $res .="<li>Nom du jeu: $jeuAffiche->name</li>";
                $res .="<li>Description du deck: $jeuAffiche->deck</li>";
                $res .="</ul>";
            }
        }

        $urlQuestion5 = Slim::getInstance()->urlFor("Projet1_Q5");
        $formulaireQuestion5 = "<form action='$urlQuestion5' method='post'><select name='numeroPage'>";
        for ($i = 1; $i < $nbPages; $i++) {
            $formulaireQuestion5 .= " <option value='$i'>$i</option> ";
        }
        $formulaireQuestion5 .= " </select> <input type='submit' value='Valider'> </form> ";
        $res .= $formulaireQuestion5." </body></html> ";
        (new VuePrincipal($res))->render();

    }

}
