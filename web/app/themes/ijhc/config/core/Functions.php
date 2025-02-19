<?php

namespace ldwp_theme\config\core;

class Functions {
	public function __construct() {
	}

	public function get_permalink_by_template($template_name) {
		$pages = get_posts([
			'post_type'   => 'page',
			'post_status' => 'publish',
			'meta_query'  => [
				[
					'key'     => '_wp_page_template',
					'value'   => $template_name . '.php',
					'compare' => '=',
				],
			],
		]);
		if (!empty($pages)) {
			foreach ($pages as $pages__value) {
				return get_permalink($pages__value->ID);
			}
		}

		return false;
	}

	public function get_id_by_template($template_name) {
		$pages = get_posts([
			'post_type'   => 'page',
			'post_status' => 'publish',
			'meta_query'  => [
				[
					'key'     => '_wp_page_template',
					'value'   => $template_name . '.php',
					'compare' => '=',
				],
			],
		]);

		if (!empty($pages)) {
			foreach ($pages as $pages__value) {
				return $pages__value->ID;
			}
		}

		return false;
	}
}
