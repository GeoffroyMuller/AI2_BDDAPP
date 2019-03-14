<?php
/**
 * Created by PhpStorm.
 * Date: 2019-02-28
 * Time: 10:24
 */

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Manager;
use gamepedia\models\Game as Game;
use gamepedia\models\Platform as Platform;
use gamepedia\models\Company as Company;
use gamepedia\vues\VuePrincipal;
use gamepedia\controleurs\ControleurCompany as ControleurCompany;
use gamepedia\controleurs\ControleurGame as ControleurGame;
$db = new Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();


$app = new \Slim\Slim;

$app->get('/', function () {
    (new \gamepedia\vues\VuePrincipal("elem", "ALL_VIEW"))->render();
});
$app->get('/principale', function () {
    (new \gamepedia\vues\VuePrincipal("elem", "ALL_VIEW"))->render();
});

$app->get('/projet1/question/:id', function ($id) {
    switch ($id) {
        case '1':
            (new \gamepedia\controleurs\ControleurGame())->afficherJeuxMario();
            break;
        case '2':
            (new \gamepedia\controleurs\ControleurCompany())->compagniesJap();
            break;
        case '3':
            (new \gamepedia\controleurs\ControleurPlatform())->grossesPlatforms();
            break;
        case '4':
            (new \gamepedia\controleurs\ControleurGame())->afficherJeuxAPartir();
            break;
        case '5':
            (new \gamepedia\controleurs\ControleurGame())->paginationJeux();
            break;
        default:
            (new \gamepedia\vues\VuePrincipal("elem", "ALL_VIEW"))->render();
            break;
    }
})->name("PROJET1");


$app->get('/projet2/question/:id', function ($id){
    switch ($id) {
        case '1':
            (new ControleurGame())->personnagesJeu12342();
            break;
        case '2':
            (new ControleurGame())->personnagesJeuxDebutMario();
            break;
        case '3':
            (new ControleurCompany())->jeuxDeveloppesParSony();
            break;
        case '4':

            break;
        case '5':

            break;
        case '6':

            break;
        case '7':

            break;
        default:
            (new \gamepedia\vues\VuePrincipal("elem", "ALL_VIEW"))->render();
            break;
    }
})->name("PROJET2");


$app->post("/projet1/question/5", function() {
    (new \gamepedia\controleurs\ControleurGame())->paginationJeux();
})->name("Projet1_Q5");
$app->run();