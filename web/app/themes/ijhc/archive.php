<?php
defined('ABSPATH') or exit;

use Timber\Timber;

$templates = ['pages/archive.twig', 'pages/index.twig'];
$context = Timber::context();

$context['title'] = 'Archive';

if (is_post_type_archive()) {
	$context['title'] = post_type_archive_title('', FALSE);
	array_unshift($templates, 'pages/archive-' . get_post_type() . '.twig');
}

$context['posts'] = Timber::get_posts(new WP_Query());

Timber::render($templates, $context);
