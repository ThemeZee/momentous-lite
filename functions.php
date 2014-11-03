<?php

/*==================================== THEME SETUP ====================================*/

// Load default style.css and Javascripts
add_action('wp_enqueue_scripts', 'momentous_enqueue_scripts');

if ( ! function_exists( 'momentous_enqueue_scripts' ) ):
function momentous_enqueue_scripts() { 
	
	// Register and Enqueue Stylesheet
	wp_enqueue_style('momentous-stylesheet', get_stylesheet_uri());
	
	// Register Genericons
	wp_enqueue_style('momentous-genericons', get_template_directory_uri() . '/css/genericons.css');

	// Register and enqueue navigation.js
	wp_enqueue_script('momentous-jquery-navigation', get_template_directory_uri() .'/js/navigation.js', array('jquery'));
	
}
endif;


// Load comment-reply.js if comment form is loaded and threaded comments activated
add_action( 'comment_form_before', 'momentous_enqueue_comment_reply' );
	
function momentous_enqueue_comment_reply() {
	if( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}


// Embed HTML5shiv to support HTML5 elements in older IE versions plus CSS Backgrounds
add_action('wp_head', 'momentous_enqueue_html5shiv');

function momentous_enqueue_html5shiv(){  ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
<?php
}


// Setup Function: Registers support for various WordPress features
add_action( 'after_setup_theme', 'momentous_setup' );

if ( ! function_exists( 'momentous_setup' ) ):
function momentous_setup() { 
	
	// Set Content Width
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 860;
		
	// init Localization
	load_theme_textdomain('momentous', get_template_directory() . '/languages' );
	
	// Add Theme Support
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_editor_style();

	// Add Custom Background
	add_theme_support('custom-background', array('default-color' => 'cccccc'));

	// Add Custom Header
	add_theme_support('custom-header', array(
		'header-text' => false,
		'width'	=> 1310,
		'height' => 240,
		'flex-height' => true));
		
	// Add theme support for Jetpack Featured Content
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'momentous_get_featured_content',
		'max_posts'  => 3
		)
	);
		
	// Register Navigation Menus
	register_nav_menus( array(
		'primary'   => __('Main Navigation', 'momentous'),
		'secondary' => __('Top Navigation', 'momentous'),
		'social' => __('Social Icons', 'momentous'),
		) 
	);
	
}
endif;


// Add custom Image Sizes
add_action( 'after_setup_theme', 'momentous_add_image_sizes' );

if ( ! function_exists( 'momentous_add_image_sizes' ) ):
function momentous_add_image_sizes() { 
	
	// Add Custom Header Image Size
	add_image_size( 'custom_header_image', 1300, 240, true);
	
	// Add Featured Image Size
	add_image_size( 'post-thumbnail', 900, 300, true);

}
endif;


// Register Sidebars
add_action( 'widgets_init', 'momentous_register_sidebars' );

if ( ! function_exists( 'momentous_register_sidebars' ) ):
function momentous_register_sidebars() {
	
	// Register Sidebars
	register_sidebar( array(
		'name' => __( 'Sidebar', 'momentous'),
		'id' => 'sidebar',
		'description' => __( 'Appears on posts and pages except front page and fullwidth template.', 'momentous'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
	
	//Register Footer Widgets
	register_sidebar( array(
		'name' => __( 'Footer Left', 'momentous'),
		'id' => 'footer-left',
		'description' => __( 'Appears on footer on the left hand side.', 'momentous'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar( array(
		'name' => __( 'Footer Center Left', 'momentous'),
		'id' => 'footer-center-left',
		'description' => __( 'Appears on footer on center left position.', 'momentous'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar( array(
		'name' => __( 'Footer Center Right', 'momentous'),
		'id' => 'footer-center-right',
		'description' => __( 'Appears on footer on center right position.', 'momentous'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar( array(
		'name' => __( 'Footer Right', 'momentous'),
		'id' => 'footer-right',
		'description' => __( 'Appears on footer on the right hand side.', 'momentous'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));
}
endif;


/*==================================== THEME FUNCTIONS ====================================*/

// Creates a better title element text for output in the head section
add_filter( 'wp_title', 'momentous_wp_title', 10, 2 );

function momentous_wp_title( $title, $sep = '' ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'momentous'), max( $paged, $page ) );

	return $title;
}


// Add Default Menu Fallback Function
function momentous_default_menu() {
	echo '<ul id="mainnav-menu" class="menu">'. wp_list_pages('title_li=&echo=0') .'</ul>';
}


// Get Featured Posts
function momentous_get_featured_content() {
	return apply_filters( 'momentous_get_featured_content', false );
}


// Check if featured posts exists
function momentous_has_featured_content() {
	return ! is_paged() && (bool) momentous_get_featured_content();
}


// Display Credit Link Function
function momentous_credit_link() {
	
	// Get Theme Options from Database
	$theme_options = momentous_theme_options();
	
	if ( isset($theme_options['credit_link']) and $theme_options['credit_link'] == true ) :
	
		printf(__( 'Powered by %1$s and %2$s.', 'momentous' ), 
				sprintf( '<a href="http://wordpress.org" title="WordPress">%s</a>', __( 'WordPress', 'momentous' ) ),
				sprintf( '<a href="http://themezee.com/themes/momentous/" title="Momentous WordPress Theme">%s</a>', __( 'Momentous', 'momentous' ) )
			);
		
	endif;
}


// Change Excerpt Length
add_filter('excerpt_length', 'momentous_excerpt_length');
function momentous_excerpt_length($length) {
    return 25;
}

// Slideshow Excerpt Length
function  momentous_featured_content_excerpt_length($length) {
    return 35;
}


// Change Excerpt More
add_filter('excerpt_more', 'momentous_excerpt_more');
function momentous_excerpt_more($more) {
    
	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Return Excerpt Text
	if ( isset($theme_options['excerpt_text']) and $theme_options['excerpt_text'] == true ) :
		return ' [...]';
	else :
		return '';
	endif;
}


// Custom Template for comments and pingbacks.
if ( ! function_exists( 'momentous_list_comments' ) ):
function momentous_list_comments($comment, $args, $depth) {
	
	$GLOBALS['comment'] = $comment;
	
	if( $comment->comment_type == 'pingback' or $comment->comment_type == 'trackback' ) : ?>
	
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'momentous'); ?> <?php comment_author_link(); ?> 
			<?php edit_comment_link( __( '(Edit)', 'momentous'), '<span class="edit-link">', '</span>' ); ?>
			</p>
	
	<?php else : ?>
	
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			
				<div class="comment-meta">
				
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 56 ); ?>
						<?php printf(__('<span class="fn">%s</span>', 'momentous'), get_comment_author_link()) ?>
					</div>

					<div class="commentmetadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(__('%1$s at %2$s', 'momentous'), get_comment_date(),  get_comment_time()) ?></a>
						<?php edit_comment_link(__('(Edit)', 'momentous'),'  ','') ?>
					</div>
					
				</div>
				
				<div class="comment-content">
					
					<?php comment_text(); ?>
					
					<?php if ($comment->comment_approved == '0') : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'momentous'); ?></p>
					<?php endif; ?>
					
					<div class="reply">
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>

				</div>
				
				
			</div>
<?php
	endif;
	
}
endif;


/*==================================== INCLUDE FILES ====================================*/

// include Theme Info page
require( get_template_directory() . '/inc/theme-info.php' );

// include Theme Customizer Options
require( get_template_directory() . '/inc/customizer/customizer.php' );
require( get_template_directory() . '/inc/customizer/default-options.php' );

// include Customization Files
require( get_template_directory() . '/inc/customizer/frontend/custom-colors.php' );
require( get_template_directory() . '/inc/customizer/frontend/custom-fonts.php' );
require( get_template_directory() . '/inc/customizer/frontend/custom-layout.php' );

// include Template Functions
require( get_template_directory() . '/inc/template-tags.php' );

// Include Featured Content class in case it does not exist yet (e.g. user has not Jetpack installed)
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}

?>