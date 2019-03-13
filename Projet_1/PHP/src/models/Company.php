<?php
namespace gamepedia\models;
final class Company extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'company';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function games(){
        return $this->belongsToMany("gamepedia\models\Game", "game_developers", "com_id", "game_id");
    }

    public function jeuxPublies(){
        return $this->belongsToMany("gamepedia\models\Game", "game_publishers", "com_id", "game_id");
    }

}
