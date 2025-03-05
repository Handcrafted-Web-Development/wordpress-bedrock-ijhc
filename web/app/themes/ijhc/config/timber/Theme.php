<?php

namespace ldwp_theme\config\timber;

use Timber\Timber;
use Timber\Site;

class Theme extends Site
{

    public function __construct()
    {
        parent::__construct();

        add_filter('timber/twig/functions', [$this, 'add_functions']);
        add_filter('timber/twig/filters', [$this, 'add_filters']);
        add_filter('timber/context', [$this, 'add_to_context']);
    }

    /** This is where you add some context
     *
     * @param string $context context['this'] Being the Twig's {{ this }}.
     */
    public function add_to_context($context)
    {

        $context['menu'] = Timber::get_menu('menu');
        $context['post'] = Timber::get_post();
        $context['site'] = $this;
        $context['is_front_page'] = is_front_page();
        $context['options'] = get_options([
                'siteurl',
                'blogname',
            ]
        );

        return $context;
    }

    /** This is where you can add your own functions to twig.
     *
     * @param array $functions get extension.
     */
    public function add_functions(array $functions): array
    {
        $functions['get_permalink_by_template'] = ['callable' => function ($template_name) {
            $pages = get_posts([
                'post_type' => 'page',
                'post_status' => 'publish',
                'meta_query' => [
                    [
                        'key' => '_wp_page_template',
                        'value' => $template_name . '.php',
                        'compare' => '=',
                    ],
                ],
            ]);
            if (!empty($pages)) {
                foreach ($pages as $pages__value) {
                    return get_permalink($pages__value->ID);
                }
            }

            return FALSE;
        }];

        $functions['get_icon_svg'] = ['callable' => function ($icon) {
            $path_svg = get_template_directory_uri() . '/assets/dist/img/icons/' . $icon . '.svg';
            $svg = file_get_contents($path_svg);

            return $svg;
        }];

        $functions['get_latest_news'] = ['callable' => function () {
            return get_posts([
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
            ]);
        }];

        return $functions;
    }

    /** This is where you can add your own filters to twig.
     *
     * @param array filters get extension.
     */
    public function add_filters($filters)
    {
        return $filters;
    }
}
