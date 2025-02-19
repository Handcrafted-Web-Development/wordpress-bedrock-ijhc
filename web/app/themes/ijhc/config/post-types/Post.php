<?php

namespace ldwp_theme\config\post_types;

class Post {
	public function __construct() {
		add_action( 'init', [ $this, 'ldwp_post_type_post_remove_supports' ] );
		add_action( 'init', [ $this, 'ldwp_post_type_post_remove_taxonomies' ], 10 );
//		add_filter( 'init', [ $this, 'ldwp_post_type_post_add_default_blocks' ], 10 );
		add_filter( 'init', [ $this, 'ldwp_post_type_post_custom_rewrite' ], 10 );
	}

	/**
	 * Supression des taxonomies inutiles
	 */
	public function ldwp_post_type_post_remove_taxonomies() {
		unregister_taxonomy_for_object_type( 'post_tag', 'post' );
		unregister_taxonomy( 'post_tag' );
	}

	/**
	 * Suppression de fonctionnalités pour le type de contenu "Post"
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_post_type_post_remove_supports() {
		remove_post_type_support( 'post', 'thumbnail' );
		remove_post_type_support( 'post', 'custom-fields' );
		remove_post_type_support( 'post', 'excerpt' );
	}

	/**
	 * Réécritude des URL avec les filtres
	 */
	public function ldwp_post_type_post_custom_rewrite() {
		add_rewrite_tag( '%filtrees-par%','([^&]+)' );
		add_rewrite_tag( '%category%', '([^&]+)' );

		add_rewrite_rule(
			'actualites/filtrees-par/([^/]+)/page/([0-9]{1,})/?',
			'index.php?pagename=actualites&category=$matches[1]&paged=$matches[2]',
			'top'
		);

		add_rewrite_rule(
			'actualites/filtrees-par/([^/]+)/?',
			'index.php?pagename=actualites&category=$matches[1]',
			'bottom'
		);

		add_rewrite_rule(
			'actualites/page/([0-9]{1,})/?',
			'index.php?pagename=actualites&paged=$matches[1]',
			'top'
		);
	}

	/**
	 * Ajout d'un template de base aux actualités
	 */
//	public function ldwp_post_type_post_add_default_blocks() {
//		$post_type_object           = get_post_type_object( 'post' );
//		$post_type_object->template = [
//			[ 'crb/default-hero', [] ],
//		];
//	}
}
