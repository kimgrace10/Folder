<?php
/**
 * The template part for the default header content
 */
 $search_field = get_options_data('home-page', 'home-section-2-search');
 // Search field
$search_html ='';
$prefix_title = '';

if (!empty($search_field) && $search_field !== 'disabled') {
	$search_html  = '<div class="home-search-field">';
	$search_html .= '	<form class="big-search" role="search" method="get" action="'. esc_url( home_url( '/' ) ) .'">';
	$search_html .= '		<input type="text" name="s" placeholder="'. esc_attr__( 'Find Your Next Destination...', 'framework') .'" value="'. esc_attr( get_search_query() ) .'">';
	$search_html .= '		<button type="submit"><span class="glyphicon glyphicon-search"></span></button>';
	$search_html .= '	</form>';
	$search_html .= '</div>';
}
?>



 <?php if (get_post_type($post_id) == 'travel-directory') { ?>
 	<?php if (has_post_thumbnail( $post_id )) {  ?>
<style id="hero-background">
	@media only screen and (max-width:640px){
		.hero{background-image:url(<?php echo the_post_thumbnail_url(); ?>);}}
	@media only screen and (min-width:641px){
		.hero{background-image:url(<?php echo the_post_thumbnail_url(); ?>);}}
</style>
	<?php } ?>
<?php } ?>


<section class="hero <?php echo rf_default_header_class(); ?>" <?php rf_header_styles() ?>>

	<?php

	// Maps in Hero (header)
	$maps = false;
	if (function_exists('show_destination_map') && show_destination_map( get_the_ID())) {
		// Load Maps
		include( 'destinations-maps.php' );
		$maps = true;
	}

	?>

<!-- 	<div class="bg-overlay" <?php if ($maps) { echo 'style="position:relative;"'; } // for overlay gradient, but no click/drag for maps ?>> -->
		<div class="bg-overlay dev">
		<div class="container" <?php rf_header_container_styles() ?> >

			<div class="intro-wrap">
			<?php
				
			
			$content = apply_filters('theme_header_subtitle', '');

			// Clean up
			if (isset($content)) {
				$content = html_entity_decode($content);
				$content = '<p>'.stripslashes($content).'</p>';
			}

			// Filter
			$title   = apply_filters('theme_header_title', $title);
			$content = apply_filters('theme_header_content', $content);
			 
			 if( is_tax('tribe_events_cat') ){
				 $term_id = get_queried_object()->term_id;
				 $title = get_term( $term_id )->name;   // Term Name.........
// 				 $title = 'Category';   
			 }
			 
			  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			  $post_id = url_to_postid( $actual_link );
			  if ( (get_post_type( $post_id ) == 'tribe_venue') ) {
				  
				 $title = get_the_title($post_id);   // Term Name.........
// 				  $title = 'Venue ';

			  }
			 
			  if ( (get_post_type( $post_id ) == 'tribe_organizer') ) {
				  
				  $title = get_the_title($post_id);   //Term Name.........
// 				  $title = 'Organizer';   

			  }



            /////////////////26-1-2022 title chnage start/////////////////
           // echo get_post_type( $post_id );

            if ( (get_post_type( $post_id ) == 'destination-page') ) {

                if(  get_the_title($post_id)=='About' || get_the_title($post_id)=='about' ){
                   $prefix_title = get_the_title($post_id).'&nbsp;';   //Term Name.........
                }else{
                   $prefix_title = get_the_title($post_id).' in'.'&nbsp;';   //Term Name.........
                }
            }

            if ( (get_post_type( $post_id ) == 'destination') && is_tax('destinations') ) {

                 $explode = explode("/","$_SERVER[REQUEST_URI]");
                 $new_explode = array_slice($explode, -3, 3, true);

                     //print_r( $new_explode );
                    // echo $new_explode[3];

                    $args = array(
                        'name'        => $new_explode[3],
                        'post_type'   => 'destination',
                        'post_status' => 'publish',
                        'numberposts' => 1
                    );
                    $my_posts = get_posts($args);


                // $post_1 = get_page_by_path($new_explode[3], OBJECT, 'destination' );
                 //$prefix_title = $post_1->post_title;
                $prefix_title = '<span class="ttl">'.$my_posts[0]->post_title.'</span>'.'&nbsp;';

            }

            if ( (get_post_type( $post_id ) == 'travel-directory') ) {
            
                 $category = get_term_by('id', get_queried_object()->term_id, 'travel-dir-category');

                 $prefix_title = $category->name.' in'.'&nbsp;';   //Term Name.........
            }

            /////////////////26-1-2022 title chnage end/////////////////

			 
   
			 
 		//	echo $title = get_the_title();
			do_action('before_header_title'); // make accessible to add custom content before title

			// Output the title and content text
			if (!empty($title)) {
				?>
      <?php if (get_post_type($post_id) == 'travel-directory') { ?>
         <?php ?>
         <h1 class="intro-title" style="font-family: 'Poppins', sans-serif !important;">
        <?php if(!is_tax()) { ?>
         <?php echo get_the_title(); ?>
         <?php } ?>
         </h1>

      <?php } else { ?>
		<h1 class="intro-title" style="font-family: 'Poppins', sans-serif !important;"><?php echo $prefix_title.wp_kses_post($title); ?></h1>
                <?php } ?>

                <?php if ( (is_page() || is_single()) && !is_singular('destination') ): ?>
                    <?php $bread_obj = get_field('destination');
                    $parent_post = get_post($bread_obj->post_parent);
                    if ($bread_obj && $bread_obj->ID != get_page_by_path('none', OBJECT, 'destination')->ID) { ?>
                    <ul class="breadcrumbs">
                        <li class="no-arrow"><i class="icon fa fa-map-marker"></i></li>
                         <li><a href="<?php echo get_permalink($parent_post->ID);?>"><?php echo  $parent_post->post_title;?></a></li> 
                        <li><a href="<?php echo get_permalink($bread_obj->ID);?>"><?php echo  $bread_obj->post_title;?></a></li>
                    </ul>
                <?php }
                    endif; ?>
				<?php
			}

			do_action('after_header_title'); // make accessible to add custom content after title

			if (!empty($content) && $content !== '<p></p>' ) {
				?>
				<div class="intro-text">
					<?php echo wp_kses_post($content); ?>
				</div>
                <?php echo $search_html; ?>
				<?php
			}

			do_action('after_header_intro_text'); // make accessible to add custom content after intro text

			?>
			</div>
		</div>
	</div>
</section>