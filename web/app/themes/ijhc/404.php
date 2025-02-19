<?php
defined( 'ABSPATH' ) or exit;

use Timber\Timber;

$context = Timber::context();
$context['error_404_title'] = get_option('ld_core_404_title');
$context['error_404_content'] = get_option('ld_core_404_text');
$context['error_404_image'] = get_option('ld_core_404_image');

$templates = array( 'pages/404.twig' );
Timber::render( $templates, $context );
