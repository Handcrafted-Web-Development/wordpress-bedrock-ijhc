<?php

use ldwp_theme\config\third_party\WordpressSEO;

defined('ABSPATH') or exit;

/**
 * Appel des classes
 * **************************************************
 */
$third_party_files = [
	'config/third-party/WordpressSEO.php',
];

foreach ($third_party_files as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}


/**
 * Déclarations
 * **************************************************
 */
new WordpressSEO();
