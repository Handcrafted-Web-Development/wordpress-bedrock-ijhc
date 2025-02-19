<?php
// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

// Initialize Timber.
Timber\Timber::init();

// Constantes
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
define('LDWP_FILE', __FILE__);
define('LDWP_PATH', realpath(plugin_dir_path(LDWP_FILE)) . DS);
define('LDWP_CONFIG_PATH', realpath(LDWP_PATH . 'config') . DS);
define('LDWP_FIELDS_PATH', realpath(LDWP_CONFIG_PATH . 'fields') . DS);
define('LDWP_BLOCKS_PATH', realpath(LDWP_CONFIG_PATH . 'blocks') . DS);
define('LDWP_ICON_FG_COLOR', "#27306B");
define('LDWP_ICON_BG_COLOR', "#FFF");

/**
 * Includes
 * Le tableau $theme_includes détermine l'ordre de chargement des
 * fonctionnalités du thème.
 *
 * @note Les fichiers manquants déclenchent une erreur fatale.
 */
$theme_includes = [
    'functions/admin/index.php',
	'config/core/index.php',
	'config/third-party/index.php',
	'config/post-types/index.php',
	'config/timber/index.php',
	'config/customizer/index.php',
	'config/taxonomies/index.php',
	'config/users/index.php',
	'config/meta-boxes/index.php',
	'config/plugins/acf.php',
	'config/acf/acf-blocks.php',
];

foreach ($theme_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}
	require_once $filepath;
}
unset($file, $filepath, $theme_includes);