<?php
/**
 *  Editor // cf. fonctions.php
 *  Author : Baptiste Montécot | @baptistemontecot
 *  URL :
 */

if (!function_exists('is_plugin_active')) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
}

// Si ACF actif
if (is_plugin_active('advanced-custom-fields-pro/acf.php')) :
    if (function_exists('acf_add_options_page')) :
        acf_add_options_page();

        $sub_pages = array(
            array(
                'page_title' => 'Options Générales',
                'menu_slug' => 'ijhc_options',
                'capability' => 'edit_posts',
                'redirect' => false
            )
        );

        foreach ($sub_pages as $sub_page) :
            acf_add_options_sub_page($sub_page);
        endforeach;
    endif;

    /**
     * Configure l'API Google Map pour les champs ACF.
     *
     * Cette fonction modifie la configuration de l'API Google Map utilisée par les champs Google Map d'Advanced Custom Fields (ACF).
     * Elle y ajoute la clé d'API Google.
     *
     * @param array $api Le tableau de configuration de l'API actuel.
     * @return array Le tableau de configuration de l'API modifié avec la clé d'API Google.
     */
    function my_acf_google_map_api(array $api): array
    {
        $api['key'] = GOOGLE_API_KEY;
        return $api;
    }

    add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

    add_action("plugins_loaded", function () {
        function get_field()
        {
            return null;
        }

        function the_field()
        {
            return null;
        }

        function get_sub_field()
        {
            return null;
        }

        function the_sub_field()
        {
            return null;
        }

        function have_rows()
        {
            return null;
        }

        function the_row()
        {
            return null;
        }
    });
endif;