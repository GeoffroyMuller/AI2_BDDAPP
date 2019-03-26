<?php
namespace gamepedia\controleurs;
use DateTime;
use gamepedia\models\Comment;
use gamepedia\models\Game;
use gamepedia\models\User;
use gamepedia\vues\VueAPI;
use gamepedia\vues\VuePrincipal;
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

    public function displayCommentTester() {
        $urlTryAddComment = Slim::getInstance()->urlFor("API_ADD_COMMENT", ['id' => 12342]);
        $res = "<h3> Ajouter un commentaire</h3>";
        $res .= "<p> Vous pouvez essayer de rajouter un commentaire au format JSON dans la 
                    zone de texte ci-dessous. 
                    <br> Le commentaire sera ajoute au jeu 12342.
                    <br>Voici un exemple : 
                    <br>{\"title\":\"Nouveau commentaire\",\"content\":\"Ce jeu est interessant.\",\"user_mail\":\"user1@mail.com\",\"created_at\":\"2019-03-26 20:00:01\"}";
        $res .= "<form action='$urlTryAddComment' method='post'>";
        $res .= "<input title=\"Votre requête JSON\" id=\"json_request\" name=\"json_request\" type=\"text\" />";
        $res .= "<input type='submit' value='Valider'> </form> ";
        $res .= "</body></html>";
        (new VuePrincipal($res))->render();
    }

    public function addGameComment($id_jeu) {
        try {
            // Jeu existant
            $jeu = Game::where('id','=',$id_jeu)->firstOrFail();
            $requeteJSON = Slim::getInstance()->request->post('json_request');
            if(isset($requeteJSON)) {
                //JSON Existant
                $contenuJSON = json_decode($requeteJSON,true);
                if(json_last_error() === JSON_ERROR_NONE) {
                    // JSON valide
                    $title = filter_var($contenuJSON['title'], FILTER_SANITIZE_STRING);
                    $content = filter_var($contenuJSON['content'], FILTER_SANITIZE_STRING);
                    $user_mail = filter_var($contenuJSON['user_mail'], FILTER_SANITIZE_EMAIL);
                    $user = User::where('mail','=',$user_mail)->firstOrFail();
                    // Utilisateur existant
                    $created_at = new DateTime($contenuJSON['created_at']);
                    $updated_at = null;
                    if (array_key_exists("updated_at",$contenuJSON))    $updated_at = new DateTime($contenuJSON['updated_at']);
                    if($content != null && $title != null && $created_at != null) {
                        // Donnees importantes non nulles
                        $comment = new Comment;
                        $comment->title = $title;
                        $comment->content = $content;
                        $comment->created_at = $created_at;
                        $comment->game_id = $id_jeu;
                        $comment->user_mail = $user_mail;
                        if($updated_at != null) $comment->updated_at = $updated_at;
                        $comment->save();
                } else {
                    throw new \Exception("Certains paramètres manquent dans la requête JSON");
                }
            } else {
                throw new \Exception("La requête JSON est mal écrite");
            }
            } else {
                throw new \Exception("Le POST de la requête JSON est introuvable (il doit être json_request)");
            }
        } catch(ModelNotFoundException $e) {
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
            echo json_encode(['Erreur' => 404, 'Information'=>'Jeu ou utilisateur introuvable']);
            return;
        } catch (\Exception $oe) {
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
            echo json_encode(['Erreur' => 400, 'Information'=>"$oe"]);
            return;
        }
        $this->app->response->setStatus(201);
        $this->app->response->headers->set('Content-Type', 'application/json');
        echo json_encode(['Succès'=>'Ajout effectué avec succès']);
    }


    public function displayGameComments($id_jeu) {
        try{
            $jeu = Game::where('id','=',$id_jeu)->firstOrFail();
            $personnages = $jeu->comments()->get();
        }catch (ModelNotFoundException $e){
            $this->app->response->setStatus(404);
            $this->app->response->headers->set('Content-Type', 'application/json');
            echo json_encode(['Erreur' => 404, 'Information'=>'Jeu demande non trouve']);
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
            echo json_encode(['Erreur' => 404, 'Information'=>'Jeu demande non trouve']);
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
            echo json_encode(['Erreur' => 404, 'Information'=>'Jeu demande non trouve']);
            return;
        }
        $this->app->response->setStatus(200);
        $this->app->response->headers->set('Content-Type', 'application/json');
        $json = json_encode($premiersJeux);
        echo $json;

    }
}
