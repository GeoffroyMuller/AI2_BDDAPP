<?php

namespace gamepedia\controleurs;

use gamepedia\models\Company;

class ControleurCompany
{

    public function compagniesJap()
    {
        $companies = Company::where('location_country', '=', 'Japan')->get();
        $vue = new \gamepedia\vues\VuePrincipal($companies, "P1Q2");
        $vue->render();
    }

}
