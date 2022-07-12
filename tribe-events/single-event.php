<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $post;

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();
$event_desinations = get_the_terms($event_id, 'tribe_events_cat'); 
foreach ($event_desinations as $destination) {
       if($destination->name !== 'Upcoming Events' && $destination->parent == 0 ){
          $cat_name = $destination->name;
          $parent_dest_url = get_site_url().'/destination/'.$destination->slug;
          $dest_url = $parent_dest_url;
       }

    }
    
 foreach ($event_desinations as $destination) {
    if($destination->name !== 'Upcoming Events' && $destination->parent !== 0 ){
        $cat_name = $destination->name;
          $dest_url = $dest_url.'/'.$destination->slug;
    }
}	 
	

					
?>


<?php 
	// ============================ Custom NEXT and PREVIOUS CODE start ===========================================
	if(get_post_type( $post )=="tribe_events")
{

    $terms = array_shift(get_the_terms($post->ID, 'tribe_events_cat'));


    // get_posts in same custom taxonomy
    $postlist_args = array(
        'posts_per_page'  => -1,
        'orderby'         => 'ID title',
        'order'           => 'ASC',
        'post_type'       => 'tribe_events',
        $terms->taxonomy  => $terms->slug
    );

    $postlist = get_posts( $postlist_args );

    // get ids of posts retrieved from get_posts
    $ids = array();
    foreach ($postlist as $thepost) {
        $ids[] = $thepost->ID;
    }
	// print_r($ids);
    // get and echo previous and next post in the same taxonomy
    
  	$thisindex  = array_search($post->ID, $ids);
    $previd     = $ids[$thisindex-1];
    $nextid     = $ids[$thisindex+1];

}else{

    // Your Default Previous/Next Links in single.php file
}

// ============================ Custom NEXT and PREVIOUS CODE end ===========================================
?>



 
<div id="tribe-events-content" class="tribe-events-single">

	<p class="tribe-events-back">
		<?php 
			$events_url = str_replace('destination', 'information', $dest_url).'/events';
			$all_events_url = $events_url.'/events';
		?>
		<a href="<?php echo $events_url; ?>"> All <?php echo $cat_name; ?> Events</a>
	</p>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<?php //the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>

	<div class="tribe-events-schedule tribe-clearfix">
		<?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
		<?php endif; ?>
	</div>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%') ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>') ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-header -->

	
	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<!-- <li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%') ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>') ?></li> -->
				
				
		<li class="tribe-events-nav-previous"><a href="<?php echo get_permalink($nextid); ?>"><span>«</span> <?php  echo get_the_title($nextid); ?></a></li>
		<li class="tribe-events-nav-next"><a href="<?php echo get_permalink($previd); ?>"><?php  echo get_the_title($previd); ?> <span>»</span></a></li>
				
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->