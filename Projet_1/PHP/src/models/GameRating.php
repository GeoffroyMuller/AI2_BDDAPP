<?php
namespace gamepedia\models;
final class GameRating extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'game_rating';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function ratingBoard(){
        $this->belongsTo("gamepedia\models\RatingBoard", "rating_board_id");
    }

    public function games(){
        return $this->belongsToMany("gamepedia\models\Game", "game2rating", "rating_id", "game_id");
    }

}
