<?php

namespace ijhc\functions\admin;


class Comments
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'disable_comments_post_types_support']);
        add_filter('comments_open', 'disable_comments_status', 20, 2);
        add_filter('pings_open', 'disable_comments_status', 20, 2);
        add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);
        add_action('admin_menu', [$this, 'disable_comments_admin_menu']);
        add_action('admin_init', [$this, 'disable_comments_admin_menu_redirect']);
        add_action('admin_init', [$this, 'disable_comments_dashboard']);
        add_action('wp_before_admin_bar_render', [$this, 'disable_comments_admin_bar']);
    }


    /**
     * @file comments.php
     *
     * Désactive la fonctionnalité des commentaires sur l'environnement
     * Wordpress du thème site-partenaires
     *
     * @package site-partenaire
     * @author Baptiste Montécot | @baptistemontecot
     * @link https://agenceseize.fr
     * @version 1.0
     */

    /**
     * Désactive le support des commentaires et trackbacks pour tous les types de publications.
     *
     * Parcourt tous les types de publications enregistrés et retire le support pour les commentaires
     * et les trackbacks si ceux-ci sont activés.
     */
    public function disable_comments_post_types_support(): void
    {
        $post_types = get_post_types();
        foreach ($post_types as $post_type) {
            if (post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }
    }


    /**
     * Ferme les commentaires sur le front-end.
     *
     * Cette fonction filtre l'état des commentaires et pings pour les désactiver sur le front-end,
     * les rendant ainsi inaccessibles pour les utilisateurs.
     *
     * @return bool Faux pour indiquer que les commentaires et pings sont fermés.
     */
    function disable_comments_status(): bool
    {
        return false;
    }

    /**
     * Cache les commentaires existants.
     *
     * Intercepte la liste des commentaires avant qu'elle soit rendue et la remplace par une liste vide,
     * ce qui a pour effet de cacher tous les commentaires existants sur le front-end.
     *
     * @param array $comments Les commentaires originaux.
     * @return array Une liste vide de commentaires.
     */
    function disable_comments_hide_existing_comments(array $comments): array
    {
        return array();
    }


    /**
     * Retire la page des commentaires du menu d'administration.
     *
     * Utilise la fonction remove_menu_page pour enlever l'entrée du menu d'administration
     * qui mène à la page de gestion des commentaires.
     */
    public function disable_comments_admin_menu(): void
    {
        remove_menu_page('edit-comments.php');
    }


    /**
     * Redirige les utilisateurs essayant d'accéder à la page des commentaires.
     *
     * Si un utilisateur tente d'accéder directement à la page de gestion des commentaires via son URL,
     * cette fonction le redirigera vers la page d'accueil de l'administration.
     */
    public function disable_comments_admin_menu_redirect(): void
    {
        global $pagenow;
        if ($pagenow === 'edit-comments.php') {
            wp_redirect(admin_url());
            exit;
        }
    }


    /**
     * Retire le widget des commentaires récents du tableau de bord.
     *
     * Enlève la metabox qui affiche les commentaires récents dans le tableau de bord
     * de WordPress pour les utilisateurs administrateurs.
     */
    function disable_comments_dashboard(): void
    {
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    }


    /**
     * Enlève les liens des commentaires de la barre d'administration.
     *
     * Supprime l'entrée de menu de la barre d'administration de WordPress qui permet
     * d'accéder à la gestion des commentaires.
     */
    function disable_comments_admin_bar(): void
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }
}