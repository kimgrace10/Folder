<?php
/**
 * Template part: Home Page Section - Featured Destinations
 */

// The Featured Destinations set in theme options
$destinations = (array) get_options_data('home-page', 'home-section-1-source-destinations');
if (!isset($destinations[0]) || $destinations[0] == 'all' || $destinations[0] == 'random' ) {
	$destinations = '';
}

// Section title
$section_title = get_options_data('home-page', 'home-section-1-title');
$section_more  = get_options_data('home-page', 'home-section-1-more-text');

// Items to show
$item_count = get_options_data('home-page', 'home-section-1-destination-count');
$item_count = ( $item_count == 'auto' ) ? -1 : $item_count; // default

// Use random
$random = get_options_data('home-page', 'home-section-1-source-random'); 
$random = ( $random == 'true' ) ? true : false;

// section styles
$styles = '';
$container_style['background-color'] = get_options_data('home-page', 'home-section-1-bg-color');
$container_style['background-image'] = get_options_data('home-page', 'home-section-1-bg-image');
foreach ($container_style as $attribute => $style) {
	if ( isset($style) && !empty($style) && $style !== '#') {
		if ($attribute == 'background-image') {
			$style = 'url('. $style .')';
		}
		$styles .= $attribute .':'. $style .';';
	}
}
$styles = (!empty($styles)) ? 'style="'.esc_attr($styles).'"' : '';


// Destinations
// -------------------------------------------------

// The Query
$args = array(
	'post_type' => 'destination',
	'posts_per_page' => (!empty($item_count)) ? $item_count : 4, // could set a max here if needed
);
if (!empty($destinations)) {
	// $args['posts_per_page'] = -1;
	$args['post__in'] = $destinations;
	// $item_count = count($destinations);
}
if ($random) {
	// remove_all_filters('posts_orderby');
	$args['orderby'] = 'rand';
}
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) { 


?>

<section class="featured-destinations pb_60" <?php echo  $styles; // escaped above ?>>
	<div class="container">
		<div class="cards overlap">

			<!-- Section Title -->
			<div class="title-row">
				<h3 class="title-entry"><?php esc_attr_e($section_title) ?></h3>
			  <?php if (!empty($section_more)) : ?>
<!--				<a href="<?php echo esc_url(get_post_type_archive_link( 'destination' )); ?>" class="btn btn-primary btn-xs"><?php esc_attr_e($section_more) ?></a>-->
                <a href="<?php echo esc_url(get_post_type_archive_link( 'destination' )); ?>" class="btn btn-primary btn-xs">View all Destinations</a>
			  <?php endif; ?>
			</div>

			<!-- Cards Row -->
			<div class="row">

			<?php

			// Specify the container column class to use based on # of destinations
			$colClass = '';
			switch ($item_count) {
				case 1:
					$colClass = 'col-sm-8 col-sm-push-2 col-md-6 col-md-push-3';
					break;
				case 2:
					$colClass = 'col-lg-4 col-lg-push-2 col-sm-6'; 
					break;
				case 3:
				case 6:
				case 9:
					$colClass = 'col-sm-4'; 
					break;
				case 5:
					$colClass = 'col-sm-2 col-sm-push-1'; 
					break;
				case 8:
				case 12:
				case 16:
				default:
					$colClass = 'col-md-3 col-sm-6'; // default (4)
					break;
			}

			// for each post...
			while ( $the_query->have_posts() ) : $the_query->the_post();

				?>
				<div class="<?php echo esc_attr($colClass) ?>">
					<article class="card">
						<?php 
						// image CSS string
						$image_style = '';

						// Get the image
						if ( has_post_thumbnail() ) : ?>
							<?php 
							$image_ID = get_post_thumbnail_id( $post->ID );
							$image = wp_get_attachment_image_src( $image_ID, 'blog-landscape' );
							$image_style = ( isset( $image[0] ) ) ? 'background-image: url('.$image[0].')' : ''; // the URL
						endif; ?>
						<a href="<?php the_permalink(); ?>" class="featured-image" style="<?php echo esc_attr($image_style) ?>"><div class="featured-img-inner"></div></a>
						<div class="card-details">
							<h4 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<div class="meta-details clearfix">
								<?php /*
								<div class="rating rating-star">
									<i class="fa fa-star icon highlighted"></i>
									<i class="fa fa-star icon highlighted"></i>
									<i class="fa fa-star icon highlighted"></i>
									<i class="fa fa-star icon highlighted"></i>
									<i class="fa fa-star icon"></i>
								</div>
								*/ ?>
								<ul class="hierarchy">
									<li class="symbol"><i class="fa fa-map-marker"></i></li>
									<?php 
									// Get breadcrumb trail
									$hierarchy = get_post_ancestors($post);
									if (!empty($hierarchy)) {
										$path = array_reverse($hierarchy);
										for ($x = 0; $x < count($path) && $x < 2; $x++) {
											$id = $path[$x];
											echo '<li><a href="'.esc_url(get_permalink($id)).'">'.get_the_title($id).'</a></li>'; 
										}
									} else {
										// Use current destination if no parents
										echo '<li><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></li>';
									}
									?>
								</ul>
							</div>
						</div>
					</article>
				</div>
				
			<?php endwhile; ?>

			</div> <!-- /.row -->
		</div>
	</div>
</section>

<?php
} // End if have_posts()

/* Restore original Post Data */
wp_reset_postdata();

?>
<section class="featured-article-cls">
<div class="container">
<div class="title-row">
<h3 class="title-entry">Featured Articles</h3></div>
	<div class="owl-carousel owl-theme">
	 <?php
		global $post;
	 
		$myposts = get_posts( array(
			'posts_per_page' => -1,
			'offset'         => 1,
			'category'       => 2812,
			'post_status'    => 'publish'
		) );
	 
		if ( $myposts ) {
			foreach ( $myposts as $post ) : 
				setup_postdata( $post ); ?>
				
				
		<?php
	$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ,'medium' );
	//echo $feat_image;
	$post_date = get_the_date( 'F Y' ); 

	?>
	<?php $author_id=$post->post_author; ?>
	<?php //echo '<pre>'; print_r(get_the_author_meta( 'url' , $author_id )); echo '</pre>'; the_author_meta( 'user_nicename' , $author_id ); ?>		
					<div class="item">
						<div class="featured-img-contain">
							<a href="<?php the_permalink(); ?>">
								<img class="featured-img-cls" width="800" height="600" src="<?php echo $feat_image; ?>" class="featured-img-cls" alt="<?php the_title(); ?>"></a></div>
						<div class="author-div">
                        	<div class="auth-info">
							<?php echo get_avatar( get_the_author_meta( 'ID' ) , 50 ); ?>
							<span class="auth-name-cls"><a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php the_author_meta( 'user_nicename' , $author_id ); ?></a></span>
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
				
			<?php
			endforeach;
			wp_reset_postdata();
		}
		?>
	</div>
	<div class="more-link"><a href="<?php echo site_url('/blog'); ?>" class="btn btn-primary btn-xs">View our Travel Guide</a></div>
</div>	
</section>	

<section class="upcoming-event-cls pb_60">
<div class="container">
<div class="title-row">
<h3 class="title-entry">Upcoming Events </h3></div>
	<div class="owl-carousel owl-theme">
	 <?php
		global $post;
	 
		$myposts = get_posts( array(
			'posts_per_page' => -1,
			'offset'         => 1,
// 			'start_date'     => 'now',
			'post_type'        => 'tribe_events',
             'tax_query' => array(
								array(
									'taxonomy' => 'tribe_events_cat',
									'field' => 'term_id',
									'terms'    => 6703
								),
						   ),
			'post_status'    => 'publish'
		) );
	 //echo "<pre>"; print_r($myposts);	echo "</pre>"; die;
		if ( $myposts ) {
			foreach ( $myposts as $post ) : 
				setup_postdata( $post ); ?>
				
				
		<?php
	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	//echo "daga".$feat_image; die;
	$post_date = get_the_date( 'dS M Y' ); 
$meta = get_post_meta($post->ID);
//echo "<pre>"; print_r($meta);	echo "</pre>";
$key_1_values = get_post_meta( $post->ID, '_EventVenueID' );
//echo "<pre>"; print_r();	echo "</pre>";
$metaId  = $key_1_values[0];

?>
	
	
					<div class="item">
						<div class="featured-img-contain">
							<a href="<?php the_permalink(); ?>">
								<img class="event-img-cls" src="<?php echo $feat_image; ?>" class="featured-img-cls" alt="<?php the_title(); ?>"></a></div> 
						<div class="event-date-cls"><?php echo $post_date; ?></div>
						
						<div class="event-title-cls">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <div class="venu-cls"><?php echo esc_html( get_the_title($metaId) ); ?></div>
						<span class="learn-more-cls">
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
	<div class="more-link"><a href="/travelguide/events/" class="btn btn-primary btn-xs">View more Events</a></div>
</div>	
</section>

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

     <?php if( !empty(get_field('article_page_title')) ){ ?>
       <div class="experiences_column light-bg pb_60">
            <div class="container popular_experiences">
                <div class="title-row">
<h3 class="title-entry">Experience More</h3>
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


<section class="more-ex-cls">
<div class="container">
<div class="title-row">
<h3 class="title-entry">Experience More Demo</h3></div>
<div class="exp-more-grid">
 <?php
 $categories=get_categories(
    array( 'parent' => 2782 )
);
echo "<pre>"; print_r($categories); echo "</pre>";  die;
    global $post;
 
    $exposts = get_posts( array(
        'posts_per_page' => 8,
        'offset'         => 1,
        'category'       => 2782,
		'post_status'    => 'publish'
    ) );
 
    if ( $categories ) {
        foreach ( $categories as $postData ) : 
             ?>
                        <?php 
                        $args = array(
                          'cat' => $postData->term_id,
                          'post_type' => 'post'
                        );
                        $the_query = new WP_Query( $args );
                        $postCount = $the_query->found_posts;
                        if (function_exists('z_taxonomy_image_url')){
                            $imageUrl = z_taxonomy_image_url($postData->term_id); 
                        	if($imageUrl==""){
                            	$imageUrl = esc_url( home_url() ) . "/wp-content/uploads/2021/06/los-angeles-ca-usa-lunar-new-year-celebration-disneyland.jpg";
                            }
                        } ?>
		<?php echo '<pre>'; print_r($postData); echo '</pre>'; ?>
        <div class="dest_box">
            <a class="imgBox" href="<?php echo get_term_link($postData); ?>"><img class="expr-img-cls" src="<?php echo $imageUrl; ?>"  alt="<?php the_title(); ?>"> </a>
            <div class="textBox">
                <a href="<?php echo get_term_link($postData); ?>"><?php echo $postData->name; ?></a>
                <span class="count-cls"><?php echo $postCount; ?> Articles</span>
            </div>
            
        </div>
        <?php
        endforeach;
        
    }
    ?>
</div>
</div>	
</section>