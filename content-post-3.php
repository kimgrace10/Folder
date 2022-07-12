<?php
/**
 * Alternate post content: Post Layout Style 3
 *
 * Called from: index.php
 */
global $post;
	$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-landscape' );
	//echo $feat_image;
	$post_date = get_the_date( 'F Y' ); 
    $author_id=$post->post_author;
	$author_fn = get_the_author_meta('first_name' , $author_id );
	$author_ln = get_the_author_meta('last_name' , $author_id );

	$author_full_name = $author_fn.' '.$author_ln[0] . '.';
	?>
	 
	
	
					<div class="item">
						<div class="featured-img-contain">
							<a href="<?php the_permalink(); ?>">
								<img class="featured-img-cls" src="<?php echo $feat_image[0]; ?>" class="featured-img-cls" alt="<?php the_title(); ?>" width="800" height="600">
							</a>
						</div>
						<div class="author-div">
                        	<div class="auth-info">
							<?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 ); ?>
							<span class="auth-name-cls"><a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo $author_full_name; ?></a> </span>
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