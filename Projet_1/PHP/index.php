<?php
/**
 * Created by PhpStorm.
 * Date: 2019-02-28
 * Time: 10:24
 */

require_once 'vendor/autoload.php';

use gamepedia\controleurs\ControleurUser;
use Illuminate\Database\Capsule\Manager as Manager;
use gamepedia\vues\VuePrincipal as VuePrincipal;
use gamepedia\controleurs\ControleurCompany as ControleurCompany;
use gamepedia\controleurs\ControleurGame as ControleurGame;
use gamepedia\controleurs\ControleurPlatform as ControleurPlatform;
use gamepedia\controleurs\ControleurLogs as ControleurLogs;
$db = new Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();

// On active le log des requetes SQL
$db::connection()->enableQueryLog();


$app = new \Slim\Slim;

$app->get('/', function () {
    (new VuePrincipal("<h3>Accueil</h3>"))->render();
});
$app->get('/principale', function () {
    (new VuePrincipal("<h3>Accueil</h3>"))->render();
});

$app->get('/projet1/question/:id', function ($id) {
    switch ($id) {
        case '1':
            (new ControleurGame())->afficherJeuxMario();

            break;
        case '2':
            (new ControleurCompany())->compagniesJap();
            break;
        case '3':
            (new ControleurPlatform())->grossesPlatforms();
            break;
        case '4':
            (new ControleurGame())->afficherJeuxAPartir();
            break;
        case '5':
            (new ControleurGame())->paginationJeux();
            break;
        default:
            (new VuePrincipal("Aucune question ne correspond à ce numéro"))->render();
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
            (new ControleurGame())->ratingBoardMario();
            break;
        case '5':
            (new ControleurGame())->jeuxDebutMario4Persos();
            break;
        case '6':
            (new ControleurGame())->jeuxMario3Plus();
            break;
        case '7':
            (new ControleurCompany())->jeuxCompagniesInc3Plus();
            break;
        default:
            (new VuePrincipal("Aucune question ne correspond à ce numéro"))->render();
            break;
    }
})->name("PROJET2");

$app->get('/projet3/question/:id', function ($id){
    switch ($id) {
        case '1':
            (new ControleurGame())->tempsExecutionListerJeux();
            break;
        case '2':
            (new ControleurGame())->tempsExecutionListerJeuxMario();
            break;
        case '3':
            (new ControleurGame())->tempsExecutionPersosMario();
            break;
        case '4':
            (new ControleurGame())->tempsExecutionListerMario3Plus();
            break;
        case '5':
            (new ControleurGame())->tempsExecutionJeuxWhere();
            break;
        case '6':
            (new ControleurLogs())->log1();
            break;
        case '7':
            (new ControleurLogs())->log2();
            break;
        case '8':
            (new ControleurLogs())->log3();
            break;
        case '9':
            (new ControleurLogs())->log4();
            break;
        case '10':
            (new ControleurLogs())->log5();
            break;
        case '11':
            (new ControleurLogs())->log4bis();
            break;
        case '12':
            (new ControleurGame())->personnagesJeuxDebutMarioOpti();
            break;
        case '13':
            (new ControleurCompany())->jeuxDeveloppesParSonyOpti();
            break;
        case '14':
            (new ControleurLogs())->log5bis();
            break;
        default:
            (new \gamepedia\vues\VuePrincipal("Aucune question ne correspond à ce numéro"))->render();
            break;
    }
})->name("PROJET3");


$app->get('/projet4/question/:id', function ($id){
    switch($id) {
        case '1':
            (new ControleurUser())->createUsersAndCommentsForGame12342();
            break;
        case '2':
            (new ControleurUser())->createALotOfUsersAndCommentsWithFaker();
            break;
        default:
            (new \gamepedia\vues\VuePrincipal("Aucune question ne correspond à ce numéro"))->render();
            break;
    }
})->name("PROJET4");

$app->post("/projet1/question/5", function() {
    (new \gamepedia\controleurs\ControleurGame())->paginationJeux();
})->name("Projet1_Q5");



$app->run();
