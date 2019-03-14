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
}
