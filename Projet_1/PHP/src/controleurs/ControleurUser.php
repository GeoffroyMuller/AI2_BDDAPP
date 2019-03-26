<?php
namespace gamepedia\controleurs;


use DateTime;
use gamepedia\models\Comment;
use gamepedia\models\User;
use gamepedia\vues\VuePrincipal;
use Faker\Factory as FakerFactory;
use Slim\Slim;

class ControleurUser
{

    // Creer 2 utilisateurs et 3 commentaires concernant le jeu 12342
    public function createUsersAndCommentsForGame12342() {
        try {
            // Creation du premier utilisateur
            $user = new User;
            $user->mail = 'user1@mail.com';
            $user->lastname = 'Riley';
            $user->firstname = 'Cecil';
            $user->address = '5224 Samaritan Dr, Washington DC';
            $user->phone = '(227)-654-9237';
            $user->born = (new DateTime("1984-05-11 00:00:00"));
            $user->save();
            // Ajout de ses commentaires
            for($i = 1; $i <= 3 ; $i++) {
                $creationDate = new DateTime();
                $comment = new Comment;
                $comment->content = "Commentaire numero $i";
                $comment->written_date = $creationDate;
                $comment->created_at = $creationDate;
                $comment->game_id = 12342;
                $comment->user_mail = 'user1@mail.com';
                $comment->save();
            }
            //Creation du second utilisateur
            $user2 = new User;
            $user2->mail = 'user2@mail.com';
            $user2->lastname = 'Dubois';
            $user2->firstname = 'Robin';
            $user2->address = '11 rue Charlemagne, 31000 Toulouse';
            $user2->phone = '06-12-13-14-15';
            $user2->born = (new DateTime("1954-12-23 00:00:00"));
            $user2->save();
            // Ajout de ses commentaires
            for($i = 1; $i <= 3 ; $i++) {
                $creationDate = new DateTime();
                $comment = new Comment;
                $comment->content = "Commentaire numero $i";
                $comment->written_date = $creationDate;
                $comment->created_at = $creationDate;
                $comment->game_id = 12342;
                $comment->user_mail = 'user2@mail.com';
                $comment->save();
            }
            (new VuePrincipal("<h3>Insertions effectuées avec succès</h3>"))->render();
        } catch (\Exception $e) {
            (new VuePrincipal("<h3>Erreur lors de l'insertion : vous avez surement deja insere les utilisateurs dans la table.</h3> <br><br><h5>Detail de l'erreur :</h5> <br> $e"))->render();
        }


    }

    // TODO : modifier la methode pour qu'elle ajoute 250000 commentaires mais un nombre aleatoire de commentaire par utilisateur

    // Inserer 25000 utilisateurs et 10 commentaires par utilisateur
    // Cette methode est particulierement longue puisqu'elle fait 275000 insertions
    // Penser a augmenter max_execution_time dans la configuration php (300s recommande)
    // Idem pour les erreurs de memoire, augmenter memory_limit dans la configuration php (1024M recommande)
    public function createALotOfUsersAndCommentsWithFaker() {
        try {
        $faker = FakerFactory::create();

        for($i = 0 ; $i < 25000 ; $i++) {
            // Creer un utilisateur random realiser et l'inserer.
            $user = new User;
            // Ici on n'utilise pas $faker->email qui causait des problemes de duplication.
            $mail = $faker->firstName.'.'.$faker->lastName.$faker->numberBetween(0,99999).'@'.$faker->safeEmailDomain;
            $user->mail = $mail;
            $user->lastname = $faker->lastName;
            $user->firstname =  $faker->firstName;
            $user->address = $faker->address;
            $user->phone = $faker->phoneNumber;
            $user->born = $faker->dateTime;
            $user->save();
            for($j = 0 ; $j < 10 ; $j ++) {
                $creationDate = new DateTime();
                $comment = new Comment;
                $comment->content = $faker->text(200);
                $comment->written_date = $creationDate;
                $comment->created_at = $creationDate;
                $comment->game_id = $faker->numberBetween(1,47948);
                $comment->user_mail = $mail;
                $comment->save();
            }
        }
            (new VuePrincipal("<h3>Insertions effectuées avec succès</h3>"))->render();
        } catch (\Exception $e) {
            (new VuePrincipal("<h3>Erreur lors de l'insertion : </h3> <br><br> $e"))->render();
        }
    }


   // public function
    public function getUser($user_mail) {
        $user = User::where('mail','=',$user_mail)->first();
        return $user;

    }


    public function listUserComments() {
        $urlPostSearchComments = Slim::getInstance()->urlFor("Projet4_SEARCH_COMMENTS");
        $res = "<h3> Lister les commentaires de l'utilisateur</h3>";

        $formulaire = "<form action='$urlPostSearchComments' method='post'>";
        $formulaire .= "<input title=\"Mail de l'utilisateur\" id=\"mail_utilisateur\" name=\"mail_utilisateur\" type=\"text\" />";
        $formulaire .= "<input type='submit' value='Valider'> </form> ";


        $res .= $formulaire;
        $mail_utilisateur = Slim::getInstance()->request->post('mail_utilisateur');
        if (isset($mail_utilisateur)) {


            $mail = filter_var($mail_utilisateur, FILTER_SANITIZE_EMAIL);
            // TODO : NE PAS OUBLIER LE FILTER VAR

            $utilisateur = $this->getUser($mail);
            if($utilisateur != null) {
                // Lister les commentaires
                $res .= "<h5> Commentaires de l'utilisateur : </h5>";
               // $res .= " $utilisateur->mail <br> $utilisateur->address <br> $utilisateur";
                $comments = $utilisateur->comments()->orderBy('created_at', 'DESC')->get();

                $res .= "<table style=\"width:100%\">
                         <tr>
                         <th>Utilisateur :</th>
                         <th>Date du commentaire :</th>
                         <th>Commentaire :</th>
                         </tr>";

                foreach($comments as $comment) {
                    $res .= "  <tr>
                               <td>$comment->user_mail</td>
                               <td>$comment->created_at</td>
                               <td>$comment->content</td>
                               </tr>";
                }

                $res .= "</table>";
            } else {
                $res .= "<h5> Le mail de l'utilisateur n'existe pas ";
            }
        }
        $res .= " </body></html> ";
        (new VuePrincipal($res))->render();
    }

}