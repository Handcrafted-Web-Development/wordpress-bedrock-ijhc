<?php
/**
 *  Acf Blocks // cf. fonctions.php
 *  Author : Baptiste Montécot | @baptistemontecot
 *  URL :
 */

$includes = [
    'config/acf/Loader.php',
    'config/acf/Settings.php',
];

foreach ($includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'ijhc'), $file), E_USER_ERROR);
    }
    require_once $filepath;
}

new Acf\Loader();
new Acf\Settings();