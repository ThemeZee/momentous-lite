<?php
/**
 * Register Header Content section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'momentous_customize_register_general_settings' );

function momentous_customize_register_general_settings( $wp_customize ) {

	// Add Section for General Settings
	$wp_customize->add_section( 'momentous_section_general', array(
		'title'    => esc_html__( 'General Settings', 'momentous-lite' ),
		'priority' => 10,
		'panel'    => 'momentous_options_panel',
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'momentous_theme_options[layout]', array(
		'default'           => 'right-sidebar',
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_select',
	) );
	$wp_customize->add_control( 'momentous_theme_options[layout]', array(
		'label'    => esc_html__( 'Theme Layout', 'momentous-lite' ),
		'section'  => 'momentous_section_general',
		'settings' => 'momentous_theme_options[layout]',
		'type'     => 'radio',
		'priority' => 1,
		'choices'  => array(
			'left-sidebar' => esc_html__( 'Left Sidebar', 'momentous-lite' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'momentous-lite' ),
		),
	)	);

	// Add Title for latest posts setting
	$wp_customize->add_setting( 'momentous_theme_options[latest_posts_title]', array(
		'default'           => esc_html__( 'Latest Posts', 'momentous-lite' ),
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_html',
	)	);
	$wp_customize->add_control( 'momentous_theme_options[latest_posts_title]', array(
		'label'    => esc_html__( 'Title above Latest Posts', 'momentous-lite' ),
		'section'  => 'momentous_section_general',
		'settings' => 'momentous_theme_options[latest_posts_title]',
		'type'     => 'text',
		'priority' => 2,
	) );

	// Add Footer Settings
	$wp_customize->add_setting( 'momentous_theme_options[footer_text]', array(
		'default'           => '',
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'momentous_sanitize_footer_text',
	)	);
	$wp_customize->add_control( 'momentous_theme_options[footer_text]', array(
		'label'    => esc_html__( 'Footer Text', 'momentous-lite' ),
		'section'  => 'momentous_section_general',
		'settings' => 'momentous_theme_options[footer_text]',
		'type'     => 'textarea',
		'priority' => 3,
	)	);
}
