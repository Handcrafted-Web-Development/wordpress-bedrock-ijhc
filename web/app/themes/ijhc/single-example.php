<?php
defined( 'ABSPATH' ) or exit;

use Timber\Timber;

$post    = Timber::get_post();
$context = Timber::context();

$templates = [ 'pages/single-example.twig' ];
Timber::render( $templates, $context );
