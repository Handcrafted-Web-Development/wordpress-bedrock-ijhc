<?php
defined('ABSPATH') or exit;

use Timber\Timber;

$context = Timber::context();
$context['posts'] = Timber::get_posts(new WP_Query());

$templates = ['pages/index.twig'];
if (is_home()) {
	array_unshift($templates, 'front-page.twig', 'home.twig');
}

$context['intro'] = get_field('blog-intro', 'options');
$context['title'] = get_field('blog-title', 'options');
$context['categories'] = get_categories();
Timber::render($templates, $context);
