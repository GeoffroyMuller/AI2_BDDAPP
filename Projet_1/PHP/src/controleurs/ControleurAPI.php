<?php
namespace gamepedia\controleurs;
use gamepedia\models\Game;
use gamepedia\vues\VueAPI;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Slim as Slim;

class ControleurAPI
{
    private $app;
    public function __construct()
    {
        $this->app = Slim::getInstance();
    }

    public function displayGameJson($id_jeu) {
        try{
          $jeu = Game::where('id','=',$id_jeu)->firstOrFail();
        }catch (ModelNotFoundException $e){
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
          echo json_encode(['error' => 404, 'Information'=>'Jeu demande non trouve']);
          return;
        }
        $this->app->response->setStatus(200);
        $this->app->response->headers->set('Content-Type', 'application/json');
        echo json_encode($jeu->toArray());

    }



    public function displayGameCharacters($id_jeu) {
        try{
            $jeu = Game::where('id','=',$id_jeu)->firstOrFail();
            $personnages = $jeu->personnages()->get();
        }catch (ModelNotFoundException $e){
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
            echo json_encode(['error' => 404, 'Information'=>'Jeu demande non trouve']);
            return;
        }
        $this->app->response->setStatus(200);
        $this->app->response->headers->set('Content-Type', 'application/json');
        echo json_encode($personnages->toArray());
    }


    public function displayGames() {
        $premiersJeux = array();
        $paramValue = \Slim\Slim::getInstance()->request()->get('page');
        if(!isset($paramValue) || !is_numeric($paramValue))  $paramValue = 1;
        try{
            $url = $this->app->request()->getHostWithPort().$this->app->request()->getRootUri();
            if($paramValue <= 0)    $paramValue = 1;
            for($i = (($paramValue-1)*200) + 1 ; $i <= (200*$paramValue); $i++) {
                $jeu = Game::where('id','=',$i)->first();
                $var = json_decode(json_encode($jeu),true);
                $var['self'] = array('href'=>"http://$url/api/games/$i",
                                    'comments'=>"http://$url/api/games/$i/comments",
                                    'characters'=>"http://$url/api/games/$i/characters");
                $premiersJeux[$i] = $var;
            }
            $pagePrec = $paramValue - 1;
            $pageSuiv = $paramValue + 1;
            $premiersJeux['links'] = array('prec'=>"http://$url/api/games?page=$pagePrec",
                                           'suiv'=>"http://$url/api/games?page=$pageSuiv");
        }catch (ModelNotFoundException $e){
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
            echo json_encode(['error' => 404, 'Information'=>'Jeu demande non trouve']);
            return;
        }
        $this->app->response->setStatus(200);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $json = json_encode($premiersJeux);
        echo $json;

    }
}
