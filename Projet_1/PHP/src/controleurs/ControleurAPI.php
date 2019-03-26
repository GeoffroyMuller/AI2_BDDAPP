<?php
namespace gamepedia\controleurs;
use gamepedia\models\Game;
use gamepedia\vues\VueAPI;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ControleurAPI
{


    public function displayGameJson($id_jeu) {
        $app = \Slim\Slim::getInstance();
        try{
          $jeu = Game::where('id','=',$id_jeu)->firstOrFail();
        }catch (ModelNotFoundException $e){
          $app->response->setStatus(404);
          $app->response->headers->set('Content-Type', 'application/json');
          echo json_encode(['error' => 404, 'message'=>'game not found']);
          return;
        }

        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');
        echo json_encode($jeu->toArray());

    }

    public function displayGames() {
        $app = \Slim\Slim::getInstance();
        $premiersJeux = array();

        $paramValue = \Slim\Slim::getInstance()->request()->get('page');
        if(isset($paramValue) && is_numeric($paramValue)) {
            try{
                for($i = (($paramValue-1)*200) + 1 ; $i <= (200*$paramValue); $i++) {
                    $test = Game::where('id','=',$i)->first();
                    $var = json_decode(json_encode($test),true);
                    $var['self']= ['href'=>'http://'.$app->request()->getHostWithPort().$app->request()->getRootUri()."/api/games/$i"];
                    $premiersJeux[$i] = $var;
                }
            }catch (ModelNotFoundException $e){
                $app->response->setStatus(404);
                $app->response->headers->set('Content-Type', 'application/json');
                echo json_encode(['error' => 404, 'message'=>'game not found']);
                return;
            }
            $premiersJeux[$i] = $test;

        } else {
            for($i = 1 ; $i <= 200 ; $i++) {
              try{
                $test = Game::where('id','=',$i)->first();
              }catch (ModelNotFoundException $e){
                  $app->response->setStatus(404);
                  $app->response->headers->set('Content-Type', 'application/json');
                  echo json_encode(['error' => 404, 'message'=>'game not found']);
                  return;
              }
                $premiersJeux[$i] = $test;
            }
        }

        $app->response->setStatus(200);
        $app->response->headers->set('Content-Type', 'application/json');

        $json = json_encode($premiersJeux);
        echo $json;

    }
}
