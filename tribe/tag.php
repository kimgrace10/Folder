<?php
	if ( has_post_thumbnail() ) {
		$bg_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	} ?>
	
<section class="hero small-hero" style="background-color:#ffffff;background-image:url(<?php echo esc_url($bg_image) ?>);">
	<div class="bg-overlay dev" >
		<div class="container" style="max-height: none; height: 445px;padding-top: 0;" >
			<div class="intro-wrap">
				 <h1 class="intro-title"><?php single_term_title(); ?></h1>
            </div>
		</div>
	</div>
</section>
<?php get_header(); ?>

<style>

.cs-tag-des{
	max-width: 1000px;
    margin: 30px auto;
}
.featured-article-cls {
   background: #fff; 
}
#loader {
  background: rgba(0,0,0,0.75) url(<?php echo get_stylesheet_directory_uri(); ?>/img/loading.gif) no-repeat center center;
}

</style>
<div class="cs-tag-des text-center">
<?php the_archive_description();  ?>
</div>
<section class="featured-article-cls cs-tag-wrpr">
<div class="container">
 
	 
	<?php
 
		 
			if ( have_posts() ) : 
			   
			?>
             
			<div class="row">

			<?php /* Start the Loop */
			while ( have_posts() ) : the_post(); ?>
 
	        
				<div class="col-lg-3 col-md-4 col-sm-6">
				    <?php get_template_part( 'templates/blog-content' ); ?>
				</div> 
 
			<?php endwhile;
			?>
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
	 
	 
</div>	
</section>
<div id="loader"></div>	
<?php get_footer(); ?>
<script>

var page = 2;
var tag = '<?php echo $tag_id; ?>';
 
jQuery(function($) {
	var spinner = jQuery('#loader');
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_tag_posts_by_ajax',
            'page': page,
            'tag': tag,
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