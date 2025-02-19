<?php
defined('ABSPATH') or exit;

use Timber\Timber;

$context = Timber::context();
$templates = array('pages/single.twig');
Timber::render($templates, $context);
