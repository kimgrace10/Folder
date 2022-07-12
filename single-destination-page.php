<?php
/**
 * Destination Sub Page
 *
 * The template for displaying destination pages.
 *
 */

// This template includes built-in layout containers.
add_filter('theme_template_has_layout', function(){ return true; });

// Destination ID
$dest_ID = get_the_destination_ID();

$dest_post = get_post($dest_ID); 
$dest_slug = $dest_post->post_name;


$args = array(
    'post_type' => 'tribe_events',
    'tax_query' => array(
        array(
            'taxonomy' => 'tribe_events_cat',
            'field' => 'slug',
            'terms' => $dest_slug
        )
     )
);

$query = new WP_Query( $args );

$total = $query->found_posts;

$hide_events = false;

if ($total == 0) {
    $hide_events = true;
    echo "<style>.dropdown .dropdown-menu li:first-child{display: none;}</style>";
}





get_header(); ?>

		<?php get_template_part( 'templates/parts/destinations-sub-nav' ); ?>

		<section class="dest_single main">
			<div class="container">
				<div class="row">
				<?php

				// Start the WP loop
				while ( have_posts() ) : the_post(); ?>

					<div class="col-lg-9">
	
							<div class="dest_sideNav page-navigation">
                                <label class="sideToggle" data-toggle="collapse" data-target="#detailNav"><?php the_title() ?></label>
								<ul id="detailNav" class="collapse nav nav-stacked">
									<?php
									$info_pages = get_destination_pages( $dest_ID );

									if( count($info_pages) ):
										foreach($info_pages as $info_page): ?>
                                            <?php if ($hide_events == true  && $info_page['title'] == "Events"): ?>

                                            <?php else: ?>
                                                <li <?php echo ($post->ID == $info_page['id'])? 'class="active"' : ''; ?>><a href="<?php echo esc_url($info_page['link']); ?>"><?php echo esc_attr($info_page['title']); ?></a></li>

                                            <?php endif ?>

                                            
											
											<?php 
										endforeach;
									endif; ?>
                                    <?php //destination_sub_navigation(); ?>
								</ul>
							</div><!-- /.page-navigation -->

							<div class="dest_content">
								<header class="page-header">
									
                                    <!-- <h1 class="page-title"><?php the_title() ?></h1> -->
									<?php 
									$intro = get_destination_intro();
									if ( !empty($intro) ) {
										?>
										<p class="lead"><?php echo wp_kses_post($intro); ?></p>
										<?php
									} ?>
								</header>

								<?php 
								// Thumbnail 
								//if ( has_post_thumbnail() ) : ?>
									<!-- <p class="entry-thumbnail"> -->
										<?php //the_post_thumbnail(); ?>
									<!-- </p>.entry-thumbnail -->
									<?php
								//endif; // has_post_thumbnail ?>
								<div class="entry-content"><?php the_content(); ?></div>
							</div><!-- /.page-content -->

					</div>
					<?php if(get_the_title()!='Events'){?>
					<?php // Sidebar ?>
 					<div class="col-lg-3 dest_sidebar">
						<?php //get_sidebar(); ?>
					
						<?php echo $name = get_field('sidebar_widgets', $dest_ID); ?>
						<?php the_field('text', $dest_ID); ?>	 
						
<!--
                        <div class="row">
                            <div class="col-lg-12 col-md-4 col-sm-6">
                                <div class="exp_box">
                                    <a class="wishListBtn"><i class="fa fa-heart"></i></a>
                                    <a href="#" class="imgBox">
                                        <img src="//content.tripster.com/media/product/gallery/539/Disney_World__Theme_Parks_(30342).jpg" alt="" />
                                    </a>
                                    <div class="textBox">
                                        <span class="location">Location, City</span>
                                        <a href="#" class="title_link">Attraction with a long long title</a>
                                        <div class="exp_meta">
                                            <div class="ratings mb">
                                                <span class="ml-sm">275 Reviews</span>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star-half-o gold"></i>
                                            </div>
                                            <div class="priceBox">
                                                <span class="old-price"><small>From: </small><del>$29.00</del></span>
                                                <strong class="new-price">$25.00</strong>
                                            </div>
                                        </div>
                                        <div class="btnBox">
                                            <a href="#" class="btn bookBtn">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-4 col-sm-6">
                                <div class="exp_box">
                                    <a class="wishListBtn"><i class="fa fa-heart"></i></a>
                                    <a href="#" class="imgBox">
                                        <img src="//content.tripster.com/media/product/gallery/539/Disney_World__Theme_Parks_(30342).jpg" alt="" />
                                    </a>
                                    <div class="textBox">
                                        <span class="location">Location, City</span>
                                        <a href="#" class="title_link">Attraction with a long long title</a>
                                        <div class="exp_meta">
                                            <div class="ratings mb">
                                                <span class="ml-sm">275 Reviews</span>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star-half-o gold"></i>
                                            </div>
                                            <div class="priceBox">
                                                <span class="old-price"><small>From: </small><del>$29.00</del></span>
                                                <strong class="new-price">$25.00</strong>
                                            </div>
                                        </div>
                                        <div class="btnBox">
                                            <a href="#" class="btn bookBtn">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-4 col-sm-6">
                                <div class="exp_box">
                                    <a class="wishListBtn"><i class="fa fa-heart"></i></a>
                                    <a href="#" class="imgBox">
                                        <img src="//content.tripster.com/media/product/gallery/539/Disney_World__Theme_Parks_(30342).jpg" alt="" />
                                    </a>
                                    <div class="textBox">
                                        <span class="location">Location, City</span>
                                        <a href="#" class="title_link">Attraction with a long long title</a>
                                        <div class="exp_meta">
                                            <div class="ratings mb">
                                                <span class="ml-sm">275 Reviews</span>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star gold"></i>
                                                <i class="fa fa-star-half-o gold"></i>
                                            </div>
                                            <div class="priceBox">
                                                <span class="old-price"><small>From: </small><del>$29.00</del></span>
                                                <strong class="new-price">$25.00</strong>
                                            </div>
                                        </div>
                                        <div class="btnBox">
                                            <a href="#" class="btn bookBtn">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->
					</div><!-- / sidebar -->
				<?php }?>
				<?php endwhile; // end of the loop. ?>

				</div>  <!-- /.row -->
					<?php if(get_the_title()=='Events'){?>
					<!--JS sidebar-->
						<div class="col-lg-3 dest_sidebar"> 
						<?php //get_sidebar(); ?>
					
						<?php echo $name = get_field('sidebar_widgets', $dest_ID); ?>
						<?php the_field('text', $dest_ID); ?>	
						</div>
					<!--JS sidebar-->
					<?php }?>
			</div>
		</section>

<?php get_footer(); ?>