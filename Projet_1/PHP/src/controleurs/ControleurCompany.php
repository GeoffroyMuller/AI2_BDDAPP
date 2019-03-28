<?php

namespace gamepedia\controleurs;

use gamepedia\models\Company;
use gamepedia\models\Game;
use \gamepedia\vues\VuePrincipal as VuePrincipal;
use Illuminate\Database\Capsule\Manager as Manager;

class ControleurCompany
{
    public function compagniesJap()
    {
        $res = "<h3>Question n°2 : liste des compagnies installees au japon</h3>
                 <br><br><table style='width:100%'>
                 <tr>
                 <th>ID de la compagnie :</th>
                 <th>Nom de la compagnie :</th>
                 <th>Deck de la compagnie :</th>
                 <th>Date de création de la compagnie :</th>
                 <th>Ville :</th>
                 <th>Adresse :</th>
                 <th>Téléphone : </th>
                 </tr>";
        $companies = Company::where('location_country', '=', 'Japan')->get();
        foreach($companies as $company) {
            $res .= "<tr>
                        <td>$company->id</td>
                        <td>$company->name</td>
                        <td>$company->deck</td>
                        <td>$company->date_founded</td>
                        <td>$company->location_city</td>
                        <td>$company->location_address</td>
                        <td>$company->phone</td>
                      </tr>";
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();
    }

    public function jeuxDeveloppesParSony() {
        $res =  "<h3>Question n°3 : jeux développés par Sony</h3>
                <br><br>
                <table style='width:100%'>
                <tr>
                    <th>ID jeu:</th>
                    <th>Titre du jeu:</th>
                    <th>Alias du jeu:</th>
                    <th>Description :</th>
                    <th>Date de création :</th>
                </tr>";
        $sonyCompanies= Company::where('name','like','%sony%')->get();
        foreach($sonyCompanies as $sonyCompany){
            $sonyGames = $sonyCompany->jeuxPublies;
            foreach($sonyGames as $game) {
                $res .= "<tr>
                     <td>$game->name</td>
                     <td>$game->title</td>
                     <td>$game->alias</td>
                     <td>$game->description</td>
                     <td>$game->created_at</td>
                    </tr>";
            }
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();

    }

    public function jeuxDeveloppesParSonyOpti() {
        $res =  "<h3>Chargement lié : jeux développés par Sony</h3>
                <br><br>
                <table style='width:100%'>
                <tr>
                    <th>ID jeu:</th>
                    <th>Titre du jeu:</th>
                    <th>Alias du jeu:</th>
                    <th>Description :</th>
                    <th>Date de création :</th>
                </tr>";
        $sonyCompanies= Company::where('name','like','%sony%')->with('jeuxPublies')->get();
        foreach ($sonyCompanies as $sony) {
          foreach ($sony->jeuxPublies as $game) {
            $res .= "<tr>
                     <td>$game->name</td>
                     <td>$game->title</td>
                     <td>$game->alias</td>
                     <td>$game->description</td>
                     <td>$game->created_at</td>
                    </tr>";
          }
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();

    }


    public function jeuxCompagniesInc3Plus() {
        $res = "<h3>Question n°7 : jeux 3+ developpes par inc contenant Mario</h3>
                <br><br>
                <table style=\"width:100 % \">
                <tr>
                    <th>ID jeu:</th>
                    <th>Titre du jeu:</th>
                    <th>Alias du jeu:</th>
                    <th>Description :</th>
                    <th>Date de création :</th>
                </tr>";
        $incCompanies= Company::where('name','like','%Inc.%')->get();
        foreach($incCompanies as $incCompany){
            $incMarioGames = $incCompany->jeuxPublies()->where('name','like','%mario%')->get();
            foreach($incMarioGames as $game) {

                $respectRating = $game->ratings()->where('name','like','%3+%')->count();
                if($respectRating >= 1) {
                    $res .= "<tr>
                     <td>$game->name</td>
                     <td>$game->title</td>
                     <td>$game->alias</td>
                     <td>$game->description</td>
                     <td>$game->created_at</td>
                    </tr>";
                }
            }
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();
    }
}
