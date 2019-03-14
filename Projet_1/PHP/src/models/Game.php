<?php
namespace gamepedia\models;
final class Game extends \Illuminate\Database\Eloquent\Model{
    //Nom de la table.
    protected $table = 'game';
    //Cle primaire de la table.
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function company(){
      return $this->belongsTo('gamepedia\models\Company', 'company_id');
    }

    public function platforms(){
      return $this->belongsToMany('gamepedia\models\Platform', 'game2platform', 'game_id', 'platform_id');
    }

    public function personnagesOntFaitPremiereApparition(){
        return $this->hasMany("gamepedia\models\Character", "first_appeared_in_game_id");
    }

    public function personnages(){
        return $this->belongsToMany("gamepedia\models\Character", "game2character", "game_id", "character_id");
    }

    public function genres(){
        return $this->belongsToMany("gamepedia\models\Genre", "game2genre", "game_id", "genre_id");
    }


    public function themes(){
        return $this->belongsToMany("gamepedia\models\Theme", "game2theme", "game_id", "theme_id");
    }

    public function developers(){
        return $this->belongsToMany("gamepedia\models\Company", "game_developers", "game_id", "comp_id");
    }

    public function publishers(){
        return $this->belongsToMany('gamepedia\models\Company', "game_publishers", "game_id", "com_id");
    }

    public function similarGames(){
        return $this->belongsToMany("gamepedia\models\Game", "similar_games", "game1_id", "game2_id");
    }

    public function ratings(){
        return $this->belongsToMany("gamepedia\models\GameRating", "game2rating", "game_id", "rating_id");
    }
}
