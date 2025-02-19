<?php
defined('ABSPATH') or exit;

$taxonomies_includes = array(
//	'config/taxonomies/Example.php',
);

foreach ($taxonomies_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}
	require_once $filepath;
}

//new taxonomies\Example\Example();
