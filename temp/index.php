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

/*
$app = new \Slim\Slim ;

$app->get('/contientMario', function(){
    echo 'Mario';
});*/


//Question 1 PR2
echo "<h3>Q1</h3>";
$jeu = Game::where('id','=','12342')->first();
$charactersFor12342 = $jeu->personnages;
foreach($charactersFor12342 as $character) {
   echo "Personnage : $character->name || Deck : $character->deck <br>";
}

echo "<br><br><br><br>";

//Question 2 PR2
echo "<h3>Q2</h3>";
$marioGames = Game::where('name','LIKE','Mario%')->get();
//$charactersForMarioGame = $games->personnages;
foreach($marioGames as $marioGame) {
    foreach($marioGame->personnages as $personnage) {
        echo "Personnage du jeu commençant par Mario : $personnage->name <br>";
    }
}
echo "<br><br><br><br>";





//Question 3 PR3
echo "<h3>Q3</h3>";
$sonyCompanies= Company::where('name','like','%sony%')->get();
foreach($sonyCompanies as $sonyCompany){
    //echo "test<br>";
    $sonyGames = $sonyCompany->jeuxPublies;
    foreach($sonyGames as $sonyGame) {
        echo "Jeu Sony : $sonyGame->name <br>";
    }
}
echo "<br><br><br><br>";

echo "<h3>Q4</h3>";

foreach($games as $marioGame) {
    $ratingsMario = $marioGame->ratings;
    foreach($ratingsMario as $ratingMario) {
        $ratingBoard = RatingBoard::where('id', '=',$ratingMario->rating_board_id)->first();
        echo " Rating Board : $ratingBoard->name ($ratingBoard->deck) <br>";
        /* ->rating_board_id temporaire :: TODO :: question a fixer
         * $ratingMario->ratingBoards; ne fonctionne pas;
         * */
    }
}

/* faux ancienns modeles
foreach ($games as $game){
    $temp=$game->id;
    $game2ratings = GameRating::where('game_id', '=', $temp)->get();
    foreach ($game2ratings as $game2rating){
        $temp=$game2rating->rating_id;
        $rating_boards = RatingBoard::where('id', '=', $temp)->get();
        foreach ($rating_boards as $rating_board) {
            echo"Nom du jeu: $game->name<br>";
            echo"Rating: $rating_board->name<br>";
        }
    }
}*/
echo "<br><br><br><br>";

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
