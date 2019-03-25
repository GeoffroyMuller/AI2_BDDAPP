<?php
namespace gamepedia\controleurs;


use DateTime;
use gamepedia\models\Comment;
use gamepedia\models\User;
use gamepedia\vues\VuePrincipal;

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
            (new VuePrincipal("Insertion effectuée avec succès"))->render();
        } catch (\Exception $e) {
            (new VuePrincipal("Erreur lors de l'insertion : $e"))->render();
        }


    }

}