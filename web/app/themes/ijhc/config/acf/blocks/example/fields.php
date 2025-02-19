<?php

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_example',
        'title' => 'Exemple de Bloc',
        'fields' => [
            [
                'key' => 'field_text',
                'label' => 'Texte',
                'name' => 'texte',
                'type' => 'text',
            ]
        ],
        'location' => [
            [
                [
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/example',
                ]
            ]
        ]
    ]);
}