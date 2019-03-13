<?php
namespace gamepedia\models;
final class Genre extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'genre';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function games(){
      return $this->belongsToMany("gamepedia\models\Game", "game2genre", "genre_id", "game_id");
    }


}
