<?php
/**
 * Created by PhpStorm.
 * Date: 2019-02-28
 * Time: 10:24
 */

require_once 'vendor/autoload.php';

use gamepedia\models\Game as Game;
use gamepedia\models\Platform as Platform;
use gamepedia\models\Company as Company;
use gamepedia\models\Genre as Genre;
use gamepedia\models\Character as Character;
use gamepedia\models\Theme as Theme;
use gamepedia\models\GameRating as GameRating;
use gamepedia\models\RatingBoard as RatingBoard;
use Illuminate\Database\Capsule\Manager as Manager;

$db = new Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();




echo "<h3>Q5</h3>";

foreach($marioGames as $game) {
    if($game->personnages()->count() > 3) {
        echo "Jeu commençant par Mario avec au moins 4 personnages : $game->name <br>";
    }
}
echo "<br><br><br><br>";

echo "<h3>Q6</h3>";
foreach($marioGames as $game) {
    $ratings = $game->ratings()->where('name','like','%3+%','and','game_id','=',$game->id)->count();
    if($ratings >= 1) {
        echo "Jeu 3+ commençant par Mario : $game->name <br>";
    }

}

echo "<br><br><br><br>";

echo "<h3>Q7</h3>";
$incCompanies= Company::where('name','like','%Inc.%')->get();
foreach($incCompanies as $incCompany){
    $incMarioGames = $incCompany->jeuxPublies()->where('name','like','%mario%')->get();
    foreach($incMarioGames as $incMarioGame) {

        $respectRating = $incMarioGame->ratings()->where('name','like','%3+%','and','game_','=',$game->id)->count();
        if($respectRating >= 1) {
            echo "Jeu 3+ contenant Mario et publie par Inc.: $incMarioGame->name <br>";
        }
    }
}
echo "<br><br><br><br>";
