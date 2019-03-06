<?php
/**
 * Created by PhpStorm.
 * Date: 2019-02-28
 * Time: 10:24
 */

require_once 'vendor/autoload.php';


use Illuminate\Database\Capsule\Manager as Manager;
use aibdd\models\Platform;

$db = new Manager();
$db->addConnection(parse_ini_file('src/conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();


$platforms = \aibdd\models\Platform::where('install_base', '>', 10000000) ;
echo "123";
foreach ($platforms as $platform){
    echo $platform;
}
