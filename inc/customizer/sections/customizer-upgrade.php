<?php
/**
 * Register PRO Version section, settings and controls for Theme Customizer
 *
 */

// Add Theme Colors section to Customizer
add_action( 'customize_register', 'momentous_customize_register_upgrade_settings' );

function momentous_customize_register_upgrade_settings( $wp_customize ) {

	// Add Sections for Post Settings
	$wp_customize->add_section( 'momentous_section_upgrade', array(
        'title'    => __( 'Pro Version', 'momentous-lite' ),
        'priority' => 60,
		'panel' => 'momentous_options_panel' 
		)
	);

	// Add PRO Version Section
	$wp_customize->add_setting( 'momentous_theme_options[pro_version_label]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Momentous_Customize_Header_Control(
        $wp_customize, 'momentous_control_pro_version_label', array(
            'label' => __( 'You need more features?', 'momentous-lite' ),
            'section' => 'momentous_section_upgrade',
            'settings' => 'momentous_theme_options[pro_version_label]',
            'priority' => 1
            )
        )
    );
	$wp_customize->add_setting( 'momentous_theme_options[pro_version]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Momentous_Customize_Text_Control(
        $wp_customize, 'momentous_control_pro_version', array(
            'label' =>  __( 'Purchase the Pro Version to get additional features and advanced customization options.', 'momentous-lite' ),
            'section' => 'momentous_section_upgrade',
            'settings' => 'momentous_theme_options[pro_version]',
            'priority' => 2
            )
        )
    );
	$wp_customize->add_setting( 'momentous_theme_options[pro_version_button]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Momentous_Customize_Button_Control(
        $wp_customize, 'momentous_control_pro_version_button', array(
            'label' => sprintf( __( 'Learn more about %s Pro', 'momentous-lite' ), 'Momentous'),
			'section' => 'momentous_section_upgrade',
            'settings' => 'momentous_theme_options[pro_version_button]',
            'priority' => 3
            )
        )
    );

}

?>