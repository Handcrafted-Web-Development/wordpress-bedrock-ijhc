<?php
defined('ABSPATH') or exit;

$context = Timber::context(); // @codingStandardsIgnoreFile
if (!isset($context)) {
	throw new \Exception('Timber context not set in footer.');
}
$context['content'] = ob_get_contents();
ob_end_clean();



$templates = ['layouts/footer.twig'];
Timber::render($templates, $context);
