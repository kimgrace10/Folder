<?php
/**
 * Places for destinations
 */

$place_box_class = 'place-box card new-place-box';
$style = '';
$placeholder = "<img width='960' height='540' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAJCAMAAAAM9FwAAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRF////AAAAVcLTfgAAAAF0Uk5TAEDm2GYAAAAOSURBVHjaYmAYpAAgwAAAmQABh704YAAAAABJRU5ErkJggg=='>";

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


<div class="places-card">
	<article class="<?php echo esc_attr($place_box_class); ?> place_box">
		<a href="<?php the_permalink(); ?>" class="imgBox place-link">
			<div class="entry-thumbnail" style="<?php echo esc_attr($style) ?>">
				<?php echo $placeholder; // escaped above ?>
			</div>
			
		</a>
        <a class="entry-title" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
        <?php 
        $total = 20;
        echo '<p> '.$total.' Experiences</p>';
        // $post_args = array(
        //             'post_type'      => 'post',
        //             'meta_key' => 'destination',
        //             'meta_value' => get_post()->ID
        //         );

        //             // The Query
        //             $the_query = new WP_Query( $post_args ); //new WP_Query( $args );
        //             if (isset($the_query)): 

        //                 $total = $the_query->found_posts;
        //                 if($total>1):
        //                     echo '<p> '.$total.' Articles</p>';
        //                 else:
        //                     echo '<p> '.$total.' Article</p>';
        //                 endif;

        //             endif;
                    ?>
			
	</article>
		
</div>
