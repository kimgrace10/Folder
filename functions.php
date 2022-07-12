<?php
function theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    if (is_author()) {
        wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/b10e62c34a.js', '1.0');
    }
    wp_enqueue_style('custom-style', site_url( ) . '/wp-content/themes/parallelus-go-explore_child/child-custom.css');
    wp_enqueue_style('parallelus-go-explore-fonts','https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Poppins:wght@400;500;600&display=block');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function social_sharing() { ?>
    <div class="share_links">
        <a target="_blank"
           href="http://www.facebook.com/share.php?u=<?php echo get_the_permalink(); ?>&title=<?php echo get_the_title(); ?>">
            <svg width="24" height="24" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f"
                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                 class="svg-inline--fa fa-facebook-f fa-w-10 fa-2x">
                <path fill="currentColor"
                      d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
                      class=""></path>
            </svg>
        </a>
        <a target="_blank"
           href="http://twitter.com/home?status=<?php echo get_the_permalink(); ?>+<?php echo get_the_title(); ?>">
            <svg width="24" height="24" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter"
                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                 class="svg-inline--fa fa-twitter fa-w-16 fa-2x">
                <path fill="currentColor"
                      d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                      class=""></path>
            </svg>
        </a>
        <a href="http://pinterest.com/pin/create/button/?url=/node/<?php echo get_the_permalink(); ?>&description=<?php echo get_the_title(); ?>">
            <svg width="24" height="24" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="pinterest-p"
                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                 class="svg-inline--fa fa-pinterest-p fa-w-12 fa-2x">
                <path fill="currentColor"
                      d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"
                      class=""></path>
            </svg>
        </a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>">
            <svg width="24" height="24" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in"
                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                 class="svg-inline--fa fa-linkedin-in fa-w-14 fa-2x">
                <path fill="currentColor"
                      d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"
                      class=""></path>
            </svg>
        </a>

    </div>
<?php }

function register_right_sidebar_single_post() {
    register_sidebar(array(
        'name' => "Right Sidebar Single Post",
        'id' => 'right-sidebar-single-post',
    ));
}
add_action('widgets_init', 'register_right_sidebar_single_post');

class Foo_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'book-you-trip',
            'Book you trip',
            array('description' => 'Book you trip widget', /*'classname' => 'my_widget',*/)
        );
    }

    function widget($args, $instance) {
        $destination = get_field('destination');
        $things_title = get_field('things_title', $destination->ID);
        $things_link = get_field('things_link', $destination->ID);
        $places_title = get_field('places_title', $destination->ID);
        $places_link = get_field('places_link', $destination->ID);
        $packages_title = get_field('packages_title', $destination->ID);
        $package_link = get_field('package_link', $destination->ID);
        ?>
        <?php if ($destination) {
        echo '<div class="book-you-trip">
		            <h3>Book your trip</h3>
		            <ul>';
                    if ($things_link):
                        echo '<li><a target="_blank" href="' . $things_link . '"><i class="book-1"></i>' . $things_title . '</a></li>';
                    endif;
                    if ($places_link):
                        echo '<li><a target="_blank" href="' . $places_link . '"><i class="book-2"></i>' . $places_title . '</a></li>';
                    endif;
                    if ($package_link):
                        echo '<li><a target="_blank" href="' . $package_link . '"><i class="book-3"></i>' . $packages_title . '</a></li>';
                    endif;
                    echo '</ul>
	        </div>';
        }
    }
}

function register_foo_widget() {
    register_widget('Foo_Widget');
}
add_action('widgets_init', 'register_foo_widget');

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

function custom_short_excerpt($excerpt) {
$limit = 135;
$break = '&nbsp;...<br>';

if (strlen($excerpt) > $limit) {
return substr($excerpt, 0, strpos($excerpt, ' ', $limit)) . $break;
}

return $excerpt;
}
add_filter('the_excerpt', 'custom_short_excerpt');

/************** Load More Functions start  ****************************/

function blog_scripts() {
    // Register the script
    wp_register_script( 'custom-script', false, array('jquery'), false, true );

    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( 'load_more_posts' ),
    );
    wp_localize_script( 'custom-script', 'blog', $script_data_array );

    // Enqueued script with localized data.
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'blog_scripts' );


add_action('wp_ajax_load_destination_by_ajax', 'load_destination_by_ajax_callback');
add_action('wp_ajax_nopriv_load_destination_by_ajax', 'load_destination_by_ajax_callback');

function load_destination_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'destination',
        'post_status' => 'publish',
        'posts_per_page' => '8',
        'paged' => $paged,
		'orderby' => array( 'title' => 'ASC','menu_order' => 'ASC', 'parent' => 'ASC' ),
    );
    $blog_posts = new WP_Query( $args );
    ?>

    <?php if ( $blog_posts->have_posts() ) : ?>
        <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
				<?php get_template_part( 'templates/destination-content' ); ?>
			</div>
        <?php endwhile; ?>
        <?php
    endif;

    wp_die();
}




add_action('wp_ajax_load_tag_posts_by_ajax', 'load_tag_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_tag_posts_by_ajax', 'load_tag_posts_by_ajax_callback');

function load_tag_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
	$paged = $_POST['page'];
	$tag = $_POST['tag'];
    $args = array(
        'post_type' => array('post','tribe_events'),
        'tag__in' => $tag,
		'post_status' => 'publish',
		'posts_per_page' => 12,
        'paged' => $paged,
		 
    );
    $b_posts = new WP_Query( $args ); ?>

    <?php if ( $b_posts->have_posts() ) : ?>
        <?php while ( $b_posts->have_posts() ) : $b_posts->the_post(); ?>
           <div class="col-lg-3 col-md-4 col-sm-6">
				<?php get_template_part( 'templates/blog-content' ); ?>
			</div>
        <?php endwhile; ?>
        <?php
    endif;

    wp_die();
}

add_action('wp_ajax_load_cat_posts_by_ajax', 'load_cat_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_cat_posts_by_ajax', 'load_cat_posts_by_ajax_callback');

function load_cat_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
	$paged = $_POST['page'];
	$tag = $_POST['tag'];
    $args = array(
        'post_type' => array('post','tribe_events'),
        'category__in' => $tag,
		'post_status' => 'publish',
		'posts_per_page' => 12,
        'paged' => $paged,
		 
    );
    $b_posts = new WP_Query( $args ); ?>

    <?php if ( $b_posts->have_posts() ) : ?>
        <?php while ( $b_posts->have_posts() ) : $b_posts->the_post(); ?>
           <div class="col-lg-3 col-md-4 col-sm-6">
				<?php get_template_part( 'templates/blog-content' ); ?>
			</div>
        <?php endwhile; ?>
        <?php
    endif;

    wp_die();
}

add_action('wp_ajax_load_blog_posts_by_ajax', 'load_blog_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_blog_posts_by_ajax', 'load_blog_posts_by_ajax_callback');

function load_blog_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
	$paged = $_POST['page'];
    $args = array(
        'post_type' => array('post'),
		'post_status' => 'publish',
		'posts_per_page' => 12,
        'paged' => $paged,
		 
    );
    $b_posts = new WP_Query( $args ); ?>

    <?php if ( $b_posts->have_posts() ) : ?>
        <?php while ( $b_posts->have_posts() ) : $b_posts->the_post(); ?>
           <div class="col-lg-3 col-md-4 col-sm-6">
				<?php get_template_part( 'templates/blog-content' ); ?>
			</div>
        <?php endwhile; ?>
        <?php
    endif;

    wp_die();
}

/* Enable video header support */

add_theme_support( 'custom-header', array(
  'video' => true
));

remove_filter('the_content', 'wptexturize');

remove_filter('the_title', 'wptexturize');

add_filter( 'ppp_nonce_life', 'my_nonce_life' );
function my_nonce_life() {
    return 60 * 60 * 24 * 30; // 30 days
}

//add_action( 'before', 'before_add_action' );
function before_add_action(){ ?>
	
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KW5B69K" height="0" width="0" style="display:none; visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->	

<?php
	}
//add_action('wp_head', 'add_head_js');
function add_head_js(){
?>
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KW5B69K');</script>
	<!-- End Google Tag Manager -->

<?php
}
// add_filter( 'destination_map/pin_images', 'https://wipac.wisc.edu/sites/wipac/files/styles/wipac_people/public/images/Personnel/rasha.jpg?itok=lZTr8PKp' );
// add_filter( 'destination_map/pin_current_dest_img', 'pin_current_dest_img' );

// function pin_current_dest_img(){
// 	return 'https://www.pngfind.com/pngs/m/114-1147878_location-poi-pin-marker-position-red-map-google.png';
// }

function ch_modify_related_posts_args ( $args ) {
  //$venue_id = tribe_get_venue_id();
  $event_loc_category = get_the_terms( get_the_ID(), 'tribe_events_cat' ); 
  if ( $event_loc_category ) {
  	$event_loc_slug = $event_loc_category[0]->slug;
    unset( $args['tax_query'] );
    $args['tax_query'] = [
      //'relation' => 'AND',
      [
        'taxonomy' => 'tribe_events_cat',
        'field' => 'slug',
        'terms' => $event_loc_slug,
      ]
    ];
  }
 
  return $args;
}
add_filter( 'tribe_related_posts_args', 'ch_modify_related_posts_args' );

//add_filter( 'wpseo_json_ld_output', '__return_false' );

add_filter( 'wpseo_schema_event', 'update_event_schema_new_fields' );
function update_event_schema_new_fields( $data ) {
	$ev_statuse = get_field('event_status', get_the_ID());
	if($ev_statuse=='postponed'){
		$event_status = 'https://schema.org/EventPostponed';
	}elseif($ev_statuse=='canceled'){
		$event_status = 'https://schema.org/EventCancelled';
	}else{
		$event_status = 'https://schema.org/EventScheduled';
	}
    $data['eventStatus'] = $event_status;
    //var_dump($data);
    $performer = get_field('performer', get_the_ID());
    if(!empty($performer)){
      $data['performer'][] = array(
            '@type' => 'PerformingGroup',
            'name' => $performer,
      );
    }
    return $data;
}
function cevent_admin_footer_function() {?>
<script>
   jQuery('#chevent_status input').val(jQuery('#tribe-events-status-status').val());
	jQuery('#tribe-events-status-status').on('change', function() {
	 jQuery('#chevent_status input').val(jQuery(this).val());
	});
</script>	
<?php }
add_action('admin_footer', 'cevent_admin_footer_function');

function blog_remove_canonical() {
    if ( is_home() ) {
        add_filter( 'wpseo_canonical', '__return_false',  10, 1 );
    }
}
add_action('wp', 'blog_remove_canonical');

add_filter( 'rest_endpoints', 'disable_custom_rest_endpoints' );
function disable_custom_rest_endpoints( $endpoints ) {
    $routes = array( '/wp/v2/users', '/wp/v2/users/(?P<id>[\d]+)' );

    foreach ( $routes as $route ) {
        if ( empty( $endpoints[ $route ] ) ) {
            continue;
        }

        foreach ( $endpoints[ $route ] as $i => $handlers ) {
            if ( is_array( $handlers ) && isset( $handlers['methods'] ) &&
                'GET' === $handlers['methods'] ) {
                unset( $endpoints[ $route ][ $i ] );
            }
        }
    }

    return $endpoints;
}

/************** End Load More Functions start  ****************************/