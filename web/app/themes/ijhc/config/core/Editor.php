<?php

namespace ldwp_theme\config\core;

class Editor {
	public function __construct() {
		add_filter('tiny_mce_before_init', [$this, 'ldwp_alter_tinymce_editor'], 10);
		add_filter('wp_default_editor', [$this, 'ldwp_replace_default_editor'], 10);
		add_action('admin_head', [$this, 'ldwp_alter_wysiwyg_tabs']);
	}


	/**
	 * Altération des options de l'éditeur TinyMCE.
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_alter_tinymce_editor($init) {
		// Niveaux de titre
		$init['block_formats'] = 'Heading 2=h2;Heading 3=h3;Heading 4=h4;';

		// Options de l'éditeur
		$init["toolbar1"] = 'formatselect,bold,italic,underline,bullist,numlist,link,unlink,undo,redo,table';
		$init["toolbar2"] = '';

		return $init;
	}


	/**
	 * Définit TinyMCE comme éditeur par défaut.
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_replace_default_editor() {
		return 'tinymce';
	}


	/**
	 * Suppression des onglets "Texte" et "Visuel" sur les wysiwyg.
	 * Ces options sont visibles uniquement par les administrateurs.
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_alter_wysiwyg_tabs() {
		if (!current_user_can('activate_plugins')) : ?>
			<style type="text/css">
				.wp-editor-tabs {
					display: none !important;
				}
			</style>
<?php endif;
	}
}
