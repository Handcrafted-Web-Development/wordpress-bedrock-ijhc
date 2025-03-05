<?php

namespace ijhc\functions\admin;

class AdminBar
{
    public function __construct()
    {
        add_action('wp_footer', [$this, 'customize_adminbar']);
        add_theme_support('custom-logo');
    }

    /**
     * Génère le code HTML pour une icône SVG à partir d'un sprite SVG.
     *
     * Cette fonction crée une balise SVG pour utiliser une icône spécifique du sprite SVG des icônes d'administration.
     * Elle permet d'ajouter facultativement un titre et des classes CSS personnalisées à l'icône SVG.
     *
     * @param string $icon Le nom de l'icône dans le sprite SVG à utiliser.
     * @return string Le code HTML de l'élément SVG de l'icône.
     */
//    function get_admin_icon(string $icon): string
//    {
//        $svg = "<svg class='icon'>";
//        $svg .= "<use xlink:href='" . get_template_directory_uri() . "/img/admin-icons.svg#" . $icon . "'></use>";
//        $svg .= "</svg>";
//        return $svg;
//    }

    function get_admin_icon(string $icon): string
    {
        $svg = "<svg class='icon'>";
        $svg .= "<use xlink:href='/__spritemap#" . $icon . "'></use>";
        $svg .= "</svg>";
        return $svg;
    }


    function customize_adminbar(): void
    {
        $user = wp_get_current_user();
        $roles = $user->roles;

        if (is_user_logged_in() && in_array("administrator", $roles)) : ?>
					<div id="adminbar">
						<a id="admin_wp" href="<?= get_admin_url(); ?>" target="_blank" title="<?= 'Accéder à l\'admin' ?>">
<!--                --><?php //= $this->get_admin_icon('sprite-wordpress'); ?>
							<svg class='icon'>
								<use xlink:href="/__spritemap#sprite-wordpress"></use>
							</svg>
							<?= 'Accéder à l\'admin' ?>
						</a>
              <?php if (current_user_can("edit_posts")) : ?>
								<a id="admin_edit" href="<?= get_edit_post_link(); ?>" target="_blank" title="<?= 'Éditer la page' ?>">
                    <?= $this->get_admin_icon('edit'); ?>
                    <?= 'Éditer la page' ?>
								</a>
              <?php endif; ?>
						<a id="admin_regimg" href="?regimg=1" title="<?= 'Régénérer la page' ?>">
                <?= $this->get_admin_icon('regenerate'); ?>
                <?= 'Régénérer la page' ?>
						</a>
					</div>
        <?php
        endif;
    }
}