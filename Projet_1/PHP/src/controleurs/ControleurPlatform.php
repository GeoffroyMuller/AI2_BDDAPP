<?php

namespace gamepedia\controleurs;

use gamepedia\models\Platform;

class ControleurPlatform
{

    public function grossesPlatforms()
    {
        $platforms = Platform::where('install_base', '>=', '10000000')->get();
        $vue = new \gamepedia\vues\VuePrincipal($platforms, "P1Q3");
        $vue->render();
    }

}
