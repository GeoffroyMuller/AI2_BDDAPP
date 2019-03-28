<?php

namespace gamepedia\controleurs;

use gamepedia\models\Platform;
use gamepedia\vues\VuePrincipal as VuePrincipal;

class ControleurPlatform
{

    public function grossesPlatforms()
    {
        $res = "<h3>Question n°3 : liste des plateformes ayant plus de 10M d'installations</h3>
                <br><br><table style='width:100%'><tr>
                <th>ID de la plateforme :</th>
                <th>Nom de la plateforme :</th>
                <th>Alias de la plateforme :</th>
                <th>Abréviation de la plateforme :</th>
                <th>Base d'installation :</th>
                <th>Date de sortie :</th>
                <th>Support :</th>
                <th>Prix original :</th>
                </tr>";
        $platforms = Platform::where('install_base', '>=', '10000000')->get();
        foreach($platforms as $platform) {
            $res .= "<tr>
                    <td>$platform->id</td>
                    <td>$platform->name</td>
                    <td>$platform->alias</td>
                    <td>$platform->abbreviation</td>
                    <td>$platform->install_base</td>
                    <td>$platform->release_date</td>
                    <td>$platform->online_support</td>
                    <td>$platform->original_price</td>                       
                    </tr>";
        }
        $res .= "</table>";
        (new VuePrincipal($res))->render();
    }

}
