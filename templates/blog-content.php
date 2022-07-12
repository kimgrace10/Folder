<?php global $post;  
	$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-landscape');
	$feat_image = $feat_image[0];
	//echo $feat_image;
	$post_date = get_the_date( 'F Y' ); 
    $author_id =$post->post_author;  
	$author_fn = get_the_author_meta('first_name' , $author_id );
	$author_ln = get_the_author_meta('last_name' , $author_id );

	$author_full_name = $author_fn.' '.$author_ln[0] . '.';
	?>

<div class="cs-t-item">
	<a class="featured-img-contain" href="<?php the_permalink(); ?>"><img class="featured-img-cls" src="<?php echo $feat_image; ?>" class="featured-img-cls" alt="<?php the_title(); ?>" width="360" height="200"></a>
		<div class="author-div">
			<div class="auth-info">
			<?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 ); ?>
				<span class="auth-name-cls"><a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo $author_full_name; ?></a></span>
			<span class="date-cls"><?php echo $post_date; ?></span>
		</div>
		</div>
		
		<div class="title-cls">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<span class="read-more-cls">
				<a href="<?php the_permalink(); ?>">Read More</a>
			</span>
		</div> 
</div>