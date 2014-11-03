<?php
/**
 * Register Theme Font section, settings and controls for Theme Customizer
 *
 */

// Add Theme Fonts section to Customizer
add_action( 'customize_register', 'momentous_customize_register_font_settings' );

function momentous_customize_register_font_settings( $wp_customize ) {

	// Add Section for Theme Fonts
	$wp_customize->add_section( 'momentous_section_fonts', array(
        'title'    => __( 'Theme Fonts', 'momentous-lite' ),
        'priority' => 70,
		'panel' => 'momentous_options_panel' 
		)
	);

	// Add settings and controls for theme fonts
	$wp_customize->add_setting( 'momentous_theme_options[text_font]', array(
        'default'           => 'Average Sans',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
		)
	);
	$wp_customize->add_control( new Momentous_Customize_Font_Control( 
		$wp_customize, 'text_font', array(
			'label'      => __( 'Default Text Font', 'momentous-lite' ),
			'section'    => 'momentous_section_fonts',
			'settings'   => 'momentous_theme_options[text_font]',
			'priority' => 1
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[title_font]', array(
        'default'           => 'Fjalla One',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
		)
	);
	$wp_customize->add_control( new Momentous_Customize_Font_Control( 
		$wp_customize, 'title_font', array(
			'label'      => __( 'Title Font', 'momentous-lite' ),
			'section'    => 'momentous_section_fonts',
			'settings'   => 'momentous_theme_options[title_font]',
			'priority' => 2
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[navi_font]', array(
        'default'           => 'Average Sans',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
		)
	);
	$wp_customize->add_control( new Momentous_Customize_Font_Control( 
		$wp_customize, 'navi_font', array(
			'label'      => __( 'Navigation Font', 'momentous-lite' ),
			'section'    => 'momentous_section_fonts',
			'settings'   => 'momentous_theme_options[navi_font]',
			'priority' => 3
		) ) 
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[widget_title_font]', array(
        'default'           => 'Average Sans',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
		)
	);
	$wp_customize->add_control( new Momentous_Customize_Font_Control( 
		$wp_customize, 'widget_title_font', array(
			'label'      => __( 'Widget Title Font', 'momentous-lite' ),
			'section'    => 'momentous_section_fonts',
			'settings'   => 'momentous_theme_options[widget_title_font]',
			'priority' => 4
		) ) 
	);
	
	// Install more Fonts
	$wp_customize->add_setting( 'momentous_theme_options[installed_fonts]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
		)
	);
    $wp_customize->add_control( 'momentous_control_installed_fonts', array(
        'label'    => __( 'Install additional Fonts', 'momentous-lite' ),
        'section'  => 'momentous_section_fonts',
        'settings' => 'momentous_theme_options[installed_fonts]',
        'type'     => 'textarea',
		'priority' => 5
		)
	);
	
	$wp_customize->add_setting( 'momentous_theme_options[installed_fonts_description]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Momentous_Customize_Description_Control(
        $wp_customize, 'momentous_control_installed_fonts_description', array(
            'label' => __('You can install additional fonts from the <a target="_blank" href="http://www.google.com/webfonts/">Google Font API</a> by inserting a list of fonts separated by Semicolon here (e.g. Cantora One; Galindo; Open Sans; ...). Please save your changes and RELOAD(F5) the Customizer then.', 'momentous-lite'),			
            'section' => 'momentous_section_fonts',
            'settings' => 'momentous_theme_options[installed_fonts_description]',
            'priority' => 6
            )
        )
    );
	
}


?>