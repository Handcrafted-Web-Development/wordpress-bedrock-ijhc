<?php

namespace Acf;

class Settings
{

    public function __construct()
    {
        add_filter('allowed_block_types_all', [$this, 'allowed_blocks'], 10, 2);
        add_filter('block_categories_all', [$this, 'block_categories'], 10, 2);
    }

    /**
     * Liste des blocs ACF autorisés
     */
    public function allowed_blocks($allowed_block_types, $editor_context)
    {
        $blocks_json_path = get_template_directory() . '/config/acf/blocks.json';

        if (!file_exists($blocks_json_path)) {
            return $allowed_block_types;
        }

        $blocksList = json_decode(file_get_contents($blocks_json_path), true);
        $acf_blocks = [];

        foreach ($blocksList as $block) {
            $acf_blocks[] = 'acf/' . $block['name'];
        }

        return array_merge((array) $acf_blocks, (array) $allowed_block_types);
    }

    /**
     * Ajout d'une catégorie de blocs personnalisée
     */
    public function block_categories($categories, $post)
    {
        return array_merge(
            $categories,
            [
                [
                    'slug' => 'ijhc',
                    'title' => __('Blocs spécifiques IJHC', 'ijhc'),
                ],
                [
                    'slug' => 'ijhc-other',
                    'title' => __('Autres blocs du thème', 'ijhc'),
                ]
            ]
        );
    }
}