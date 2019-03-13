<?php
/**
 * Created by PhpStorm.
 * User: adrien
 * Date: 2019-03-13
 * Time: 18:16
 */

namespace gamepedia\models;
final class Game2Rating extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'game2rating';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;


}