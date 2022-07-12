<?php
/**
 * Destination Home Page
 *
 */
$title = get_the_title();
$title   = apply_filters('theme_header_title', $title);
		global $post;
    $post_slug = $post->post_name;


// This template includes built-in layout containers.
add_filter('theme_template_has_layout', function(){ return true; });

// Helpers
$dest = $post;
$settings = get_destination_settings();

// Check for content sections
$sub_nav_items = destination_sub_navigation( false ); // only return


get_header(); 

		get_template_part( 'templates/parts/destinations-sub-nav' ); ?>
<style>
.more-ex-cls .title-row {
    padding: 55px 0 0px;
}
.exp-more-grid {
    align-items: end;
}
.exp-more-grid .dest_box:first-child {
    margin-top: 50px;
}
</style>
		<!-- Main Section
		================================================== -->
		<section class="main">
			<div class="container">
				
					<div class="destination-wrapper">
					<!-- <div class="col-sm-12 col-fixed-content"> -->
					<?php 


					// Start the WP loop
					while ( have_posts() ) : the_post(); ?>

						<div class="intro">
							<h2 class="lead"><?php echo get_destination_intro(); ?></h2>
							<div class="entry-content"><?php the_content(); ?></div>
						</div>


						<?php 

						// Places (child destinations)
						// -------------------------------------------------

						// The Query
						$args = array(
							'post_type' => 'destination',
							'post_parent' => $dest->ID, // $dest_ID,
							'posts_per_page' => isset($settings['number_posts_child'])? $settings['number_posts_child'] : 4,
							'meta_key' => 'destination_order',
							'orderby' => array( 'meta_value_num' => 'ASC', 'title' => 'ASC' ),
						);
						$places_query = new WP_Query( $args );

						// The Loop
						if ( $places_query->have_posts() ) { ?>
							
						<section class="narrow places no-border">

							<!-- Section Title -->
							<div class="title-row">
								<h3 class="title-entry"><?php _e('Places in', 'framework') ?> <?php the_title(); ?></h3>
								<!-- <a href="<?php //echo esc_url(get_destination_taxonomy_term_links( 'places', $dest->post_name )) ?>" class="btn btn-primary btn-xs"><?php //_e('Find More', 'framework'); ?> &nbsp; <i class="fa fa-angle-right"></i></a> -->
							</div>

							<div class="row">


								<?php
								// for each post...
								while ( $places_query->have_posts() ) : $places_query->the_post();
								$meta_print_value=get_post_meta(get_the_ID());
								// echo '<pre>';
								// print_r($meta_print_value);
								// echo '</pre>';
								?>
								<div class="col-lg-3 col-md-4 col-sm-6">
									<?php get_template_part( 'content-place', 'parent' ); ?>
								</div>
								<?php
								endwhile;

								?>

							</div> <!-- /.row -->

						</section>

							<?php
						} 
						
						/* Restore original Post Data */
						wp_reset_postdata();
						?>
					</div>

				<!-- <div class="col-sm-12 col-fixed-sidebar">
					<?php //get_sidebar(); ?>
				</div> --><!-- /sidebar -->

                    
		</div>
		</section>

        <?php 

						// Articles (blog)
						// -------------------------------------------------
						$childrens = get_children([
							'post_parent' => get_post()->ID,
							'post_status' => 'publish'
						]);
						//$limit = isset($settings['number_posts_blogs'])? $settings['number_posts_blogs'] : 3;
						if( !empty($childrens)){
							foreach( $childrens as $children ){
								$array_id[]=$children->ID;
							}
							$post_args = array(
								    'post_type'      => 'post',
								    'orderby' => 'date',
								    'order'   => 'DESC',
								    'posts_per_page' => -1,
								    'meta_query' => [
										'relation' => 'AND',
										[
											'key' => 'destination',
											'value' => $array_id
										]
									],
								);
						}else{
						$post_args = array(
								    'post_type'      => 'post',
								    'orderby' => 'date',
								    'order'   => 'DESC',
								    'meta_key' => 'destination',
								    'posts_per_page' => -1,
								    'meta_value' => get_post()->ID
								);
					}
									// The Query
									$the_query = new WP_Query( $post_args ); //new WP_Query( $args );
									if (isset($the_query)):
 							?>
						<section class="featured-article-cls">
							<div class="container">
							<div class="title-row">
							<h3 class="title-entry">Featured Articles</h3></div>
								<div class="owl-carousel owl-theme">
									<?php
									
									// The Loop
									if ( $the_query->have_posts() ) {
									
										// for each post...
										
										while ( $the_query->have_posts() ) : $the_query->the_post();

											get_template_part( 'content-post-3', get_post_format() );

										endwhile;

									} else {
										get_template_part( 'no-results', 'destination-blog' ); 
									}
									
									/* Restore original Post Data */
									wp_reset_postdata();
												
									?>									
									</div>
									<?php 	
										$more_article_link = site_url() . '/destinations/' . $post_slug . '/articles';
									 ?>
								<div class="more-link"><a href="<?= $more_article_link;?>" class="btn btn-primary btn-xs">View More <?php echo wp_kses_post($title); ?> Articles</a></div>
							</div>	
							</section>
						<?php endif;

					endwhile; // end of the loop. ?>

		<!-- Upcomming Events -->
		<section class="upcoming-event-cls pb_60">
			<div class="container">
			<div class="title-row">
			<h3 class="title-entry">Upcoming Events</h3></div>
				<div class="owl-carousel owl-theme">
				 <?php
					global $post;
					if ( $post->post_parent == 0 ) {

						$children_args = array(
						    'post_type'      => 'destination',
						    'posts_per_page' => -1,
						    'post_parent'    => $post->ID,
						    'post_status'    => 'publish',
						    );

						$get_children = get_children( $children_args, ARRAY_A );
						$dest_slugs=array($post->post_name);

						foreach ($get_children as $child) {
							array_push($dest_slugs,$child['post_name']);
						}
					} else {
						$dest_slugs=array($post->post_name);
					} 
				 	// echo '<pre>'; print_r($dest_slugs); echo '</pre>';

// 					$myposts = get_posts( array(
// 						'posts_per_page' => -1,
// 						'offset'         => 1,
// 						'post_type'        => 'tribe_events',
// 			             'tax_query' => array(
// 					            array(
// 					                'taxonomy' => 'tribe_events_cat',
// 					                'field' => 'slug',
// 					                'terms'    => $dest_slugs
// 					            ),
// 					        ),
// 						'post_status'    => 'publish'
// 					) );
					
					$myposts = tribe_get_events( array(
						'posts_per_page' => -1,
						'start_date'     => 'now',
						'tax_query' => array(
					            array(
					                'taxonomy' => 'tribe_events_cat',
					                'field' => 'slug',
					                'terms'    => $dest_slugs
					            ),
					        ),
					) );

					if ( $myposts ) {
						foreach ( $myposts as $post ) : 
							setup_postdata( $post ); ?>
									
					<?php
					$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-landscape' );
					//echo "daga".$feat_image; die;
// 					echo tribe_get_start_date();
 					//$post_date = tribe_get_start_time ( $post->ID, 'M dS, Y');	
				    $post_date = tribe_get_start_date( $post->ID, false, 'M j, Y');
				    $end_date = tribe_get_end_date( $post->ID, false, 'M j, Y');
						
						
					
					//$post_date = get_the_date( 'M dS, Y' );
					$meta = get_post_meta($post->ID);
					//echo "<pre>"; print_r($meta);	echo "</pre>";
					$key_1_values = get_post_meta( $post->ID, '_EventVenueID' );
					//echo "<pre>"; print_r();	echo "</pre>";
					$metaId  = $key_1_values[0];

					// $term_obj_list = get_the_terms( $post->ID, 'tribe_events_cat' );
					// $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));

					?>

					<div class="item">
						<div class="featured-img-contain">
							<a href="<?php the_permalink(); ?>">
								<img class="event-img-cls" src="<?php echo $feat_image[0]; ?>" class="featured-img-cls" alt="<?php the_title(); ?>"></a></div> 
						<div class="event-date-cls"><?php echo $post_date; ?><?php if( !empty($end_date) && $post_date != $end_date ){ echo ' - '.$end_date; } ?></div>
						
						<div class="event-title-cls">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <div class="venu-cls"><?php echo esc_html( get_the_title($metaId) ); ?></div>
						<span class="learn-more-cls">
								<?php //echo $terms_string; ?>
								<a href="<?php the_permalink(); ?>">Learn More</a>
							</span>
						</div>
						
					</div>
							
						<?php
						endforeach;
						wp_reset_postdata();
					}
					?>
				</div>
				<?php 	
					$more_events_link = 'https://' . $_SERVER['HTTP_HOST'] . '' . $_SERVER['REQUEST_URI'] . 'events';
					$more_events_link = str_replace('destination', 'information', $more_events_link);
				 ?>
				<div class="more-link"><a href="<?php 	echo $more_events_link; ?>" class="btn btn-primary btn-xs">View More <?php echo wp_kses_post($title); ?> Events</a></div>
			</div>	
			</section>

     <?php if( !empty(get_field('article_page_title')) ){ ?>
       <div class="experiences_column light-bg pb_60">
            <div class="container popular_experiences">
                <div class="title-row">
                	<h3 class="title-entry">Popular Experiences</h3>				
                </div>               
                <!-- <div class="tripster-widget" data-rex-ids="2109,2137,2479" data-rex-fmt="sm,min,col,brd,shd"></div> -->
                <div class="expSlider" >
                	<?php 
                		echo get_field('article_page_title'); 
                	?>                    
                </div>
				<?php if(!empty(get_field('things_link'))){ ?>
                <div class="more-link"><a href="<?php the_field('things_link'); ?>" class="btn btn-primary btn-xs">View All 				<?php the_title(); ?> Experiences</a></div>
				<?php } ?>
            </div>
        </div>
	<?php } ?>

        <section class="gotrip-cls">
        <div class="container">
        <div class="title-heading-cls">
        <?php 
        $data = get_post(33079);
        echo  $data->post_title;
        //echo "<pre>"; print_r($data);	echo "</pre>";
        ?>
        </div>
        <div class="title-content-cls">	<p><?php echo $data->post_content; ?></p></div>
        </div>	
        </section>


		<section class="more-ex-cls">
		<div class="container">
		<div class="title-row">
		<h3 class="title-entry">Experience More</h3></div>
		<div class="exp-more-grid">
		 <?php
			$child_ids = array();
			$dest_childrens = get_children( array( 'post_parent' => $dest->ID), OBJECT );
			
			
			$meta_query = array();
			$meta_query['relation'] = 'OR';
		
			
			foreach ($dest_childrens as $child) {
				//$child_ids[] = $child->ID;
				$meta_query[] = array(
					'key'   => 'destination',
					'value' => $child->ID,
				);			
			}
			
// 			print_r($meta_query);		
			
		 	$categories=get_categories(
		    array( 'parent' => 2782 )
		);
// 		echo "<pre>"; print_r($categories); echo "</pre>";  die;
		    global $post;
		 
		    if ( $categories ) {
		        foreach ( $categories as $postData ) : 				
				
				   if ( $dest->post_parent ) {
						// This is a subpage						
					    $args = array(
							'post_type'  => 'post',
							'posts_per_page' => -1,
							'category__in' => $postData->term_id,
							'meta_query' => array(
								array(
									'key'     => 'destination',
									'value'   => $dest->ID,
								),
							),
						);
						$query = new WP_Query( $args );
						$postCount = $query->post_count; 
					   					
					} else {
						// This is not a subpage
						
					   $args = array(
							'post_type'  => 'post',
						    'posts_per_page' => -1,
							'category__in' => $postData->term_id,
							'meta_query' => $meta_query,
						);
				
						$query = new WP_Query( $args );
						$postCount = $query->post_count; 
					   
					}
		            

				
		                        if (function_exists('z_taxonomy_image_url')){
		                            $imageUrl = z_taxonomy_image_url($postData->term_id); 
		                        	if($imageUrl==""){
		                            	$imageUrl = esc_url( home_url() ) . "/wp-content/uploads/2021/06/los-angeles-ca-usa-lunar-new-year-celebration-disneyland.jpg";
		                            }
		                        } ?>
				<?php if( $postCount > 0){ ?>
			        <div class="dest_box">
			            <a class="imgBox" href="<?php echo get_term_link($postData); ?>"><img class="expr-img-cls" src="<?php echo $imageUrl; ?>"  alt="<?php //the_title(); ?>"> </a>
			            <div class="textBox">
			                <a href="<?php echo get_term_link($postData); ?>"><?php echo $postData->name; ?></a>
			                <span class="count-cls"><?php echo $postCount; ?> <?php echo ($postCount == 1) ? 'Article' : 'Articles'; ?></span>
			            </div>
			            
			        </div>
		        <?php
		        }
		        endforeach;
		        
		    }
		    ?>
		</div>
		</div>	
		</section>


        <?php
			// Directory (index)
			// -------------------------------------------------
  
			if( count($sub_nav_items['directory']) ): 
        ?>						
        <div class="exp_around light-bg pb_60">
            <div class="container">
				<!-- Section Title -->
				<div class="title-row">
					<h3 class="title-entry">Around <?php echo wp_kses_post($title); ?></h3>
					<!-- <?php //$more_info_link = reset($sub_nav_items['directory']); // the more link ?>
					<a href="<?php //echo esc_url($more_info_link['link']) ?>" class="btn btn-primary btn-xs"><?php //_e('Find More', 'framework'); ?> &nbsp; <i class="fa fa-angle-right"></i></a> -->
				</div>



				<div class="row">
					<?php 
					$limit = isset($settings['number_posts_directory'])? $settings['number_posts_directory'] : 6;
					$placeholder = "<img width='960' height='540' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAJCAMAAAAM9FwAAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////AAAAVcLTfgAAAAF0Uk5TAEDm2GYAAAAOSURBVHjaYmAYpAAgwAAAmQABh704YAAAAABJRU5ErkJggg=='>";
					foreach($sub_nav_items['directory'] as $directory): 
					
					
					     $p_id = $directory['post_ID'];
						 $terms = get_the_terms( $p_id, 'travel-dir-category' );

                        
				 
						foreach( $terms as $term ) :
						 
						  $img_url = z_taxonomy_image_url($term->term_id, 'medium'); 			            
						 
					
				     	endforeach; 
					
					
					
					
					
						// echo "<pre>";
						// print_r(wp_get_attachment_image_src($directory['image']));
						// echo "</pre>";
					if ( !empty($img_url)) {
						$image_url = $img_url;												
					}else{
						$image_url = get_site_url().'/wp-content/plugins/categories-images/assets/images/placeholder.png';
					}
					?>	

						
		                	<div class="col-md-3">
		                        <div class="dest_box">
		                            <a class="imgBox" href="<?php echo esc_url($directory['link']); ?>">
		                            	<img alt="" class="expr-img-cls" src="<?php echo $image_url; ?>">
		                            </a>
		                            <div class="textBox">
		                                <a href="<?php echo esc_url($directory['link']); ?>"><?php echo esc_attr($directory['name']); ?></a>
		                                <span class="count-cls">1 Experience </span>
		                            </div>

		                        </div>
		                    </div>
		              
						<?php 

						$limit--;
						if (!$limit)
							break;
					endforeach; ?>
				</div> <!-- /.row -->

		</div>
	</div>
	<?php endif; ?>


<?php get_footer(); ?>