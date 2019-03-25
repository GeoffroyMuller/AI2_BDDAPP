<?php
namespace gamepedia\models;
final class User extends \Illuminate\Database\Eloquent\Model
{
    //Nom de la table.
    protected $table = 'user';
    //Cle primaire de la table.
    protected $primaryKey = 'mail' ;
    public $timestamps = false;

    public function comments() {
        return $this->hasMany('gamepedia\models\Comment','user_mail');
    }
}