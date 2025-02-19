<?php
namespace Users_AlterEditorRole;

class AlterEditorRole {

	public function __construct() {
		if (is_admin()) {
			add_action('admin_init', [$this, '_ld_give_appareance_caps_to_editor'], 20);
			add_action('admin_menu', [$this, '_ld_hide_menus_for_editor']);
		}
	}

	/**
	 * Donne l'autorisation aux éditeurs d'accéder au menu "Apparence"
	 *
	 * @since 1.0
	 */
	function _ld_give_appareance_caps_to_editor() {
		if( current_user_can('editor' ) ) {
			$editor_role = get_role( 'editor' );

			if( ! $editor_role->has_cap( 'edit_theme_options' ) ) {
				$editor_role->add_cap( 'edit_theme_options' );
			}
		}
	}

	/**
	 * Masquage de certains des menus pour un rôle éditeur (cf. droits supplémentaires donnés ci-dessus)
	 *
	 * @since 1.0
	 */
	function _ld_hide_menus_for_editor() {
		if( current_user_can('editor' ) ) {

			// Sous-Menu "Thèmes"
			remove_submenu_page( 'themes.php', 'themes.php' );

			// Sous-Menu "Personnaliser" (WP Customizer)
			$customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
			remove_submenu_page( 'themes.php', $customize_url );

		}
	}

}
