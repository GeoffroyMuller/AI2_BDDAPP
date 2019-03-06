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

$app = new \Slim\Slim ;

$app->get('/contientMario', function(){
    echo 'Mario';
});

echo '</br>========================</br>';
echo 'lister les jeux dont le nom contient \'Mario\' </br>';
echo 'Requete : Select ...</br>';
echo '<a href="/contientMario">Cliquer ici pour tester la requete</a>';
echo '</br>========================</br>';
echo 'lister les compagnies installées au Japon</br>';
echo 'Requete : Select ...</br>';
echo '<a href="">Cliquer ici pour tester la requete</a>';
echo '</br>========================</br>';
echo 'lister les plateformes dont la base installée est >= 10 000 000 </br>';
echo 'Requete : Select ...</br>';
echo '<a href="">Cliquer ici pour tester la requete</a>';
echo '</br>========================</br>';
echo 'lister 442 jeux à partir du 21173ème </br>';
echo 'Requete : Select ...</br>';
echo '<a href="">Cliquer ici pour tester la requete</a>';
echo '</br>========================</br>';
echo 'lister les jeux, afficher leur nom et deck, en paginant (taille des pages : 500) </br>';
echo 'Requete : Select ...</br>';
echo '<a href="">Cliquer ici pour tester la requete</a>';
echo '</br>========================</br>';


