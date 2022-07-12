<?php
/**
 * The main template file. (loads blog posts)
 */

$postStyle = get_options_data('options-page', 'blog-layout-style'); // update to check theme option
$postStyle = ( !empty($postStyle) ) ? '-'.$postStyle : ''; // set to layout style #

get_header(); ?>
<style>
#loader {
  background: rgba(0,0,0,0.75) url(<?php echo get_stylesheet_directory_uri(); ?>/img/loading.gif) no-repeat center center;
}

</style>
<div class="container">
	<div class="row blog-posts<?php echo esc_html($postStyle) ?>">
        
		<div class="cs-blog-page">
		<?php
		 
		 

		if ( have_posts() ) : 
		
		?>

			<div class="row" id="content">
				<?php  $data = get_post_meta(33165); ?>
				<?php if (!empty($data['custom_title'][0])): ?>
					<div class="col-lg-12 article-title-section">
						<h1 class="article-title"><?php echo $data['custom_title'][0]?></h1>
						<p class="article-description"><?php  echo $data['custom_description_text'][0] ?></p>
					</div>
				<?php endif; ?>
				


			<?php /* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

				<div class="col-lg-3 col-md-4 col-sm-6">
				    <?php get_template_part( 'templates/blog-content' ); ?>
				</div> 

			<?php  endwhile; ?>
             <!--<div class="display-more"></div>
				<div class="col-md-12 text-center">
				<?php if($total>12){ ?>
				  <button class="loadmore">Load More...</button>
				<?php } ?>
				</div>-->
			</div><!-- /.row -->
             
			<?php

			// Paging function
			if (function_exists( 'rf_get_pagination' )) :
				rf_get_pagination();
			endif;

		else :

			get_template_part( 'no-results', 'index' );

		endif; // end of loop. ?>

		</div><!-- / #content -->
	</div><!-- /.row -->
	</div><!-- /.Container -->
<div id="loader"></div>	 
<?php get_footer(); ?>
<script>

var page = 2;
 
jQuery(function($) {
	var spinner = jQuery('#loader');
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_blog_posts_by_ajax',
            'page': page,
            'security': blog.security
        };
        spinner.show();
        $.post(blog.ajaxurl, data, function(response) {
            if($.trim(response) != '') {
                $('.display-more').append(response);
				spinner.hide();
                page++;
            } else {
                $('.loadmore').hide();
				spinner.hide();
            }
        });
    });
});
 
</script>