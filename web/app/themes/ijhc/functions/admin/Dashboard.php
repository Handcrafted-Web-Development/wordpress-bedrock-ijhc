<?php

namespace ijhc\functions\admin;

use WP_Screen;

class Dashboard
{
    public function __construct()
    {
        add_filter('contextual_help', [$this, 'remove_help'], 999, 3);
        add_filter('admin_footer_text', [$this, 'remove_footer_admin']);
        add_filter('pre_get_shortlink', '__return_empty_string');
        add_filter('screen_options_show_screen', '__return_false');
        add_action('wp_dashboard_setup', [$this, 'add_dashboard_widgets']);
        add_action('wp_dashboard_setup', [$this, 'remove_dashboard_widgets']);

    }

    /**
     * Supprime l'onglet d'aide du tableau de bord de l'administration.
     *
     * @param string $old_help Le contenu d'aide précédent.
     * @param WP_Screen $screen L'objet de l'écran actuel.
     * @return string Le contenu d'aide précédent.
     */
    function remove_help(string $old_help, $screen): string
    {
        if ($screen instanceof WP_Screen) {
            $screen->remove_help_tabs();
        }
        return $old_help;
    }

    /**
     * Personnalise le texte du pied de page du tableau de bord de l'administration.
     *
     * @return string Le nouveau texte du pied de page.
     */
    function remove_footer_admin(): string
    {
        return "Site réalisé sur <a href='https://fr.wordpress.org/' target='_blank'>Wordpress</a> par <a href='https://agenceseize.fr' target='_blank'>Agence Seize</a>";
    }

    /**
     * Améliore l'ergonomie du tableau de bord en personnalisant les widgets affichés.
     *
     * Cette fonction ajoute un widget personnalisé qui fournit des informations utiles et
     * des contacts pour l'assistance au quotidien.
     */
    public function add_dashboard_widgets(): void
    {
        // Ajoute un widget personnalisé pour l'assistance
        add_meta_box(
            'assistance_dashboard',
            'Votre assistance au quotidien',
            [$this, 'ijhc_assistance_metabox'],
            'dashboard',
            'normal',
            'high'
        );
    }

    public function ijhc_assistance_metabox(): void
    {
//        $seize_logo = "/img/logo-seize.svg";
        ?>
        <!--        <a href='https://ijhc.local' class="nbLogo" target='_blank'>-->
        <!--            <img src="--><?php //= get_template_directory_uri() . $seize_logo
        ?><!--" width="200" height="75" alt="Logo"/>-->
        <!--        </a>-->
        <br/>
        Ce thème a été réalisé par <a href="https://ijhc.local" target="_blank">Baptiste Montécot</a>.
        <br/>
        Vous pouvez me contacter
        <br/>par email, à l'adresse <a href="mailto:baptiste.montecot1@icloud.com">baptiste.montecot1@icloud.com</a>
        <br/>ou par téléphone, au <a href="tel:+33611267870">06 11 26 78 70</a>
        <?php
    }

    /**
     * Améliore l'ergonomie du tableau de bord en personnalisant les widgets affichés.
     *
     * Cette fonction supprime certains widgets par défaut du tableau de bord WordPress
     * pour alléger l'interface utilisateur
     */
    public function remove_dashboard_widgets(): void
    {
        // Supprime les widgets par défaut du WordPress pour simplifier le tableau de bord
        remove_meta_box('dashboard_primary', 'dashboard', 'side');
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');

    }
}
