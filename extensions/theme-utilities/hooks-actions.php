<?php
/**
 * Actions to apply and output theme behavior and content on the
 * template files and other WP specific areas. 
 */

#-----------------------------------------------------------------
# Breadcrumbs in Destinations header
#-----------------------------------------------------------------

if ( ! function_exists( 'rf_destination_header_breadcrumbs' ) ) :
function rf_destination_header_breadcrumbs() {
	global $post;

	// requires the Travel Destinations plugin
	if ( !function_exists('get_the_destination_ID') ) {
		return;
	}

	$queryID = get_queried_object_id();

	if ($queryID) {
		$id = get_the_destination_ID( $queryID );
		$crumbs = '';

		if ( isset($id) && !empty($id) ) {

			// get destination data
			$destination = get_hero_data( $id );

			// Add the breadcrumbs
			$breadcrumbs = (isset($destination['breadcrumb'])) ? $destination['breadcrumb'] : '';

			// breadcrumb trail
			if (!empty($breadcrumbs)) {
				foreach ($breadcrumbs as $crumb) {
					if (isset($crumb['title']) && isset($crumb['link'])) {
						$crumbs .= '<li><a href="'.esc_url($crumb['link']).'">'.esc_html($crumb['title']).'</a></li>';
					}
				}
			}
			// current destination
			if (empty($breadcrumbs) || !is_singular('destination') ) { // is_singular(array( 'destination', 'guide-lists' ))
				$crumbs .= '<li><a href="'. get_permalink($id) .'">'. destination_get_the_title() .'</a></li>';
			}

			if (!empty($crumbs) && !is_single('none')) {
				?>
				<ul class="breadcrumbs">
					<li class="no-arrow"><i class="icon fa fa-map-marker"></i></li>
					<?php 
					// breadcrumb trail
					echo  $crumbs;
					?>
					
				</ul>
				<?php
			}
		}
	}
}
endif; 
add_action('after_header_intro_text', 'rf_destination_header_breadcrumbs');