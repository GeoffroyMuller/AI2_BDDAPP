<?php
namespace gamepedia\models;
final class Company extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'company';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

}
