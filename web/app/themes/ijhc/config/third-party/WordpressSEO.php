<?php

namespace ldwp_theme\config\third_party;

class WordpressSEO {
	public function __construct() {
		if (defined('WPSEO_VERSION')) {
			add_action('wp_dashboard_setup', [$this, 'ldwp_wpseo_remove_dashboard_widget']);
			add_filter('wpseo_metabox_prio', [$this, 'ldwp_wpseo_alter_metabox_position']);
		}
	}


	/**
	 * Suppression du widget "Wordpress SEO" du dashboard.
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_wpseo_remove_dashboard_widget() {
		remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');
	}


	/**
	 * Déplacement de la metabox "Wordpress SEO" sur la page d'édition d'un type de contenu.
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_wpseo_alter_metabox_position() {
		return 'low';
	}
}
