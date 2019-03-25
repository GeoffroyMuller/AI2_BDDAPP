<?php
namespace gamepedia\models;
final class Comment extends \Illuminate\Database\Eloquent\Model
{
    //Nom de la table.
    protected $table = 'comment';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false;
    public function author() {
        return $this->belongsTo('gamepedia\models\User', 'user_mail');
    }

    public function game() {
        return $this->belongsTo('gamepedia\models\Game', 'game_id');
    }
}