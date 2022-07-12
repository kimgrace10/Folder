<?php
/**
 * Guide List Page
 *
 * The template for displaying guiide list pages.
 *
 */

// This template includes built-in layout containers.
add_filter('theme_template_has_layout', function(){ return true; });

// Destination ID
$dest = get_the_destination_post();



get_header(); ?>

	<?php get_template_part( 'templates/parts/destinations-sub-nav' ); ?>

	<!-- Main Section
	================================================== -->
	<section class="main travel_dr_Single">
		<div class="container">
			<div class="row">
				<?php

				// Start the loop
				while ( have_posts() ) : the_post();

					// List of meta details
					$show_details = '';
					$details = get_guide_lists_details( $post->ID );
					foreach($details as $key => $detail) {
						$show_details .= '<h5>'. html_entity_decode($key) .'</h5>';
						
						 
						
						
						
						
						if($key == 'Phone'){
							
							$show_details .= '<p><a href="tel:'.$detail.'">'. html_entity_decode($detail) .'</a></p>';
							
						}elseif($key == 'Address'){
							
							$show_details .= '<p><a href="http://maps.google.com/?q='.$detail.'" target="_blank">'. html_entity_decode($detail) .'</a></p>';
							
						}elseif(filter_var($detail, FILTER_VALIDATE_URL)) {
							 
							$show_details .= '<p><a href="'.$detail.'" target="_blank">'. html_entity_decode($detail) .'</a></p>';
							
						}else{
							$show_details .= '<p>'. html_entity_decode($detail) .'</p>';
						}
						
						
						
						
						// Old code below for value
						//$show_details .= '<p>'. html_entity_decode($detail) .'</p>';
					}

					?>
					<div class="col-lg-9">

						<h1 class="page-title"><?php the_title() ?></h1>
						<?php $breadcrumbs = get_guide_lists_taxonomy( $post->ID, $dest->post_name ); ?>
						<ul class="breadcrumbs local-path">
							<li><a href="<?php echo esc_url(get_permalink($dest->ID)); ?>"><?php echo apply_filters('get_qtranslate_rw', esc_attr($dest->post_title)); ?></a></li>
							<li class="no-arrow"><a href="<?php echo esc_url($breadcrumbs['link']); ?>"><?php echo wp_kses_post($breadcrumbs['name']); ?></a></li>
							<li class="no-arrow"> </li>
							<?php

							// Get all the ratings data for this item
							$rating_data = get_guide_lists_rating( $post->ID );
							$ratings = array();

							if (isset($rating_data['enabled']) && !empty($rating_data['enabled'])) {
								foreach ($rating_data['enabled'] as $type => $enabled) {

									if ($type == 'menu_order' || $enabled !== 'true')
										continue;

									$key = str_replace('rating_types_', '', $type);
									if (isset($rating_data['settings'][$key])) {
										$ratings[$key] = $rating_data['settings'][$key];
										$ratings[$key]['value'] = (isset($rating_data[$type]) && !empty($rating_data[$type]))? $rating_data[$type] : 0;
									}
								}
							}

							// Show the rating graphics
							if (!empty($ratings)) {

								foreach ($ratings as $key => $data) {
									?>
									<li class="no-arrow">
										<span class="rating <?php echo 'rating-'. esc_attr($key); ?>">
											<div class="ratebox " data-id="<?php echo '-'. esc_attr($key); ?>" data-rating="<?php echo esc_attr($data['value']); ?>" data-state="rated"></div>
											<input type="hidden" class="rate-class"  value="<?php echo esc_attr($data['class']); ?>">
											<input type="hidden" class="rate-color"  value="<?php echo esc_attr($data['color']); ?>">
											<input type="hidden" class="rating-is-front"  value="true">
										</span>
									</li>
									<?php
								}
							}

							 ?>
						</ul>

						<p class="lead"><?php echo get_destination_intro(); ?></p>

						<div class="row">
							<div class="col-sm-12 <?php if (!empty($show_details)) { echo 'col-md-12'; } ?>">
								<figure class="entry-thumbnail">
									<?php if (has_post_thumbnail()) {
										echo '<p>'. get_the_post_thumbnail() .'</p>';
									} ?>
								</figure>

								<?php
								// First instance (for small screens)
								if (!empty($show_details)) {
									?>
<!-- 									<div class="hidden-lg">
										<aside class="snapshot">
											<?php echo wp_kses_post($show_details); ?>
										</aside>
									</div> -->
									<?php
								}
								?>

								<div class="entry-content">
									<?php the_content(); ?>
								</div>
							</div>

							<?php
							// Second instance of meta detail (for column on right in larger screens)
							if (!empty($show_details)) {
								?>
								<div class="visible-lg-blocks col-md-5">
									<aside class="snapshot">
										<?php echo wp_kses_post($show_details); ?>
										
									</aside>
								</div>
								<?php
							}
							?>

						</div>

					</div>

					<div class="col-lg-3 dir_sidebar">
						<?php // get_sidebar();
						$get_page_widget = get_field('sidebar_widgets', $dest->ID);
						if($get_page_widget!=''){
							echo do_shortcode($get_page_widget);
						}else{
							get_sidebar(); 
						}?>
					</div><!-- /sidebar -->

				<?php

				endwhile; // end of the loop.

				?>

			</div><!-- /.row -->
		</div>
	</section>

<?php get_footer(); ?>