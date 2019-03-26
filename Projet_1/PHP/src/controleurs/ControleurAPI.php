<?php
namespace gamepedia\controleurs;
use DateTime;
use gamepedia\models\Comment;
use gamepedia\models\Game;
use gamepedia\models\User;
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


    public function addGameComment($id_jeu) {

        /* {
         * "id":602928,
         * "content":"Explicabo voluptas harurum ipsurum voluptatem quo deleniti.",
         * "written_date":"2019-03-26 11:30:10",
         * "game_id":1169,
         * "user_mail":"Cletus.Casper67054@example.net",
         * "created_at":"2019-03-26 11:30:10",
         * "updated_at":null
         * }
         */

        try {
            $jeu = Game::where('id','=',$id_jeu)->firstOrFail();
            $requeteJSON = Slim::getInstance()->request->post('json_request');
            if(isset($requeteJSON)) {
            $contenuJSON = json_decode($requeteJSON,true);
            if(json_last_error() === JSON_ERROR_NONE) {
                // JSON valide


                $content = filter_var($contenuJSON['content'], FILTER_SANITIZE_STRING);
                $written_date = new DateTime($contenuJSON['written_date']);
                $user_mail = filter_var($contenuJSON['user_mail'], FILTER_SANITIZE_EMAIL);
                $user = User::where('mail','=',$user_mail)->firstOrFail();
                $created_at = new DateTime($contenuJSON['created_at']);
                $updated_at = new DateTime($contenuJSON['updated_at']);
                if($content != null && $written_date != null && $created_at != null) {
                    $comment = new Comment;
                    $comment->content = $content;
                    $comment->written_date = $written_date;
                    $comment->created_at = $created_at;
                    $comment->game_id = $id_jeu;
                    $comment->user_mail = $user_mail;
                    if($updated_at != null) {
                        $comment->updated_at = $updated_at;
                    }
                    $comment->save();
                } else {
                    throw new \Exception("Parametres manquants $id $content ");
                }
            } else {
                throw new \Exception("Erreur JSON");
            }
            } else {
                throw new \Exception("Parametre POST introuvable");
            }
        } catch(ModelNotFoundException $e) {
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
            echo json_encode(['error' => 404, 'Information'=>'Jeu demande non trouve']);
            return;
        } catch (\Exception $oe) {
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
            echo json_encode(['error' => 404, 'Exception'=>"$oe"]);
            return;
        }
        $this->app->response->setStatus(200);
        $this->app->response->headers->set('Content-Type', 'application/json');
        echo json_encode(['OK'=>'Operation effectuee avec succes']);
    }


    public function displayGameComments($id_jeu) {
        try{
            $jeu = Game::where('id','=',$id_jeu)->firstOrFail();
            $personnages = $jeu->comments()->get();
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
