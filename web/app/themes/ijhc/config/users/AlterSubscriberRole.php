<?php

namespace Users_AlterSubscriberRole;
class AlterSubscriberRole {

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'remove_admin_bar' ] );
	}

	function remove_admin_bar() {
		if ( is_user_logged_in() ) {

			$user             = wp_get_current_user();
			$currentUserRoles = $user->roles;
			if ( in_array( 'subscriber', $currentUserRoles ) ) {
				add_filter( 'show_admin_bar', '__return_false' );
				show_admin_bar( false );

				if(is_admin()) {
					wp_redirect( '/' );
					exit;
				}
			}
		}
	}

}
