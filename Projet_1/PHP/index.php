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


$app = new \Slim\Slim ;

$app->get('/contientMario', function(){
    $vuePrincipal = new \gamepedia\vues\VuePrincipal("elem","QUESTION_VIEW");
    echo $vuePrincipal->render();
});
$app->run();

$app->get('projet1/question/:id', function($id){
    switch ($id) {
      case '1':
        $c = new \wishlist\controleurs\ControleurGame();
        $c->afficherJeuxMario();
        break;
      case '2':
        $c = new \wishlist\controleurs\ControleurCompany();
        $c->compagniesJap();
        break;
      case '3':
        $c = new \wishlist\controleurs\ControleurPlatform();
        $c->grossesPlatforms();
        break;
      case '4':
        $c = new \wishlist\controleurs\ControleurGame();
        $c->afficherJeuxAPartir();
        break;
      case '5':
        $c = new \wishlist\controleurs\ControleurGame();
        $c->paginationJeux();
        break;
      default:
        // code...
        break;
    }{

    }
});
