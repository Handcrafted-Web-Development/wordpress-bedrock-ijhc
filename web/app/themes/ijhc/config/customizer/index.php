<?php
defined('ABSPATH') or exit;

/**
 * Ajout dans le Customizer d'un panneau global permettant de regrouper toutes les fonctionnalités et réglages liés au site.
 *
 * @since 1.0.0
 */
function _ld_core_customize_global_panel($wp_customize) {

	$wp_customize->add_panel('ld_core_global_panel', array(
		'title' => __("Réglages du thème", 'Template-WP'),
		'description' => __("Retrouvez ici certaines fonctionnalités et réglages liés au site", 'Template-WP'),
		'priority' => 1000,
	));
}
add_action('customize_register', '_ld_core_customize_global_panel');

$customizer_includes = array(
	'config/customizer/404.php',
);

foreach ($customizer_includes as $file) {
	if (!$filepath = locate_template($file)) {
		trigger_error(sprintf(__('Error locating %s for inclusion'), $file), E_USER_ERROR);
	}
	require_once $filepath;
}

// Déclarations
new Page_404\Page_404();
