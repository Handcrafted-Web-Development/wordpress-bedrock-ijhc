<?php
$context = Timber::context();
$context['title'] = 'Search results for ' . get_search_query();
$context['posts'] = new Timber\PostQuery();

$template = ['pages/search.twig'];
Timber::render($templates, $context);
