
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'one-column-post' ); ?>>

		<?php momentous_display_thumbnail_index(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-meta postmeta clearfix"><?php momentous_display_postmeta(); ?></div>

		<div class="entry clearfix">
			<?php momentous_post_content(); ?>
		</div>

		<div class="postinfo clearfix"><?php momentous_display_postinfo_index(); ?></div>

	</article>
