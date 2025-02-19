<?php

namespace ldwp_theme\config\core;

class Init {
	public function __construct() {
		add_action('after_setup_theme', [$this, '_ld_setup'], 10);
		add_action('wildets_init', [$this, '_ld_wildets_areas']);
	}


	/**
	 * Config du thème
	 */
	public function _ld_setup() {
		// Rend le thème éligible à la traduction
		load_theme_textdomain('ldwp', get_template_directory() . '/languages');

		// Tailles d'images
		// http://codex.wordpress.org/Function_Reference/add_image_size
		add_image_size('xs-48-52', 48, 82, TRUE);
		add_image_size('xs-80-80', 80, 80, TRUE);
		add_image_size('sm-290-auto', 290, 0, FALSE);
		add_image_size('sm-300-260', 300, 260, TRUE);
		add_image_size('sm-305-500', 305, 500, TRUE);
		add_image_size('sm-385-385', 385, 385, TRUE);
		add_image_size('sm-385-auto', 385, 0, FALSE);
		add_image_size('md-480-auto', 480, 0, FALSE);
		add_image_size('md-550-530', 550, 530, TRUE);
		add_image_size('md-630-auto', 630, 0, FALSE);
		add_image_size('md-630-670', 630, 670, TRUE);
		add_image_size('lg-960-640', 960, 640, FALSE); // not used
		add_image_size('xl-1280-515', 1280, 515, TRUE);
		add_image_size('xl-1440-640', 1440, 640, TRUE);

		// Active le plugin pour gérer le titre de la page
		// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
		add_theme_support('title-tag');

		// Enregistrement d'un menu pour wp_nav_menu()
		// http://codex.wordpress.org/Function_Reference/register_nav_menus
		register_nav_menus([
			'menu' => __('Menu', 'ldwp'),
		]);

		// Ajout du support des images à la une
		// http://codex.wordpress.org/Post_Thumbnails
		// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		add_theme_support('post-thumbnails');

		// Active les fonctionnalités pour gérer le titre de la page
		// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
		add_theme_support('title-tag');

		// Ajout du support des images à la une
		// http://codex.wordpress.org/Post_Thumbnails
		// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		add_theme_support('post-thumbnails', array('post'));

		// Ajout des types de posts possible
		// http://codex.wordpress.org/Post_Formats
		//add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

		// Ajout du support des markups HTML5
		// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
		add_theme_support('html5', array('style', 'script'));

		// ---------------------
		// Gutenberg
		// ---------------------

		// Ajouter une feuille de style pour l’éditeur dans l’admin
		add_theme_support('editor-styles');

		// Alignement large et pleine page
		add_theme_support('align-wide');

		// Désactivation de la personnalisation de la taille de texte
		add_theme_support('disable-custom-font-sizes');

		// Désactivation du bouton couleur personnalisée et des dégradés
		add_theme_support('disable-custom-colors');
		add_theme_support('disable-custom-gradients');
		add_theme_support('editor-gradient-presets', array());
		add_theme_support('disable-custom-gradients', true);

		// Autoriser les embeds Responsives
		add_theme_support('responsive-embeds');

		// Suppression de la fonctionnalité d'utilisation de patterns prédéfinis
//		remove_theme_support('core-block-patterns');
	}
}
