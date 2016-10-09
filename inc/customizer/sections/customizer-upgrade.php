<?php
/**
 * Register upgrade section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'momentous_customize_register_upgrade_settings' );

function momentous_customize_register_upgrade_settings( $wp_customize ) {

	// Add Upgrade / More Features Section
	$wp_customize->add_section( 'momentous_section_upgrade', array(
		'title'    => esc_html__( 'More Features', 'momentous-lite' ),
		'priority' => 60,
		'panel' => 'momentous_options_panel',
	) );

	// Add custom Upgrade Content control
	$wp_customize->add_setting( 'momentous_theme_options[upgrade]', array(
		'default'           => '',
		'type'            	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( new Momentous_Customize_Upgrade_Control(
		$wp_customize, 'momentous_theme_options[upgrade]', array(
			'section'  => 'momentous_section_upgrade',
			'settings' => 'momentous_theme_options[upgrade]',
			'priority' => 1,
			)
	) );

}
