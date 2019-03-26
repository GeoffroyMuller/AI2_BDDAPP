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
}