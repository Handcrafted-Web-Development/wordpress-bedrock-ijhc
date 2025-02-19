<?php
defined('ABSPATH') or exit;


$templates = ['pages/category.twig'];
$context = Timber::context();
$context['title'] = get_the_title( get_option('page_for_posts', true) );
$context['intro'] = get_field('blog-intro', 'options');
$context['categories'] = get_categories();
$context['current'] = $category = get_category( get_query_var( 'cat' ) );

$context['posts'] = new Timber\PostQuery();

Timber::render($templates, $context);
