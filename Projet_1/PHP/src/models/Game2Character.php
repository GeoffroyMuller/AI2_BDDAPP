<?php
/**
 * Created by PhpStorm.
 * User: adrien
 * Date: 2019-03-13
 * Time: 18:16
 */

namespace gamepedia\models;
final class Game2Character extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'game2character';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;


}