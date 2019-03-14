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


$db = new Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();


$app = new \Slim\Slim;

$app->get('/Principale', function () {
    $vuePrincipal = new \gamepedia\vues\VuePrincipal("elem", "ALL_VIEW");
    $vuePrincipal->render();
});

$app->get('/projet1/question/:id', function ($id) {
    switch ($id) {
        case '1':
            $c = new \gamepedia\controleurs\ControleurGame();
            $c->afficherJeuxMario();
            break;
        case '2':
            $c = new \gamepedia\controleurs\ControleurCompany();
            $c->compagniesJap();
            break;
        case '3':
            $c = new \gamepedia\controleurs\ControleurPlatform();
            $c->grossesPlatforms();
            break;
        case '4':
            $c = new \gamepedia\controleurs\ControleurGame();
            $c->afficherJeuxAPartir();
            break;
        case '5':
            $c = new \gamepedia\controleurs\ControleurGame();
            $c->paginationJeux();
            break;
        default:
            // code...
            break;
    }
    {

    }
})->name("PROJET1");

$app->run();