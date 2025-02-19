<?php

namespace Page_404;

use WP_Customize_Media_Control;

class Page_404 {

	public function __construct() {
		add_action('customize_register', [$this, '_ld_core_customize_section_404']);
	}

	/**
	 * Ajout de la section pour la page 404 dans le Customizer
	 *
	 * @since 1.0.0
	 */
	public function _ld_core_customize_section_404($wp_customize) {

		// Création de la section de champs
		$wp_customize->add_section('ld_core_section_404', array(
			'title' => __("Page 404", 'Template-WP'),
			'capability' => 'edit_pages',
			'panel' => 'ld_core_global_panel'
		));

		// Surcharge du titre
		$wp_customize->add_setting('ld_core_404_title', array(
			'type' => 'option',
			'capability' => 'edit_pages',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('ld_core_404_title', array(
			'type' => 'text',
			'section' => 'ld_core_section_404',
			'label' => __("Titre", 'Template-WP'),
			'description' => __("Permet de supplanter le nom du type de contenu dans la section du titre de la page", 'Template-WP')
		));

		// Image de fond
		$wp_customize->add_setting('ld_core_404_image', array(
			'type' => 'option',
			'capability' => 'edit_pages',
			'transport' => 'refresh',
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'ld_core_404_image', array(
			'section' => 'ld_core_section_404',
			'label' => __("Image de fond", 'Template-WP'),
			'mime_type' => 'image'
		)));

		// Cotenu
		$wp_customize->add_setting('ld_core_404_text', array(
			'type' => 'option',
			'capability' => 'edit_pages',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_textarea_field'
		));
		$wp_customize->add_control('ld_core_404_text', array(
			'type' => 'textarea',
			'section' => 'ld_core_section_404',
			'label' => __("Contenu", 'Template-WP'),
		));
	}
}
