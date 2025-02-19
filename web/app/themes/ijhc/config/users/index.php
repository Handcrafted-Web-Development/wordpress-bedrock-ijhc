<?php
defined('ABSPATH') or exit;

$users_includes = array(
	'config/users/AlterEditorRole.php',
	'config/users/AlterSubscriberRole.php',
);

foreach( $users_includes as $file ) {
	if( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion' ), $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

// Déclarations
new Users_AlterEditorRole\AlterEditorRole();
new Users_AlterSubscriberRole\AlterSubscriberRole();
