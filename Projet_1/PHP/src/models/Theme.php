<?php
namespace gamepedia\models;
final class Theme extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'theme';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function games(){
        return $this->belongsToMany("gamepedia\models\Game", "game2theme", "theme_id", "game_id");
    }


}
