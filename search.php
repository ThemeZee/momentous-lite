<?php get_header(); ?>

<?php // Get Theme Options from Database
	$theme_options = momentous_theme_options();
?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
			<?php // Display breadcrumbs or archive title
			if ( function_exists( 'themezee_breadcrumbs' ) ) :

				themezee_breadcrumbs();

			else : ?>
			
				<h1 id="search-title" class="archive-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'momentous-lite' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			
			<?php
			endif; ?>
			
			<?php if ( have_posts() ) : ?>
			
			<div id="post-wrapper" class="post-wrapper clearfix">
		 
			<?php while ( have_posts() ) : the_post();

				get_template_part( 'content', $theme_options['post_layout'] );

			endwhile; ?>
			
			</div>
			
			<?php // Display Pagination
			momentous_display_pagination();

		else : ?>

			<div class="type-page">
				
				<h2 class="page-title entry-title"><?php esc_html_e( 'No matches', 'momentous-lite' ); ?></h2>
				
				<div class="entry clearfix">
					
					<p><?php esc_html_e( 'Please try again, or use the navigation menus to find what you search for.', 'momentous-lite' ); ?></p>
					
					<?php get_search_form(); ?>
					
				</div>
				
			</div>

		<?php endif; ?>
		
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>
