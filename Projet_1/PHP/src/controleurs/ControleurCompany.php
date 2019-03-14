<?php

namespace gamepedia\controleurs;

use gamepedia\models\Company;
use \gamepedia\vues\VuePrincipal as VuePrincipal;

class ControleurCompany
{
    public function compagniesJap()
    {
        $res = "<h3>Question n°2 : liste des compagnies installees au japon</h3>";
        $companies = Company::where('location_country', '=', 'Japan')->get();
        foreach($companies as $company) {
            $res .= "Nom de la compagnie : $company->name <br>";
        }
        (new VuePrincipal($res))->render();
    }

    public function jeuxDeveloppesParSony() {
        $res =  "<h3>Question n°3 : jeux développés par Sony</h3>";
        $sonyCompanies= Company::where('name','like','%sony%')->get();
        foreach($sonyCompanies as $sonyCompany){
            $sonyGames = $sonyCompany->jeuxPublies;
            foreach($sonyGames as $sonyGame) {
                $res .= "Jeu Sony : $sonyGame->name <br>";
            }
        }
        (new VuePrincipal($res))->render();
    }

    public function jeuxCompagniesInc3Plus() {
        $res = "<h3>Question n°7 : jeux 3+ developpes par inc contenant Mario</h3>";
        $incCompanies= Company::where('name','like','%Inc.%')->get();
        foreach($incCompanies as $incCompany){
            $incMarioGames = $incCompany->jeuxPublies()->where('name','like','%mario%')->get();
            foreach($incMarioGames as $incMarioGame) {

                $respectRating = $incMarioGame->ratings()->where('name','like','%3+%')->count();
                if($respectRating >= 1) {
                    $res .= "Jeu 3+ contenant Mario et publie par Inc.: $incMarioGame->name <br>";
                }
            }
        }
        (new VuePrincipal($res))->render();
    }
}
