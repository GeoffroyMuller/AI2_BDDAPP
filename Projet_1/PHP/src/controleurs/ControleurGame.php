<?php

namespace gamepedia\controleurs;

use gamepedia\models\Game;

class ControleurGame{

  public function afficherJeuxMario(){

    $games = Game::where('name', 'LIKE','%mario%')->get();
    $vue = new VuePrincipal($games, "P1Q1")

  }

  public function afficherJeuxAPartir(){
    echo "<h3>Question n°4 : liste de 442 jeux à partir du 21173ème</h3>";

    $jeux = Game::where('id', '=', '21173')->first();
    for($i = 0; $i<443; $i++){
      $jeu = Game::where('id', '=', '21173' +$i)->first();
      echo "id: $jeu->id,  nom: $jeu->name <br>";
    }
  }

  public function paginationJeux(){
    echo "<h3>Question n°5 : lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500)</h3>";
    $idmax = Game::select('id')->get();
    $nbPages = (count($idmax)/500)+1;
    $numPage = 1;

    // Lors du passage avec Slim, utilisez la methode post de Slim.
    if(isset($_POST['numeroPage'])) {
        $numPage = $_POST['numeroPage'];
    }

    $valeurMax = $numPage * 500;
    for($valeurMin = $valeurMax - 499 ; $valeurMin < $valeurMax + 1 ; $valeurMin++) {
        $jeuAffiche = Game::where('id', '=',$valeurMin)->first();
        if($jeuAffiche != null) {
            echo "<ul>";
            echo "<li>Identifiant du jeu: $jeuAffiche->id</li>";
            echo "<li>Nom du jeu: $jeuAffiche->name</li>";
            echo "<li>Description du deck: $jeuAffiche->deck</li>";
            echo "</ul>";
        }

    }

    $formulaireQuestion5 = "<form action='index.php' method='post'><select name='numeroPage'>";
    for($i = 1 ; $i < $nbPages ; $i++) {
        $formulaireQuestion5 .= " <option value='$i'>$i</option> ";
    }
    $formulaireQuestion5 .= " </select> <input type='submit' value='Valider'> </form> ";
    echo $formulaireQuestion5." </body></html> ";
  }

}
