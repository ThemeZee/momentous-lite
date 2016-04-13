<?php

/*==================================== THEME SETUP ====================================*/

// Load default style.css and Javascripts
add_action('wp_enqueue_scripts', 'momentous_enqueue_scripts');

function momentous_enqueue_scripts() { 
	
	// Register and Enqueue Stylesheet
	wp_enqueue_style('momentous-lite-stylesheet', get_stylesheet_uri());
	
	// Register Genericons
	wp_enqueue_style('momentous-lite-genericons', get_template_directory_uri() . '/css/genericons/genericons.css');

	// Register and enqueue navigation.js
	wp_enqueue_script('momentous-lite-jquery-navigation', get_template_directory_uri() .'/js/navigation.js', array('jquery'));
	
	// Get Theme Options from Database
	$theme_options = momentous_theme_options();
	
	// Register and Enqueue Masonry JS for two column post layout
	if ( isset($theme_options['post_layout']) and $theme_options['post_layout'] == 'index' ) :
	
		// Register and enqueue masonry script
		wp_enqueue_script('masonry');
		wp_enqueue_script('momentous-lite-masonry', get_template_directory_uri() .'/js/masonry-init.js', array('jquery', 'masonry'));
		
	endif;
	
	// Register Comment Reply Script for Threaded Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register and Enqueue Font
	wp_enqueue_style('momentous-lite-default-fonts', momentous_fonts_url(), array(), null );
	
}


// Embed HTML5shiv to support HTML5 elements in older IE versions plus CSS Backgrounds
add_action('wp_head', 'momentous_enqueue_html5shiv');

function momentous_enqueue_html5shiv(){  ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
	<![endif]-->
<?php
}

/*
* Retrieve Font URL to register default Google Fonts
* Source: http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
*/
function momentous_fonts_url() {
    $fonts_url = '';

	// Get Theme Options from Database
	$theme_options = momentous_theme_options();
	
	// Only embed Google Fonts if not deactivated
	if ( ! ( isset($theme_options['deactivate_google_fonts']) and $theme_options['deactivate_google_fonts'] == true ) ) :
		
		// Set Default Fonts
		$font_families = array('Average Sans:400,700', 'Fjalla One');
		 
		// Set Google Font Query Args
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		
		// Create Fonts URL
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		
	endif;
	
	return apply_filters( 'momentous_google_fonts_url', $fonts_url );
	
}


// Setup Function: Registers support for various WordPress features
add_action( 'after_setup_theme', 'momentous_setup' );

function momentous_setup() { 
	
	// Set Content Width
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 860;
		
	// init Localization
	load_theme_textdomain('momentous-lite', get_template_directory() . '/languages' );
	
	// Add Theme Support
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_editor_style();

	// Add Custom Background
	add_theme_support('custom-background', array('default-color' => 'cccccc'));

	// Set up the WordPress core custom logo feature
	add_theme_support( 'custom-logo', apply_filters( 'momentous_custom_logo_args', array(
		'height' => 40,
		'width' => 250,
		'flex-height' => true,
		'flex-width' => true,
	) ) );
	
	// Add Custom Header
	add_theme_support('custom-header', array(
		'header-text' => false,
		'width'	=> 1310,
		'height' => 240,
		'flex-height' => true));
	
	// Add Theme Support for wooCommerce
	add_theme_support( 'woocommerce' );
		
	// Register Navigation Menus
	register_nav_menus( array(
		'primary'   => esc_html__( 'Main Navigation', 'momentous-lite' ),
		'secondary' => esc_html__( 'Top Navigation', 'momentous-lite' ),
		'social' => esc_html__( 'Social Icons', 'momentous-lite' ),
		) 
	);
	
}


// Add custom Image Sizes
add_action( 'after_setup_theme', 'momentous_add_image_sizes' );

function momentous_add_image_sizes() { 
	
	// Add Custom Header Image Size
	add_image_size( 'custom_header_image', 1300, 240, true);
	
	// Add Featured Image Size
	add_image_size( 'post-thumbnail', 900, 300, true);

}


// Register Sidebars
add_action( 'widgets_init', 'momentous_register_sidebars' );

function momentous_register_sidebars() {
	
	// Register Sidebars
	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'momentous-lite' ),
		'id' => 'sidebar',
		'description' => esc_html__( 'Appears on posts and pages except the full width template.', 'momentous-lite' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
	
}


/*==================================== INCLUDE FILES ====================================*/

// include Theme Info page
require( get_template_directory() . '/inc/theme-info.php' );

// include Theme Customizer Options
require( get_template_directory() . '/inc/customizer/customizer.php' );
require( get_template_directory() . '/inc/customizer/default-options.php' );

// include Customization Files
require( get_template_directory() . '/inc/customizer/frontend/custom-layout.php' );

// Include Extra Functions
require get_template_directory() . '/inc/extras.php';

// include Template Functions
require( get_template_directory() . '/inc/template-tags.php' );

// Include support functions for Theme Addons
require get_template_directory() . '/inc/addons.php';

// Include Featured Content class
require get_template_directory() . '/inc/featured-content.php';