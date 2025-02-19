<?php

namespace ldwp_theme\config\core;

class Menu {
	public function __construct() {
		add_action('admin_enqueue_scripts', [$this, 'ldwp_limit_nav_menu_depth']);
	}


	/**
	 * Limite la profondeur du menu dans le BO
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_limit_nav_menu_depth($hook) {
		if ($hook != 'nav-menus.php') return;

		wp_add_inline_script('nav-menu', 'wpNavMenu.options.globalMaxDepth = 1;', 'after');
	}
}
