<?php
/**
 * Destination Places / Archive
 *
 * Master destinations list.
 *
 */

get_header(); 
?>

<style>
section.hero {
	    background-image: url(<?php echo get_field('upload_destination_image', 'option') ?>);
}
#loader {
  background: rgba(0,0,0,0.75) url(<?php echo get_stylesheet_directory_uri(); ?>/img/loading.gif) no-repeat center center;
}
</style>
<!-- Begin Query dropdown Destination -->
<?php

	$dest = array(
		'post_type' => 'destination', 
		'post__not_in' => array( $none_post_id ),       
        'posts_per_page' => -1,
        'post_parent__not_in' => array(0),
        'orderby' => 'title',
  		'order'     => 'ASC'
	);
	
	$dest_query = new WP_Query($dest);
?>
    <!-- End Query dropdown Destination -->
    
<section id="drp_destination" class="pb_60">
   <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6">
        <select id="sel_destination">
        	<option value="" disabled selected> Select Destination</option>
        	<?php while ( $dest_query->have_posts() ) {
            	$dest_query->the_post(); ?>
        		<option value="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></option>
        	<?php } ?>  
        </select>
     </div>
   </div>
</section>
<?php wp_reset_postdata(); ?>
<script>
jQuery(document).ready(function(){
  
  jQuery('select#sel_destination').on('change', function() {
    //alert( this.value );
    window.location.href = this.value;
    });

});
</script>


<?php

	// Places (child destinations)
	// -------------------------------------------------
	$none_post_id = get_page_by_path( 'none', OBJECT, 'destination' )->ID;
// print_r($none_post_id);
	// The Query
    
	$args = array(
		'post_type' => 'destination',
		'post__not_in' => array( $none_post_id ),
		'posts_per_page' => 12,
        'post_parent__not_in' => array(0),
        'orderby' => array( 'title' => 'ASC','menu_order' => 'ASC', 'parent' => 'ASC'  ),
        'order'=>'ASC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'include_on_destinations_directory',
				'value' => '',
				'compare' => '!=',
			),
			array(
				'key' => 'include_on_destinations_directory',
				'compare' => 'EXISTS'
			),
		)
	);
    
	/*
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
		'post_type' => 'destination',
		'post__not_in' => array( $none_post_id ),
		'posts_per_page' => 12,
        'paged' => $paged,  
        'orderby' => 'title',
  		'order'     => 'ASC',
        'ignore_sticky_posts' => 1,
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'include_on_destinations_directory',
				'value' => '',
				'compare' => '!=',
			),
			array(
				'key' => 'include_on_destinations_directory',
				'compare' => 'EXISTS'
			),
		)
	);*/
    
	$args = is_destination_archive( $args );
	$the_query = new WP_Query( $args );
//echo $the_query->request;
	// The Loop
	if ( $the_query->have_posts() ) { 
	 $total = $the_query->found_posts;
	?>
    
    
    
<section class="places">

	<div class="row" id="content">
  
<?php
				 
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				
				<div class="col-lg-3 col-md-3 col-sm-6 item">
					
					<?php get_template_part( 'templates/destination-content' ); ?>
				</div>
				
				<?php endwhile; ?>  

				<!--
				<div class="display-more"></div>
			   <div class="col-md-12 text-center">
				<?php if($total>8){ ?>
				  <button class="loadmore">Load More...</button>
				<?php } ?>
				</div>
                -->
			</div>
		</section>

		<?php
       
		// Paging function
        
		if (function_exists( 'rf_get_pagination' )) :
	//		rf_get_pagination( $the_query ); 
		endif;
		
	} 
	
	/* Restore original Post Data */
	//wp_reset_postdata(); 
    ?>
    
<div id="loader"></div>
<?php get_footer(); ?>
<script>

var page = 2;
jQuery(function($) {
	var spinner = jQuery('#loader');
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_destination_by_ajax',
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
    
    //--- BEGIN TEST LAZY LOADING ---
    /*
    var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
	    bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts

    
    $(window).scroll(function() {
        var data = {
			'action': 'load_destination_by_ajax',
            'page': page,
            'security': blog.security
		};
        if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){
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
        }
    });
    */
    //--- END TEST LAZY LOADING ---
});
 
</script>