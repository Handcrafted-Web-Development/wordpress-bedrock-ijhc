<?php

use ldwp_theme\config\timber\Theme;
use Timber\Timber;


/**
 * Configuration de Timber
 * **************************************************
 */
Timber::$dirname = ['views'];
Timber::$autoescape = false;


/**
 * Appel des classes
 * **************************************************
 */
$timber_files = [
	'config/timber/Theme.php',
];

foreach ($timber_files as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}


/**
 * Déclarations
 * **************************************************
 */
new Theme();
