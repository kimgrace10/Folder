<?php
/**
 * Destination Sub-Navigation
 */
?>

<!-- Sub Navigation
================================================== -->
<div class="sub-nav">
	<div class="navbar navbar-inverse affix-top" id="SubMenu">
		<div class="container">
			<!-- Sub Nav Title -->
			<div class="navbar-header">
				<a href="javascript:void(0)" class="navbar-brand scrollTop"> <i class="fa fa-fw fa-map-marker"></i><span><?php //destination_the_title(); ?></span></a>
				<input type="hidden" id="destination-the-title" value="<?php destination_the_title(); ?>" />
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-sub">
					<span class="sr-only"><?php _e('Toggle navigation', 'framework' ) ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<nav class="navbar-collapse collapse" id="navbar-sub">
				<ul class="nav navbar-nav navbar-left">
					<?php destination_sub_navigation(); ?>
					

					
					<?php 
					$dest_ID = get_the_destination_ID();

					// echo '<li><a href="#">Testing'.$dest_ID.'</a></li>';
					$things_title = get_field('things_title', $dest_ID);
					$things_link = get_field('things_link', $dest_ID);
					$places_title = get_field('places_title', $dest_ID);
					$places_link = get_field('places_link', $dest_ID);
					$packages_title = get_field('packages_title', $dest_ID);
					$package_link = get_field('package_link', $dest_ID);

					$queried_object = get_queried_object();
         	$term_id = (isset($queried_object->term_id))?$queried_object->term_id:"";

         	$post = get_post( $dest_ID, OBJECT);
/*
					if ( $post->post_parent > 0 ) { //if destination is child
						if (empty($things_title) || empty($things_link)) {
							$things_title = get_field('things_title', $post->post_parent);
							$things_link = get_field('things_link', $post->post_parent);
						}
						
						if (empty($places_title) || empty($places_link)) {
							$places_title = get_field('places_title', $post->post_parent);
							$places_link = get_field('places_link', $post->post_parent);
						}
						
						if (empty($packages_title) || empty($package_link)) {
							$packages_title = get_field('packages_title', $post->post_parent);
							$package_link = get_field('package_link', $post->post_parent);
						}			
					}
                
*/

					
					if(!empty($things_link)){
						echo '<li><a target="_blank" href="'.$things_link.'">Things to Do</a></li>';
					}
				/**	else{
						 if(isset($term_id) && !empty($term_id)){
						 	$term_vals = get_term_meta($term_id,'things_link',true);
						    echo '<li><a href="'.$term_vals.'">Things to Do</a></li>';
						 }
						 else{
						 	echo '<li><a href="'.$things_link.'">Things to Do</a></li>';
						 } 
						 	
						 	
					}
					*/
					
					if(!empty($places_link)){
						echo '<li><a target="_blank" href="'.$places_link.'">Places to Stay</a></li>';
					}
					
					/**else{

						if(isset($term_id) && !empty($term_id)){
						 	$term_vals = get_term_meta($term_id,'places_link',true);
						    echo '<li><a href="'.$term_vals.'">Places to Stay</a></li>';
						 }
						 else{
						 	echo '<li><a href="'.$places_link.'">Places to Stay</a></li>';
						 } 
						
					}  */

					if(!empty($package_link)){
						echo '<li><a target="_blank" href="'.$package_link.'">Package Offers</a></li>';
					}
					/**else{
						if(isset($term_id) && !empty($term_id)){
						 	$term_vals = get_term_meta($term_id,'package_link',true);
						    echo '<li><a href="'.$term_vals.'">Package Offers</a></li>';
						 }
						 else{
						 	echo '<li><a href="'.$package_link.'">Package Offers</a></li>';
						 }
						
					}
					
					*/
					?>
					
					
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<!-- <li><a href="#"><i class="fa fa-fw fa-location-arrow"></i> Map</a></li> -->
					<!-- <li><a href="#" id="HeaderMapToggle"><i class="fa fa-fw fa-location-arrow"></i> Map</a></li> -->
					<?php if (function_exists('show_destination_map') && show_destination_map( get_the_ID())) { ?>
						<li><a href="#" id="HeaderMapToggle" data-toggle="tooltip" title="<?php _e('Toggle Map', 'framework') ?>"><i class="dest-icon-map-w-pin"></i>&nbsp; <?php _e('Map', 'framework') ?></a></li>
					<?php } ?>
				</ul>
			</nav>
		</div> <!-- /.container -->
	</div>
</div><!-- /.sub-nav -->



<script >
  
 var selText = jQuery('#navbar-sub ul.nav.navbar-nav.navbar-left li:first a').html();
  if(selText === 'Places'){
	  //jQuery('#navbar-sub .nav.navbar-nav.navbar-left li:first-child a').css('display','none');
      jQuery('#navbar-sub ul.nav.navbar-nav.navbar-left li:first a').hide();
  }
</script>