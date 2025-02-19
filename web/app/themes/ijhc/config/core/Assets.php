<?php

namespace ldwp_theme\config\core;

class Assets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'ldwp_styles'], 100);
        add_action('wp_enqueue_scripts', [$this, 'ldwp_scripts'], 100);
        add_action('admin_init', [$this, 'ldwp_scripts'], 100);
        add_action('wp_enqueue_scripts', [$this, 'ld_remove_wp_block_library_css'], 100);
    }

    public function ld_remove_wp_block_library_css()
    {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style');
        wp_dequeue_style('classic-theme-styles');
    }

    /**
     * Récupération du manifest.
     * **************************************************
     * since 1.0
     */
    public function ldwp_manifest()
    {
        $manifest = get_template_directory() . '/assets/dist/.vite/manifest.json';

        if (file_exists($manifest)) {
            return json_decode(file_get_contents($manifest), TRUE);
        }

        return NULL;
    }

    /**
     * Chargement des styles.
     * **************************************************
     * since 1.0
     */
    public function ldwp_styles()
    {
        // Vérifie si le manifest est présent
        $manifest = $this->ldwp_manifest();

        if (is_null($manifest)) {
            return NULL;
        }

        // Styles principaux
        $main_styles = $manifest['src/main.ts']['css'];

        if (empty($main_styles)) {
            return NULL;
        }

        foreach ($main_styles as $key => $style) {
            wp_enqueue_style('main-style-' . $key, get_template_directory_uri() . '/assets/dist/' . $style, [], FALSE);
        }
    }

    /**
     * Chargement des scripts.
     * **************************************************
     * since 1.0
     */
    public function ldwp_scripts()
    {
        // Désactive le jQuery natif de WordPress
        //		if(!is_user_logged_in()) {
        //			wp_deregister_script( 'jquery' );
        //			wp_deregister_script( 'jquery-migrate' );
        //		}

        // Vérifie si le manifest est présent
        $manifest = $this->ldwp_manifest();

        // Insert le script si le manifeste n'est pas présent et qu'on est bien en mode développement.
        if (is_null($manifest)) {
            if (WP_ENV === 'development') {
                if (!is_admin()) {
                    wp_enqueue_script('main-script', 'http://localhost:5173/src/main.ts', [], NULL, FALSE);
                }
                wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client', [], NULL, FALSE);
                add_filter("script_loader_tag", [$this, 'add_module_type'], 10, 3);
            }

            return NULL;
        }

        if (!is_admin()) {
            // Script principal
            $main_script = $this->ldwp_manifest()['src/main.ts']['file'];

            if (empty($main_script)) {
                return null;
            }

            wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/dist/' . $main_script, [], false, true);
        }
    }

    /**
     * Ajout du type "module" au script principal.
     * **************************************************
     * since 1.0
     */
    public function add_module_type($tag, $handle, $src)
    {
        if ("main-script" === $handle || "vite-client" === $handle) {
            $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }

        return $tag;
    }
}
