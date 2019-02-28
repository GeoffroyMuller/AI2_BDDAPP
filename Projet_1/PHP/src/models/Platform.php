<?php
namespace aibdd\models;
final class Platform extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'platform';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

}