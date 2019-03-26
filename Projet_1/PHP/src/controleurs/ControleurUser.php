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
    /*    $formulaireQuestion5 = "<form action='$urlPostSearchComments' method='post'><select name='numeroPage'>";
        for ($i = 1; $i < $nbPages; $i++) {
            $formulaireQuestion5 .= " <option value='$i'>$i</option> ";
        }
        $formulaireQuestion5 .= " </select> <input type='submit' value='Valider'> </form> ";
        $res .= $formulaireQuestion5." </body></html> ";
        (new VuePrincipal($res))->render();

        $mail_utilisateur = Slim::getInstance()->request->post('numeroPage');*/
        if (isset($mail_utilisateur)) {
            $utilisateur = $this->getUser($mail_utilisateur);
            if($utilisateur != null) {
                // Lister les commentaires
            }
        }
    }

}
