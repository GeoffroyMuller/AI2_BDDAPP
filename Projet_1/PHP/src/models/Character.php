<?php
namespace gamepedia\models;
final class Character extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'character';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function apparitions(){
      return $this->belongsToMany('gamepedia\models\Game', 'game2character', 'character_id', 'game_id');
    }

    public function enemies(){
      return $this->belongsToMany('gamepedia\models\Character', 'enemies', 'char1_id', 'char2_id');
    }

    public function friends(){
      return $this->belongsToMany('gamepedia\models\Character', 'friends', 'char1_id', 'char2_id');
    }


}
