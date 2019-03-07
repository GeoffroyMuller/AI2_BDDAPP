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

$app->get('/Principal', function(){
    $vuePrincipal = new \gamepedia\vues\VuePrincipal("elem","QUESTION_VIEW");
    echo $vuePrincipal->render();
});


$app->get('projet1/question/:id', function($id){
    $selecteur = "QUESTION_VIEW";
    if($id == '1'){
        $selecteur = "Q1";
    }

    $vuePrincipal = new \gamepedia\vues\VuePrincipal("elem",$selecteur);
    echo $vuePrincipal->render();
});

$app->run();