<?php

spl_autoload_register('maFonctionQuiChargeLesClasses');

function maFonctionQuiChargeLesClasses($class) {
    echo 'Mon code est passé par la fonction maFonctionQuiChargeLesClasses()<br>';
    echo 'PHP souhaite utiliser la classe '.$class.'<br>';
    require __DIR__.'/../app/'.$class.'.php';
}

$app = new Application();