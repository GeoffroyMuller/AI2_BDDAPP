<?php

namespace gamepedia\controleurs;

use gamepedia\models\Company;
use gamepedia\models\Character;
use gamepedia\models\Game;
use gamepedia\models\Platform;
use gamepedia\models\RatingBoard;

use Illuminate\Database\Capsule\Manager as Manager;
use \gamepedia\vues\VuePrincipal as VuePrincipal;

class ControleurLogs
{

    public function logs(){

      $requetes = Manager::getQueryLog();
      $res = ("<br>".count($requetes)." requetes:<br>");
      foreach ($requetes as $requete) {
        $res .= $requete['query']."<br><br>";
      }

      (new VuePrincipal($res))->render();
    }

    public function log1(){
      $games = Game::where('name', 'LIKE', '%mario%')->get();
      foreach($games as $game) {

      }
      $this->logs();
    }

    public function log2(){
      $jeu = Game::where('id','=','12342')->first();
      $charactersFor12342 = $jeu->personnages;
      foreach($charactersFor12342 as $character) {

      }
      $this->logs();
    }

    public function log3(){
        $mariogames = Game::where('name','like','%mario%')->get();
        foreach($mariogames as $mariogame) {
            $charsJeu = $mariogame->personnagesFirstApparition()->get();
        }
        $this->logs();
    }

    public function log4(){
      $marioGames = Game::where('name','LIKE','Mario%')->get();
      foreach($marioGames as $marioGame) {
          foreach($marioGame->personnages as $personnage) {
          }
      }
      $this->logs();
    }

    public function log4bis(){
      $test = Game::where('name','LIKE','Mario%')->with('personnages')->get();

      foreach ($test as $ui) {
        foreach($ui->personnages as $personnage) {
        }
      }

      $this->logs();

    }

    public function log5(){
      $sonyCompanies= Company::where('name','like','%sony%')->get();
      foreach($sonyCompanies as $sonyCompany){
          $sonyGames = $sonyCompany->jeuxPublies;
          foreach($sonyGames as $sonyGame) {
          }
      }
      $this->logs();
    }

    public function log5bis(){
      $sonyCompanies= Company::where('name','like','%sony%')->with('jeuxPublies')->get();
      foreach ($sonyCompanies as $sony) {
        foreach ($sony->jeuxPublies as $jeu) {
        }
      }
      $this->logs();
    }

}
