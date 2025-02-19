<?php

namespace ldwp_theme\config\post_types;

use ldwp_theme\config\core\Functions;

class Page {
	public function __construct() {
		add_action('init', [$this, 'ldwp_post_type_page_remove_supports']);
//		add_action('init', [$this, 'ldwp_add_template_to_pages']);
		add_action('pre_get_posts', [$this, 'ldwp_page_pre_get_posts']);
	}


	/**
	 * Suppression de fonctionnalités pour le type de contenu "Page"
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_post_type_page_remove_supports() {
		remove_post_type_support('page', 'thumbnail');
		remove_post_type_support('page', 'custom-fields');
	}

	/**
	 * Ajout d'un template de base aux pages
	 */
//	public function ldwp_add_template_to_pages() {
//		global $post;

//		$page_type_object = get_post_type_object('page');
//		$page_type_object->template = [
//			['crb/default-hero', []],
//		];

		// if (!empty($_GET['post']) && get_option('page_on_front') == $_GET['post']) {
		// 	$page_type_object->template = [
		// 		['crb/slider', []],
		// 	];
		// }
//	}

	public function ldwp_page_pre_get_posts($q) {
		global $pagenow, $wp_query;
		if (is_admin() && 'edit.php' == $pagenow) {
			$wp_query->set('order', 'DESC');
		}
	}
}
