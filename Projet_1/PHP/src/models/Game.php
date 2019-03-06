<?php
namespace aibdd\models;
final class Game extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'game';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;
}