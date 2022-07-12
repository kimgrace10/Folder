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

<div class="destination_box">
<article class="<?php echo esc_attr($place_box_class); ?>">
	<a href="<?php the_permalink(); ?>" class="place-link">
		<div class="entry-thumbnail" style="<?php echo esc_attr($style) ?>">
			<?php echo $placeholder; // escaped above ?>
		</div>
		
	</a>
    <a class="entry-title mb-3rem" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</article>
</div>