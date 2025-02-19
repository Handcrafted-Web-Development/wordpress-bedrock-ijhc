<?php

namespace ldwp_theme\config\core;

class Mailer {
	public function __construct() {
		add_action('wp_mail_failed', [$this, 'ldwp_action_wp_mail_failed']);
		add_action('phpmailer_init', [$this, 'ldwp_phpmailer_init']);
	}

	/**
	 * define the wp_mail_failed callback
	 * **************************************************
	 * @since 1.0
	 */
	function ldwp_action_wp_mail_failed($wp_error) {
		print_r($wp_error, true);
		exit;
	}


	/**
	 * configure PHPMailer to send through SMTP
	 * **************************************************
	 * @since 1.0
	 */
	public function ldwp_phpmailer_init($phpmailer) {
		if (getenv('WP_ENV') === 'development') {
			$phpmailer->isSMTP();
			// host details
			$phpmailer->SMTPAuth    = false;
			$phpmailer->SMTPSecure  = '';
			$phpmailer->SMTPAutoTLS = false;
			$phpmailer->Host        = 'mailhog';
			$phpmailer->Port        = '1025';
			// from details
			$phpmailer->From     = get_bloginfo( 'admin_email' );
			$phpmailer->FromName = get_bloginfo( 'name' );
			// login details
			$phpmailer->Username = null;
			$phpmailer->Password = null;
		}
	}
}
