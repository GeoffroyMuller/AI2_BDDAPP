<?php
/**
 * Created by PhpStorm.
 * Date: 2019-02-28
 * Time: 10:24
 */

require_once 'vendor/autoload.php';

use aibdd\models\Game as Game;
use aibdd\models\Platform as Platform;
use aibdd\models\Company as Company;
use Illuminate\Database\Capsule\Manager as Manager;

$db = new Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();


$app = new \Slim\Slim ;

$app->get('/contientMario', function(){
    echo 'Mario';
});


//Question 1 : tous les jeux qui contiennent le mot Mario
echo "<h3>Question n°1 : liste des jeux contenant Mario dans leur titre</h3>";
$games = Game::where('name', 'LIKE','%mario%')->get();
foreach($games as $game) {
    echo "Nom du jeu : $game->name <br>";
}

//Question 2 : toutes les entreprises installees au Japon
echo "<h3>Question n°2 : liste des compagnies installees au japon</h3>";
$companies = Company::where('location_country','=', 'Japan')->get();
foreach($companies as $company) {
    echo "Nom de la compagnie : $company->name <br>";
}

//Question 3 : plateformes ayant plus de 10M d'installations
echo "<h3>Question n°3 : liste des plateformes ayant plus de 10M d'installations</h3>";
$platforms = Platform::where('install_base', '>=','10000000')->get();
foreach($platforms as $platform) {
    echo "Nom de la plateforme : $platform->name <br>";
}

//Question 4: 442 jeux à partir du 21173ème
echo "<h3>Question n°4 : liste de 442 jeux à partir du 21173ème</h3>";

$jeux = Game::where('id', '=', '21173')->first();
for($i = 0; $i<443; $i++){
  $jeu = Game::where('id', '=', '21173' +$i)->first();
  echo "id: $jeu->id,  nom: $jeu->name <br>";
}

//Question 5: lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500)
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
