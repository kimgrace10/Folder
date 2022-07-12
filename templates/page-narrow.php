<?php
/**
 * Template Name: Narrow
 * 
 * Displays a narrow content column
 *
 */

get_header(); ?>

	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				 

			<?php endwhile; // end of the loop. ?>
		</div>
	</div>

<?php get_footer(); ?>
