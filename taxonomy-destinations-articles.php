<?php
/**
 * Destination Blog Posts
 *
 */

// This template includes built-in layout containers.
add_filter('theme_template_has_layout', function(){ return true; });

// Check for content sections
$sub_nav_items = destination_sub_navigation( false ); // only return
// Destination ID
$dest_ID = get_the_destination_ID();
$article_text = get_field('article_page_title',$dest_ID);
$dest_title = get_the_title( $dest_ID );
get_header(); ?>

	<?php get_template_part( 'templates/parts/destinations-sub-nav' ); ?>

	<section class="main dest_single dest_article">
		<div class="container">
			<div class="row">

				<div class="col-sm-9">
					<div class="dest_sideNav page-navigation">
								<ul class="nav nav-stacked">
									<?php
									$info_pages = get_destination_pages( $dest_ID );
									if( count($info_pages) ):
										foreach($info_pages as $info_page): ?>
											<li <?php echo ($post->ID == $info_page['id'])? 'class="active"' : ''; ?>><a href="<?php echo esc_url($info_page['link']); ?>"><?php echo esc_attr($info_page['title']); ?></a></li>
											<?php 
										endforeach;
									endif; ?>
                                    <?php destination_sub_navigation(); ?>
								</ul>
							</div><!-- /.page-navigation -->
					<section class="blog-posts-alt">
						<div class="dest-title">
							<!--<h1>Articles</h1>-->
							<?php if(!empty($article_text)){ 
							//echo '<h2>'.$article_text.'</h2>';
							  } ?>
							<!--<h2>Discover <?= $dest_title ?>'s Vibrant Attraction</h2>-->
						</div>

					<?php

					// The Query
					$the_query = $sub_nav_items['articles']; //new WP_Query( $args );
					$total = $the_query->found_posts;
                    $p = 1;
					 
					// The Loop
					if ( $the_query != null && $the_query->have_posts() ) {

						// for each post...
						while ( $the_query->have_posts() ) : $the_query->the_post();
                             
							get_template_part( 'content-post-4', get_post_format() );                       
                        if($p==10){ break; }
                        $p++;
						endwhile;


						// Paging function
						if (function_exists( 'rf_get_pagination' )) :
							//rf_get_pagination($the_query);
						endif;

					} else {
						get_template_part( 'no-results', 'destination-blog' );
					}

					/* Restore original Post Data */
					wp_reset_postdata();
					 
					 

					?>
					
					<?php 
					
					// get id for destination term.
					
					$term_array = $the_query->query["tax_query"][0];
					
					$term_id = $term_array["terms"][0];
					$link = get_category_link($term_id);
					
					?>
					
					<?php if($total>12){ ?>
					 <div class="more-link aaa"><a href="<?php echo $link; ?>" class="btn btn-primary btn-xs">View All <?= $dest_title; ?> Articles</a></div> 
					<?php } ?>
					</section>
				</div>

				<?php // Sidebar ?>
				<div class="col-sm-3">
					<?php //get_sidebar();
					$get_page_widget = get_field('sidebar_widgets', $dest_ID);
					if($get_page_widget!=''){
						echo do_shortcode($get_page_widget);
					}else{
						get_sidebar(); 
					}
					?>
				</div><!-- / sidebar -->

			</div><!-- /.row -->
		</div>
	</section>

<?php get_footer(); ?>