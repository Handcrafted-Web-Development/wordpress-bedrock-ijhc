<?php
defined('ABSPATH') or exit;

use Timber\Timber;

$context = Timber::context();
$templates = array('pages/page.twig');
Timber::render($templates, $context);
