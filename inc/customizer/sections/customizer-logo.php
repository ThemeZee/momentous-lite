<?php
/**
 * Register Site Logo section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'momentous_customize_register_logo_settings' );

function momentous_customize_register_logo_settings( $wp_customize ) {

	// Add Section for General Settings
	$wp_customize->add_section( 'momentous_section_logo', array(
        'title'    => __( 'Site Logo', 'momentous' ),
        'priority' => 20,
		'panel' => 'momentous_options_panel' 
		)
	);
	
	// Add Site Logo option & image uploader.
	$wp_customize->add_setting( 'site_logo', array(
		'default' => array('url' => false, 'id' => 0 ),
		'type'       => 'option',
		'capability' => 'manage_options',
		'transport'  => 'refresh'
	) );
	$wp_customize->add_control( new Momentous_Site_Logo_Control( $wp_customize, 'site_logo', array(
	    'label'    => __( 'Site Logo', 'momentous' ),
	    'section'  => 'momentous_section_logo',
	    'settings' => 'site_logo',
		'priority' => 1
	) ) );
	
}

?>