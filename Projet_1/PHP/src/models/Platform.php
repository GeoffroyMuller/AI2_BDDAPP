<?php
namespace gamepedia\models;
final class Platform extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'platform';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function games(){
      return $this->belongsToMany('gamepedia\models\Game', 'game2platform', 'platform_id', 'game_id');
    }

    public function company(){
        return $this->belongsTo("gamepedia\models\Company", "c_id");
    }


}
