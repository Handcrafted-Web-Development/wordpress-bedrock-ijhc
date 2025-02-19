<?php

use ldwp_theme\config\core\Assets;
use ldwp_theme\config\core\Editor;
use ldwp_theme\config\core\Init;
use ldwp_theme\config\core\Menu;
use ldwp_theme\config\core\Widget;
use ldwp_theme\config\core\Media;
use ldwp_theme\config\core\Login;
use ldwp_theme\config\core\Mailer;

defined('ABSPATH') or exit;

/**
 * Appel des classes
 * **************************************************
 */
$config_files = [
	'config/core/Init.php',
	'config/core/Assets.php',
	'config/core/Editor.php',
	'config/core/Menu.php',
	'config/core/Widget.php',
	'config/core/Media.php',
	'config/core/Functions.php',
	'config/core/Login.php',
	'config/core/Mailer.php',
];

foreach ($config_files as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}


/**
 * Déclarations
 * **************************************************
 */
new Init();
new Assets();
new Editor();
new Menu();
new Widget();
new Media();
new Login();
new Mailer();