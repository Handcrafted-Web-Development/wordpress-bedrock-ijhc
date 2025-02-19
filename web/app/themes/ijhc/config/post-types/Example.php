<?php

namespace ldwp_theme\config\post_types;

class Example {

	public function __construct() {
		add_action('init', [$this, 'ldwp_register_post_type_example'], 10);
		add_action('init', [$this, 'ldwp_custom_rewrite',], 10);
		add_filter('post_updated_messages', [$this, 'ldwp_example_updated_messages']);
		add_filter('init', [$this, 'ldwp_add_template_to_example']);
		add_action('wpseo_breadcrumb_links', [$this, 'ldwp_examples_alter_breadcrumb']);
	}

	/**
	 * Déclaration du type de contenu "Exemple"
	 *
	 * @since 1.0
	 */
	public function ldwp_register_post_type_example() {

		register_post_type('example', [
			'label'               => __("Exemple", 'Template-WP'),
			'description'         => __("Exemples", 'Template-WP'),
			'labels'              => [
				'name'                  => _x("Nos exemples", "Nom au pluriel du type de contenu", 'Template-WP'),
				'singular_name'         => _x("Exemple", "Nom au singulier du type de contenu", 'Template-WP'),
				'menu_name'             => __("Exemples", 'Template-WP'),
				'name_admin_bar'        => __("Exemples", 'Template-WP'),
				'parent_item_colon'     => __("Parent:", 'Template-WP'),
				'all_items'             => __("Toutes les exemples", 'Template-WP'),
				'add_new_item'          => __("Ajouter une exemple", 'Template-WP'),
				'add_new'               => __("Ajouter", 'Template-WP'),
				'new_item'              => __("Nouvelle exemple", 'Template-WP'),
				'edit_item'             => __("Modifier la exemple", 'Template-WP'),
				'update_item'           => __("Mettre à jour la exemple", 'Template-WP'),
				'view_item'             => __("Voir la page de la exemple", 'Template-WP'),
				'view_items'            => __("Voir les exemples", 'Template-WP'),
				'search_items'          => __("Rechercher une exemple", 'Template-WP'),
				'not_found'             => __("Aucune exemple trouvée.", 'Template-WP'),
				'not_found_in_trash'    => __("Aucun résultat trouvé dans la corbeille", 'Template-WP'),
				'featured_image'        => __("Image", 'Template-WP'),
				'set_featured_image'    => __("Ajouter une image", 'Template-WP'),
				'remove_featured_image' => __("Supprimer l'image", 'Template-WP'),
				'use_featured_image'    => __("Utiliser l'image pour la exemple", 'Template-WP'),
				'attributes'            => __("Attributs de la exemple", 'Template-WP'),
			],
			'supports'            => ['title', 'thumbnail', 'editor'],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'menu_position'       => 21,
			'menu_icon'           => 'dashicons-slides',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'rewrite'             => [
				'slug'       => 'example',
				'with_front' => true,
			],
			'capability_type'     => 'post',
		]);
	}

	function ldwp_custom_rewrite() {
		add_rewrite_tag('%filtrees-par%', '([^&]+)');
		add_rewrite_tag('%type%', '([^&]+)');

		add_rewrite_rule(
			'nos-filieres/filtrees-par/([^/]+)/page/([0-9]{1,})/?',
			'index.php?pagename=nos-filieres&type=$matches[1]&paged=$matches[2]',
			'top'
		);

		add_rewrite_rule(
			'nos-filieres/filtrees-par/([^/]+)/?',
			'index.php?pagename=nos-filieres&type=$matches[1]',
			'bottom'
		);

		add_rewrite_rule(
			'nos-filieres/page/([0-9]{1,})/?',
			'index.php?pagename=nos-filieres&paged=$matches[1]',
			'top'
		);
	}

	/**
	 * Mis à jour des messages pour les produits
	 */
	public function ldwp_example_updated_messages($messages) {
		$post             = get_post();
		$post_type        = get_post_type($post);
		$post_type_object = get_post_type_object($post_type);

		$messages['example'] = [
			0  => '', // Unused. Messages start at index 1.
			1  => __('Exemple mise à jour.', 'Template-WP'),
			2  => __('Champ personnalisé mis à jour.', 'Template-WP'),
			3  => __('Champ personnalisé mis à jour.', 'Template-WP'),
			4  => __('Produit mise à jour.', 'Template-WP'),
			/* translators: %s: date and time of the revision */
			5  => isset($_GET['revision']) ? sprintf(__('Restauration à partir de la révision de  %s', 'Template-WP'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
			6  => __('Exemple publiée.', 'Template-WP'),
			7  => __('Exemple sauvegardée.', 'Template-WP'),
			8  => __('Exemple envoyée.', 'Template-WP'),
			9  => '',
			10 => __('Brouillon de cette exemple mis à jour.', 'Template-WP'),
		];

		return $messages;
	}

	/**
	 * Ajout d'un template de base aux produits
	 */
	public function ldwp_add_template_to_example() {
		$post_type_object           = get_post_type_object('example');
		$post_type_object->template = [
			['crb/examples', []],
		];
	}

	/**
	 * Optimisation du fil d'ariane.
	 *
	 * @since 1.0
	 */
	function ldwp_examples_alter_breadcrumb($links) {
		global $post;
		if (is_singular('example')) {
			unset($links[1]);

			$breadcrumb[0] = [
				'url'  => get_permalink($post->ID),
				'text' => $post->post_title,
			];

			$breadcrumb[1] = [
				'url'  => '',
				'text' => __('Nos exemples', 'Template-WP'),
			];

			ksort($breadcrumb);
			$breadcrumb = array_reverse($breadcrumb);


			array_pop($links);
			$links = array_merge($links, $breadcrumb);
		}

		return $links;
	}
}
