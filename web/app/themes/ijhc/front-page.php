<?php
defined('ABSPATH') or exit;

use Timber\Timber;

$context = Timber::context(); // @codingStandardsIgnoreFile
$context['post'] = Timber::get_post();
$templates = ['pages/home.twig'];
Timber::render($templates, $context);
