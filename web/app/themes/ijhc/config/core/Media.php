<?php

namespace ldwp_theme\config\core;

class Media {
	public function __construct() {
		add_filter( 'upload_mimes', [ $this, 'ldwp_mime_types' ], 10 );
	}


	/* Autoriser les fichiers SVG */
	function ldwp_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;
	}
}
