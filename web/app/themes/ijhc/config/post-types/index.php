<?php

use ldwp_theme\config\post_types\Page;
use ldwp_theme\config\post_types\Post;
use ldwp_theme\config\post_types\Example;

defined('ABSPATH') or exit;

/**
 * Appel des classes
 * **************************************************
 */
$third_party_files = [
	'config/post-types/Page.php',
	'config/post-types/Post.php',
	'config/post-types/Example.php',
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
new Page();
new Post();
new Example();
