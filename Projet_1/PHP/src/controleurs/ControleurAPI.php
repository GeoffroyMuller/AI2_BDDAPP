<?php
namespace gamepedia\controleurs;
use gamepedia\models\Game;
use gamepedia\vues\VueAPI;

class ControleurAPI
{


    public function displayGameJson($id_jeu) {
        $jeu = Game::where('id','=',$id_jeu)->first();
        if($jeu != null) {
            (new VueAPI($jeu))->render();
        }
    }

    public function displayGames() {
        $premiersJeux = array();


        $paramValue = \Slim\Slim::getInstance()->request()->get('page');
        if(isset($paramValue)) {
            for($i = (($paramValue-1)*200) + 1 ; $i <= (200*$paramValue); $i++) {
                $test = Game::where('id','=',$i)->first();
                $premiersJeux[$i] = $test;
            }
        } else {
            for($i = 1 ; $i <= 200 ; $i++) {
                $test = Game::where('id','=',$i)->first();
                $premiersJeux[$i] = $test;

            }
        }
        (new VueAPI($premiersJeux))->render();
    }
}