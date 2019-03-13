<?php
namespace gamepedia\models;
final class RatingBoard extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'rating_board';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function ratings(){
        return $this->hasMany("gamepedia\models\GameRating", "rating_board_id");
    }
}
