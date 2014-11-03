<?php
/**
 * Register Theme Colors section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'momentous_customize_register_color_settings' );

function momentous_customize_register_color_settings( $wp_customize ) {

	// Add Sections for Theme Colors
	$wp_customize->add_section( 'momentous_section_colors', array(
        'title'    => __( 'Theme Colors', 'momentous-lite' ),
        'priority' => 60,
		'panel' => 'momentous_options_panel' 
		)
	);
	
	// Add settings and controls for theme colors
	$wp_customize->add_setting( 'momentous_theme_options[header_color]', array(
        'default'           => '#282828',
		'type'           	=> 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'momentous_control_header_color', array(
			'label'      => __( 'Header Color', 'momentous-lite'),
			'section'    => 'momentous_section_colors',
			'settings'   => 'momentous_theme_options[header_color]',
			'priority' => 1
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[navi_color]', array(
        'default'           => '#22a8d8',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'momentous_control_navi_color', array(
			'label'      => __( 'Navigation Color', 'momentous-lite'),
			'section'    => 'momentous_section_colors',
			'settings'   => 'momentous_theme_options[navi_color]',
			'priority' => 2
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[title_color]', array(
        'default'           => '#282828',
		'type'           	=> 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'momentous_control_title_color', array(
			'label'      => __( 'Post Title Color', 'momentous-lite'),
			'section'    => 'momentous_section_colors',
			'settings'   => 'momentous_theme_options[title_color]',
			'priority' => 2
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[link_color]', array(
        'default'           => '#22a8d8',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'momentous_control_link_color', array(
			'label'      => __( 'Link Color', 'momentous-lite'),
			'section'    => 'momentous_section_colors',
			'settings'   => 'momentous_theme_options[link_color]',
			'priority' => 3
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[widget_title_color]', array(
        'default'           => '#282828',
		'type'           	=> 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'momentous_control_widget_title_color', array(
			'label'      => __( 'Widget Title Color', 'momentous-lite'),
			'section'    => 'momentous_section_colors',
			'settings'   => 'momentous_theme_options[widget_title_color]',
			'priority' => 4
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[widget_link_color]', array(
        'default'           => '#22a8d8',
		'type'           	=> 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'momentous_control_widget_link_color', array(
			'label'      => __( 'Widget Link Color', 'momentous-lite'),
			'section'    => 'momentous_section_colors',
			'settings'   => 'momentous_theme_options[widget_link_color]',
			'priority' => 5
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[footer_color]', array(
        'default'           => '#282828',
		'type'           	=> 'option',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
		)
	);
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'momentous_control_footer_color', array(
			'label'      => __( 'Footer Color', 'momentous-lite'),
			'section'    => 'momentous_section_colors',
			'settings'   => 'momentous_theme_options[footer_color]',
			'priority' => 8
		) ) 
	);
	
}


?>