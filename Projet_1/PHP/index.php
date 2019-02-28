<?php
/**
 * Created by PhpStorm.
 * Date: 2019-02-28
 * Time: 10:24
 */

require_once 'vendor/autoload.php';


use Illuminate\Database\Capsule\Manager as Manager;

$db = new Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();


//Question 1 : tous les jeux qui contiennent le mot Mario
echo "<h3>Question n°1 : liste des jeux contenant Mario dans leur titre</h3>";
$games = Game::where('name', 'LIKE','%mario%')->get();
foreach($games as $game) {
    echo "Nom du jeu : $game->name <br>";
}
