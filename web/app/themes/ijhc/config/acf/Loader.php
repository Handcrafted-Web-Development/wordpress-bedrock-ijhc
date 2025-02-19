<?php

namespace Acf;

use Timber\Timber;

class Loader
{
    public function __construct()
    {
        add_action('acf/init', [$this, 'register_acf_blocks']);
    }

    /**
     * Enregistre les blocs ACF dynamiquement à partir du JSON
     */
    public function register_acf_blocks(): void
    {
        if (!function_exists('acf_register_block_type')) {
            error_log('ACF Pro n\'est pas activé.');
            return;
        }

        $blocks_json_path = get_template_directory() . '/config/acf/blocks.json';

        if (!file_exists($blocks_json_path)) {
            error_log('Fichier blocks.json introuvable');
            return;
        }

        $blocksList = json_decode(file_get_contents($blocks_json_path), true);

        foreach ($blocksList as $block) {
            acf_register_block_type([
                'name' => $block['name'],
                'title' => __($block['title'], 'ijhc'),
                'description' => __($block['description'], 'ijhc'),
                'category' => 'ijhc',
                'icon' => $block['icon'],
                'keywords' => $block['keywords'],
                'render_callback' => [$this, 'render_acf_example_block'],
                'supports' => [
                    'align' => false,
                    'mode' => true,
                    'multiple' => true,
                    'customClassName' => true
                ],
                'example' => [
                    'attributes' => [
                        'mode' => 'preview',
                        'data' => [
                            'image' => '<img src="' . get_template_directory_uri() . '/config/acf/blocks/' . $block['name'] . '/' . $block['name'] . '.png' . '" style="display: block; margin: 0 auto; width: 100%;">',
                        ],
                    ],
                ],
            ]);
        }
    }

    /**
     * Rendu du bloc
     */
    function render_acf_example_block($block): void
    {
        $context = Timber::context();
        $context['fields'] = get_fields();
        $context['block'] = $block;

        $slug = str_replace('acf/', '', $block['name']);

        $template_path = get_theme_file_path("views/components/blocks/{$slug}.twig");

        if (file_exists($template_path)) {
            Timber::render($template_path, $context);
        }
    }
}