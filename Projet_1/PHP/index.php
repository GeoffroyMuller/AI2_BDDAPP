<?php
/**
 * Created by PhpStorm.
 * Date: 2019-02-28
 * Time: 10:24
 */

require_once 'vendor/autoload.php';

use gamepedia\controleurs\ControleurAPI;
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
    (new VuePrincipal("<h3>Bienvenue sur notre projet !</h3> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed tortor pulvinar, consectetur nisl sed, fermentum ipsum. Curabitur ac felis dui. Nunc eget ipsum convallis, egestas elit at, mattis purus. Aliquam ultrices, lorem at eleifend egestas, lorem mauris posuere arcu, sed vehicula velit velit sed odio. Duis sollicitudin non ante a porta. Aenean sodales dapibus lorem, sit amet dapibus elit vestibulum in. Nam non neque rutrum, convallis justo eu, mollis turpis. Aliquam sollicitudin arcu ante, ullamcorper imperdiet mi semper eget. Nam vestibulum blandit porta. Phasellus suscipit pellentesque neque, eu venenatis purus scelerisque ac. Integer dui diam, ultricies et lectus non, euismod imperdiet turpis. Morbi id pretium felis. Morbi lobortis sem ac nunc sollicitudin fringilla. Suspendisse potenti. Nullam dignissim porttitor imperdiet. Sed mauris leo, auctor at sollicitudin sed, gravida vel libero.

Mauris in gravida mi. Etiam vulputate dolor nec nisl bibendum feugiat commodo sit amet dolor. Vivamus sodales et felis quis bibendum. Nunc blandit et dolor ut accumsan. Morbi volutpat sed tellus eu interdum. Proin ac dignissim orci. Curabitur non dui at lacus tincidunt lacinia. Fusce rutrum nulla eu pharetra blandit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.

Quisque quis nisi sed ex sagittis pulvinar. Sed imperdiet bibendum pulvinar. Duis non consequat ante, sit amet molestie felis. Morbi imperdiet neque sapien, molestie finibus enim rutrum a. Suspendisse potenti. Donec sodales ornare justo, et mattis neque posuere ac. Quisque felis est, gravida non malesuada nec, condimentum eget metus. Mauris volutpat, urna id laoreet auctor, diam elit volutpat erat, at tempor erat mauris sit amet ligula. Maecenas commodo dui sed finibus suscipit. Donec sit amet lectus nec mi pulvinar consequat sit amet et odio. Aliquam erat volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce interdum diam id felis faucibus, at faucibus urna commodo.

</p>"))->render();
})->name("Accueil");

$app->get('/principale', function () {
    (new VuePrincipal("<h3>Bienvenue sur notre projet !</h3> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed tortor pulvinar, consectetur nisl sed, fermentum ipsum. Curabitur ac felis dui. Nunc eget ipsum convallis, egestas elit at, mattis purus. Aliquam ultrices, lorem at eleifend egestas, lorem mauris posuere arcu, sed vehicula velit velit sed odio. Duis sollicitudin non ante a porta. Aenean sodales dapibus lorem, sit amet dapibus elit vestibulum in. Nam non neque rutrum, convallis justo eu, mollis turpis. Aliquam sollicitudin arcu ante, ullamcorper imperdiet mi semper eget. Nam vestibulum blandit porta. Phasellus suscipit pellentesque neque, eu venenatis purus scelerisque ac. Integer dui diam, ultricies et lectus non, euismod imperdiet turpis. Morbi id pretium felis. Morbi lobortis sem ac nunc sollicitudin fringilla. Suspendisse potenti. Nullam dignissim porttitor imperdiet. Sed mauris leo, auctor at sollicitudin sed, gravida vel libero.

Mauris in gravida mi. Etiam vulputate dolor nec nisl bibendum feugiat commodo sit amet dolor. Vivamus sodales et felis quis bibendum. Nunc blandit et dolor ut accumsan. Morbi volutpat sed tellus eu interdum. Proin ac dignissim orci. Curabitur non dui at lacus tincidunt lacinia. Fusce rutrum nulla eu pharetra blandit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.

Quisque quis nisi sed ex sagittis pulvinar. Sed imperdiet bibendum pulvinar. Duis non consequat ante, sit amet molestie felis. Morbi imperdiet neque sapien, molestie finibus enim rutrum a. Suspendisse potenti. Donec sodales ornare justo, et mattis neque posuere ac. Quisque felis est, gravida non malesuada nec, condimentum eget metus. Mauris volutpat, urna id laoreet auctor, diam elit volutpat erat, at tempor erat mauris sit amet ligula. Maecenas commodo dui sed finibus suscipit. Donec sit amet lectus nec mi pulvinar consequat sit amet et odio. Aliquam erat volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce interdum diam id felis faucibus, at faucibus urna commodo.

</p>"))->render();
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
            (new VuePrincipal("Aucune question ne correspond à ce numéro"))->render();
            break;
    }
})->name("PROJET3");


$app->get('/projet4/question/:id', function ($id){
    switch($id) {
        case '1':
            (new ControleurUser())->createUsersAndCommentsForGame12342();
            break;
        case '2':
            (new ControleurUser())->createALotOfUsersWithFaker();
            break;
        case '3':
            (new ControleurUser())->createALotOfCommentsWithFaker();
            break;
        case '4':
            (new ControleurUser())->listUserComments();
            break;
        case '5':
            (new ControleurUser())->listUser5Comments();
            break;
        default:
            (new VuePrincipal("Aucune question ne correspond à ce numéro"))->render();
            break;
    }
})->name("PROJET4");

$app->get('/api/games/:id', function($id){
    (new ControleurAPI())->displayGameJson($id);
})->name("API_GAME");

$app->get('/api/games/', function(){
    (new ControleurAPI())->displayGames();
})->name("API_GAMES");

$app->get('/api/games/:id/characters', function($id) {
    (new ControleurAPI())->displayGameCharacters($id);
})->name("API_CHARACTERS");

$app->get('/api/games/:id/comments', function($id) {
    (new ControleurAPI())->displayGameComments($id);
})->name("API_COMMENTS");

$app->get('/projet/add_comment_json_tester', function() {
    (new ControleurAPI())->displayCommentTester();
})->name("ADD_COMMENT_API_TESTER");

$app->post('/api/games/:id/comments', function($id) {
    (new ControleurAPI())->addGameComment($id);
})->name("API_ADD_COMMENT");


$app->post('/projet4/question/4', function() {
    (new ControleurUser())->listUserComments();
})->name("Projet4_SEARCH_COMMENTS");

$app->post("/projet1/question/5", function() {
    (new \gamepedia\controleurs\ControleurGame())->paginationJeux();
})->name("Projet1_Q5");



$app->run();
