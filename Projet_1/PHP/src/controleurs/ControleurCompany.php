<?php

namespace gamepedia\controleurs;

use gamepedia\models\Company;

class ControleurCompagny{

    public function compagniesJap(){
      echo "<h3>Question n°2 : liste des compagnies installees au japon</h3>";
      $companies = Company::where('location_country','=', 'Japan')->get();
      foreach($companies as $company) {
          echo "Nom de la compagnie : $company->name <br>";
      }
    }

}
