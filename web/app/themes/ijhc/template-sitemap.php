<?php
/**
 * Template Name: Plan du site
 */

defined('ABSPATH') or exit;

$context = Timber::context();
$post = Timber::get_post();
$context['post'] = $post;

$content = ['page', 'recipe'];
foreach ($content as $key => $post_type) {
	$pt = get_post_type_object($post_type);
	$name = $pt->labels->name;
	$context['list_pub'][$name]['name'] = $pt->labels->name;
	$context['list_pub'][$name] = query_posts('post_type=' . $post_type . '&posts_per_page=-1&post_status=publish');
}


Timber::render(['pages/template-sitemap.twig'], $context);
