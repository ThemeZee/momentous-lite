<?php
/***
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 */


if ( ! function_exists( 'momentous_site_logo' ) ) :
	/**
 * Displays the site logo in the header area
 */
	function momentous_site_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {

			the_custom_logo();

		}

	}
endif;


if ( ! function_exists( 'momentous_site_title' ) ) :
	/**
 * Displays the site title in the header area
 */
	function momentous_site_title() {

		if ( is_home() ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

	<?php endif;

	}
endif;


if ( ! function_exists( 'momentous_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function momentous_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) : ?>

			<p class="site-description"><?php echo $description; ?></p>

		<?php
		endif;
	}
endif;


// Display Custom Header
if ( ! function_exists( 'momentous_display_custom_header' ) ) :

	function momentous_display_custom_header() {

		// Get theme options from database
		$theme_options = momentous_theme_options();

		// Hide header image on front page
		if ( true == $theme_options['custom_header_hide'] and is_front_page() ) {
			return;
		}

		// Check if page is displayed and featured header image is used
		if ( is_page() && has_post_thumbnail() ) : ?>

			<div id="custom-page-header" class="header-image container">
				<?php the_post_thumbnail( 'custom_header_image' ); ?>
			</div>

		<?php
		// Check if there is a custom header image
		elseif ( get_header_image() ) : ?>

			<div id="custom-header" class="header-image container">

				<?php // Check if custom header image is linked
				if ( $theme_options['custom_header_link'] <> '' ) : ?>

					<a href="<?php echo esc_url( $theme_options['custom_header_link'] ); ?>">
						<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>

				<?php else : ?>

					<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

				<?php endif; ?>

			</div>

		<?php
		endif;
	}

endif;


if ( ! function_exists( 'momentous_post_content' ) ) :
	/**
	* Displays the post content on archive pages
	*/
	function momentous_post_content() {

		// Get theme options from database.
		$theme_options = momentous_theme_options();

		// Display Excerpt or Full Content?
		if ( 'excerpt' === $theme_options['post_content'] ) {

			the_excerpt();
			echo '<a href="' . esc_url( get_permalink() ) . '" class="more-link">' . esc_html__( 'Continue reading &raquo;', 'momentous-lite' ) . '</a>';

		} else {

			the_content( esc_html__( 'Continue reading &raquo;', 'momentous-lite' ) );

		}

	}
endif;

// Display Postmeta Data
if ( ! function_exists( 'momentous_display_postmeta' ) ) :

	function momentous_display_postmeta() {

		// Get Theme Options from Database
		$theme_options = momentous_theme_options();

		// Display Date unless user has deactivated it via settings
		if ( true == $theme_options['meta_date'] ) :

			momentous_meta_date();

		endif;

		// Display Author unless user has deactivated it via settings
		if ( true == $theme_options['meta_author'] ) :

			momentous_meta_author();

		endif;

	}

endif;


// Display Post Date
function momentous_meta_date() {

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf( esc_html_x( 'Posted on %s', 'post date', 'momentous-lite' ), $time_string );

	echo '<span class="meta-date">' . $posted_on . '</span>';

}


// Display Post Author
function momentous_meta_author() {

	$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( esc_html__( 'View all posts by %s', 'momentous-lite' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);

	$byline = sprintf( esc_html_x( 'by %s', 'post author', 'momentous-lite' ), $author_string );

	echo '<span class="meta-author"> ' . $byline . '</span>';

}


// Display Post Thumbnail on Archive Pages
function momentous_display_thumbnail_index() {

	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Display Post Thumbnail if activated
	if ( isset( $theme_options['post_thumbnails_index'] ) and $theme_options['post_thumbnails_index'] == true ) : ?>

		<a href="<?php esc_url( the_permalink() ) ?>" rel="bookmark">
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
		</a>

<?php
	endif;

}


// Display Post Thumbnail on single posts
function momentous_display_thumbnail_single() {

	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Display Post Thumbnail if activated
	if ( isset( $theme_options['post_thumbnails_single'] ) and $theme_options['post_thumbnails_single'] == true ) :

		the_post_thumbnail( 'post-thumbnail' );

	endif;

}


// Display Postinfo Data on Archive Pages
if ( ! function_exists( 'momentous_display_postinfo_index' ) ) :

	function momentous_display_postinfo_index() {

		if ( comments_open() ) : ?>

			<div class="meta-comments">
				<?php comments_popup_link( '0', '1', '%' ); ?>
			</div>

		<?php endif;

		// Get Theme Options from Database
		$theme_options = momentous_theme_options();

		// Display Date unless user has deactivated it via settings
		if ( isset( $theme_options['meta_category'] ) and $theme_options['meta_category'] == true ) : ?>

			<span class="meta-category">
				<?php printf( '%1$s', get_the_category_list( ', ' ) ); ?>
			</span>

		<?php endif;

	}

endif;


// Display Postinfo Data
if ( ! function_exists( 'momentous_display_postinfo_single' ) ) :

	function momentous_display_postinfo_single() {

		if ( comments_open() ) : ?>

			<div class="meta-comments">
				<?php comments_popup_link( '0', '1', '%' ); ?>
			</div>

		<?php endif;

		// Get Theme Options from Database
		$theme_options = momentous_theme_options();

		// Display Date unless user has deactivated it via settings
		if ( isset( $theme_options['meta_category'] ) and $theme_options['meta_category'] == true ) : ?>

			<span class="meta-category">
				<?php printf( '%1$s', get_the_category_list( ', ' ) ); ?>
			</span>

		<?php endif;

		// Display Date unless user has deactivated it via settings
		if ( isset( $theme_options['meta_tags'] ) and $theme_options['meta_tags'] == true ) :

			$tag_list = get_the_tag_list( '', ', ' );
			if ( $tag_list ) : ?>

				<span class="meta-tags">
					<?php printf( '%1$s', $tag_list ); ?>
				</span>

			<?php endif;

		endif;

	}

endif;


// Display Single Post Navigation
if ( ! function_exists( 'momentous_display_post_navigation' ) ) :

	function momentous_display_post_navigation() {

		// Get Theme Options from Database
		$theme_options = momentous_theme_options();

		if ( true == $theme_options['post_navigation'] ) {

			the_post_navigation( array( 'prev_text' => '&laquo; %title', 'next_text' => '%title &raquo;' ) );

		}
	}

endif;


// Display ThemeZee Related Posts plugin
if ( ! function_exists( 'momentous_display_related_posts' ) ) :

	function momentous_display_related_posts() {

		if ( function_exists( 'themezee_related_posts' ) ) {

			themezee_related_posts( array(
				'class' => 'related-posts widget clearfix',
				'before_title' => '<h2 class="widgettitle related-posts-title"><span>',
				'after_title' => '</span></h2>',
			) );

		}
	}

endif;


// Display Content Pagination
if ( ! function_exists( 'momentous_display_pagination' ) ) :

	function momentous_display_pagination() {

		global $wp_query;

		$big = 999999999; // need an unlikely integer

		 $paginate_links = paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var( 'paged' ) ),
				'total' => $wp_query->max_num_pages,
				'next_text' => '&raquo;',
				'prev_text' => '&laquo',
				'add_args' => false,
		 ) );

		 // Display the pagination if more than one page is found
		 if ( $paginate_links ) : ?>

			  <div class="post-pagination clearfix">
					<?php echo $paginate_links; ?>
			  </div>

			<?php
		endif;

	}

endif;


// Display Footer Text
if ( ! function_exists( 'momentous_display_footer_text' ) ) :

	function momentous_display_footer_text() {

		// Get Theme Options from Database
		$theme_options = momentous_theme_options();

		if ( isset( $theme_options['footer_text'] ) and $theme_options['footer_text'] <> '' ) :

			echo do_shortcode( wp_kses_post( $theme_options['footer_text'] ) );

		endif;
	}

endif;


// Display Credit Link
add_action( 'momentous_credit_link', 'momentous_display_credit_link' );

function momentous_display_credit_link() {

	printf( esc_html__( 'Powered by %1$s and %2$s.', 'momentous-lite' ),
		'<a href="http://wordpress.org" title="WordPress">WordPress</a>',
		'<a href="https://themezee.com/themes/momentous/" title="Momentous WordPress Theme">Momentous</a>'
	);
}


// Display Social Icons
function momentous_display_social_icons() {

	// Check if there is a social_icons menu
	if ( has_nav_menu( 'social' ) ) :

		// Display Social Icons Menu
		wp_nav_menu( array(
			'theme_location' => 'social',
			'container' => false,
			'menu_id' => 'social-icons-menu',
			'echo' => true,
			'fallback_cb' => '',
			'before' => '',
			'after' => '',
			'link_before' => '<span class="screen-reader-text">',
			'link_after' => '</span>',
			'depth' => 1,
			)
		);

	else : // Display Hint how to configure Social Icons ?>

		<p class="social-icons-hint">
			<?php esc_html_e( 'Please go to Appearance &#8594; Menus and create a new custom menu with custom links to all your social networks. Then click on "Manage Locations" tab and assign your created menu to the "Social Icons" location.', 'momentous-lite' ); ?>
		</p>
<?php
	endif;

}


// Custom Template for comments and pingbacks.
if ( ! function_exists( 'momentous_list_comments' ) ) :
	function momentous_list_comments( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;

		if ( $comment->comment_type == 'pingback' or $comment->comment_type == 'trackback' ) : ?>

			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php esc_html_e( 'Pingback:', 'momentous-lite' ); ?> <?php comment_author_link(); ?>
				<?php edit_comment_link( esc_html__( '(Edit)', 'momentous-lite' ), '<span class="edit-link">', '</span>' ); ?>
				</p>

		<?php else : ?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">

				<div class="comment-meta">

					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 56 ); ?>
						<?php printf( '<span class="fn">%s</span>', get_comment_author_link() ); ?>
					</div>

					<div class="commentmetadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'momentous-lite' ), get_comment_date(),  get_comment_time() ) ?></a>
						<?php edit_comment_link( esc_html__( '(Edit)', 'momentous-lite' ),'  ','' ) ?>
					</div>

				</div>

				<div class="comment-content">

					<?php comment_text(); ?>

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'momentous-lite' ); ?></p>
					<?php endif; ?>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
					</div>

				</div>


			</div>
<?php
	endif;

	}
endif;
