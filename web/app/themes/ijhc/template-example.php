<?php

use Timber\Timber;

/**
 * Template Name: Example
 */
defined('ABSPATH') or exit;

$context = Timber::context();
$post = Timber::get_post();

$templates = array('pages/template-example.twig');
Timber::render($templates, $context);
