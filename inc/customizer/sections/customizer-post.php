<?php
/**
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'momentous_customize_register_post_settings' );

function momentous_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'momentous_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'momentous-lite' ),
		'priority' => 30,
		'panel'    => 'momentous_options_panel',
	) );

	// Add Settings and Controls for Post Layout
	$wp_customize->add_setting( 'momentous_theme_options[post_layout]', array(
		'default'           => 'index',
		'type'           	  => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_select',
	) );
	$wp_customize->add_control( 'momentous_theme_options[post_layout]', array(
		'label'    => esc_html__( 'Post Layout', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[post_layout]',
		'type'     => 'radio',
		'priority' => 1,
		'choices'  => array(
			'one-column' => esc_html__( 'One Column', 'momentous-lite' ),
			'index' => esc_html__( 'Two Columns', 'momentous-lite' ),
		),
	) );

	// Add Settings and Controls for post content.
	$wp_customize->add_setting( 'momentous_theme_options[post_content]', array(
		'default'           => 'excerpt',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_select',
	) );
	$wp_customize->add_control( 'momentous_theme_options[post_content]', array(
		'label'    => esc_html__( 'Post Length', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[post_content]',
		'type'     => 'radio',
		'priority' => 2,
		'choices'  => array(
			'full'    => esc_html__( 'Show full posts', 'momentous-lite' ),
			'excerpt' => esc_html__( 'Show post excerpts', 'momentous-lite' ),
		),
	) );

	// Add Post Images Headline
	$wp_customize->add_setting( 'momentous_theme_options[post_images]', array(
		'default'           => '',
		'type'           	  => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new Momentous_Customize_Header_Control(
		$wp_customize, 'momentous_theme_options[post_images]', array(
			'label'    => esc_html__( 'Post Images', 'momentous-lite' ),
			'section'  => 'momentous_section_post',
			'settings' => 'momentous_theme_options[post_images]',
			'priority' => 3,
			)
	) );
	$wp_customize->add_setting( 'momentous_theme_options[post_thumbnails_index]', array(
		'default'           => true,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[post_thumbnails_index]', array(
		'label'    => esc_html__( 'Display featured images on archive pages', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[post_thumbnails_index]',
		'type'     => 'checkbox',
		'priority' => 4,
	) );

	$wp_customize->add_setting( 'momentous_theme_options[post_thumbnails_single]', array(
		'default'           => true,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[post_thumbnails_single]', array(
		'label'    => esc_html__( 'Display featured images on single posts', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[post_thumbnails_single]',
		'type'     => 'checkbox',
		'priority' => 5,
	) );

	// Add Excerpt Text setting
	$wp_customize->add_setting( 'momentous_theme_options[excerpt_text_headline]', array(
		'default'           => '',
		'type'              => 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new Momentous_Customize_Header_Control(
		$wp_customize, 'momentous_theme_options[excerpt_text_headline]', array(
			'label'    => esc_html__( 'Text after Excerpts', 'momentous-lite' ),
			'section'  => 'momentous_section_post',
			'settings' => 'momentous_theme_options[excerpt_text_headline]',
			'priority' => 6,
			)
	) );
	$wp_customize->add_setting( 'momentous_theme_options[excerpt_text]', array(
		'default'           => true,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[excerpt_text]', array(
		'label'    => esc_html__( 'Display [...] after excerpts', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[excerpt_text]',
		'type'     => 'checkbox',
		'priority' => 7,
	) );

	// Add Post Meta Settings
	$wp_customize->add_setting( 'momentous_theme_options[postmeta_headline]', array(
		'default'           => '',
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new Momentous_Customize_Header_Control(
		$wp_customize, 'momentous_theme_options[postmeta_headline]', array(
			'label'    => esc_html__( 'Post Meta', 'momentous-lite' ),
			'section'  => 'momentous_section_post',
			'settings' => 'momentous_theme_options[postmeta_headline]',
			'priority' => 8,
			)
	) );
	$wp_customize->add_setting( 'momentous_theme_options[meta_date]', array(
		'default'           => true,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display post date', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 9,
	) );
	$wp_customize->add_setting( 'momentous_theme_options[meta_author]', array(
		'default'           => true,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display post author', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 10,
	) );
	$wp_customize->add_setting( 'momentous_theme_options[meta_category]', array(
		'default'           => true,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[meta_category]', array(
		'label'    => esc_html__( 'Display post categories', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[meta_category]',
		'type'     => 'checkbox',
		'priority' => 11,
	) );
	$wp_customize->add_setting( 'momentous_theme_options[meta_tags]', array(
		'default'           => true,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display post tags', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 12,
	) );

	// Add Post Footer Settings
	$wp_customize->add_setting( 'momentous_theme_options[post_footer_headline]', array(
		'default'           => '',
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new Momentous_Customize_Header_Control(
		$wp_customize, 'momentous_theme_options[post_footer_headline]', array(
			'label'    => esc_html__( 'Post Footer', 'momentous-lite' ),
			'section'  => 'momentous_section_post',
			'settings' => 'momentous_theme_options[post_footer_headline]',
			'priority' => 13,
			)
	) );
	$wp_customize->add_setting( 'momentous_theme_options[post_navigation]', array(
		'default'           => false,
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'momentous_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display post navigation on single posts', 'momentous-lite' ),
		'section'  => 'momentous_section_post',
		'settings' => 'momentous_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 14,
	) );

}
