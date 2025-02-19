<?php
defined('ABSPATH') or exit;

$metaboxes_includes = array(
//	'config/meta-boxes/example/field.php',
);

foreach ($metaboxes_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}
	require_once $filepath;
}
