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

}
