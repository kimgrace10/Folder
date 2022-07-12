<?php
/**
 * Places for destinations
 */

 
$place_box_class = 'place-box card new-place-box';
$style = '';
$placeholder = "<img width='960' height='540' loading='lazy' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAJCAMAAAAM9FwAAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////AAAAVcLTfgAAAAF0Uk5TAEDm2GYAAAAOSURBVHjaYmAYpAAgwAAAmQABh704YAAAAABJRU5ErkJggg=='>";

if ( has_post_thumbnail() ) {
	// $image = get_the_post_thumbnail( $post->ID, 'place' );
	// Background image
	$image_ID = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $image_ID, 'place' );
	//$style = 'background-image: url('. esc_url($image[0]) .')';
	$style = 'background-image: url('. esc_url(isset($image[0]) ? $image[0] : '') .')';
} else {
	$place_box_class .= ' no-image';
}
	

?>

 <?php 
	    global $post;
        $id = get_the_ID();


		$child_ids = array();
		$dest_childrens = get_children( array( 'post_parent' => $dest->ID), OBJECT );
		
		
		$meta_query = array();
		$meta_query['relation'] = 'OR';
	
		
		foreach ($dest_childrens as $child) {
			$meta_query[] = array(
				'key'   => 'destination',
				'value' => $child->ID,
			);			
		}

        if ( $post->post_parent ) {
			// This is a subpage						
		    
            $args = array(
				'post_type'  => 'post',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key'     => 'destination',
						'value'   => $post->ID,
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
				'meta_query' => $meta_query,
			);
	
			$query = new WP_Query( $args );
			$postCount = $query->post_count; 
		   
		}          
        ?>
       

      
<div class="places-card">
	<article class="<?php echo esc_attr($place_box_class); ?> place_box">
		<a href="<?php the_permalink(); ?>" class="imgBox place-link">
			<div class="entry-thumbnail" style="<?php echo esc_attr($style) ?>">
				<?php echo $placeholder; // escaped above ?>
			</div>
			
		</a>
        <a class="entry-title" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>

       
        <?php
		if( $postCount>0 ){
	       echo '<p> '.$postCount.' Articles</p>';
		}else{
		   echo '<p> 0 Articles</p>';
		}
        ?>

	
		
			
	</article>
		
</div>