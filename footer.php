<?php
//get_header();
?>

<?php
/**
 * The template for displaying the footer.
 */

function eventQuery($catids){

    global $wpdb;
          
    $qry = "SELECT SQL_CALC_FOUND_ROWS DISTINCT wp_posts.* FROM wp_posts  LEFT JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) LEFT JOIN wp_postmeta as tribe_event_end_date ON ( wp_posts.ID = tribe_event_end_date.post_id AND tribe_event_end_date.meta_key = '_EventEndDate' )  WHERE 1=1  AND ( 
  wp_term_relationships.term_taxonomy_id IN ($catids)
) AND wp_posts.post_type = 'tribe_events' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'acf-disabled' OR wp_posts.post_status = 'tribe-ea-success' OR wp_posts.post_status = 'tribe-ea-failed' OR wp_posts.post_status = 'tribe-ea-schedule' OR wp_posts.post_status = 'tribe-ea-pending' OR wp_posts.post_status = 'tribe-ea-draft' OR wp_posts.post_status = 'private') GROUP BY wp_posts.ID ORDER BY wp_posts.post_date DESC LIMIT 0, 8";

return $wpdb->get_results($qry);

}

?>

<?php if(is_home()){ ?>
<div class="insta_feed">
<?php 
$home_shortcode = get_field('insert_shortcode', 'option');
echo do_shortcode($home_shortcode); ?>
</div>
<?php }if(is_singular( 'destination' )){ ?>
<div class="insta_feed">
<?php 
global $wp_query;
$post_id = $wp_query->post->ID;
$shortcode_from_destination = get_field('insert_shortcode',$post_id);
if(empty($shortcode_from_destination)){
	$hash_gen = get_post_field( 'post_name', $post_id );
	$hash_gen = str_replace("-", "", $hash_gen);
	$shortcode_from_destination = '[instagram-feed user=tripster type="hashtag" hashtag="#'.$hash_gen.'"]';
}
echo do_shortcode($shortcode_from_destination); ?>
</div>  
<?php } ?>
<section class="newsletter-cls pb_60 no-flex pt-5" style="background:#ebebeb; padding-top:70px; margin:40px 0px 0px">
	<div class="container">
		<div class="tnp tnp-subscription row">
			<div class="col-md-6 col-sm-12">
			<h3>Subscribe to our Newsletter</h3>
			</div>
			<div class="col-md-6 col-sm-12">
			<?php echo do_shortcode('[mc4wp_form id="40802"]');?>
			<!--<div id="mc_embed_signup">
				
				<form action="https://tripster.us6.list-manage.com/subscribe/post?u=ee8bf5b18a7146137b75e9fdb&amp;id=a1a2556fe4" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					<div id="mc_embed_signup_scroll">
						<div class="mc-field-group">
							<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span></label>
							<input type="email" placeholder="Enter your email address" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						</div>
						<div class="clear">
							<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
						</div>
					</div>
				</form>
			</div> -->
			</div>
			
		</div>
	</div>
</section>

<?php


wp_reset_postdata();
function childList($termId){
    $termArray = array();

    $taxonomies = array( 
    'taxonomy' => 'category'
);

$args = array(
   // 'parent'         => $parent_term_id,
     'child_of'      => $termId
); 



$terms = get_terms($taxonomies, $args);
if (sizeof($terms)>0)
{
foreach ( $terms as $term ) {
    $termArray[] = $term->term_id;

    }

    }
    return $termArray;
}







    $cat_id = "";
     $cat_id = get_queried_object()->term_id;
     if(!empty($cat_id) && get_queried_object()->taxonomy == "category"){

       $termId = childList($cat_id);
       $count = count($termId);
       if($count > 0)
         $cat_id = $termId;
     else{
        $cat_id = array();
        $catid = get_queried_object()->term_id;
        $cat_id[] = $catid;
     }
      
       

     }
     else if ( is_single() ) {

    global $post;
    $cat_id = array();
$category_detail=get_the_category( $post->ID );
foreach ($category_detail as $key => $value) {
       $cat_id[] = $value->term_id;
}



 }
	else{
		 $cat_id = '6706';
	}





    global $post;
 
    $exposts = get_posts( array(
        'posts_per_page' => 20,
      
        'category__in'=> $cat_id,
		'post_status'    => 'publish'
    ) );


if(!empty($cat_id) && get_queried_object()->taxonomy != "category" && get_post_type() != "post"){



$post_type = get_post_type();

$args22 = array(
'post_type' => $post_type,
'tax_query' => array(
    array(
    'taxonomy' => get_queried_object()->taxonomy,
    'field' => 'term_id',
    'terms' => get_queried_object()->term_id
     )
  )
);


$query = new WP_Query( $args22 );

$exposts = $query->posts;

}



if (get_post_type() != "post" && get_post_type() != "page") {


$post_id = get_the_ID();


global $wpdb;

      
   $post_type = get_post_type();


if($post_type == "destination"){
    $cat_id = array();
    $terms = wp_get_post_terms($post_id, "travel-category");
foreach ($terms as $termid) {  
$cat_id[] = $termid->term_id;
} 
$args22 = array(
'post_type' => $post_type,
'tax_query' => array(
    array(
    'taxonomy' => "travel-category",
    'field' => 'term_id',
    'terms' => $cat_id
     )
  )
);

$query = new WP_Query( $args22 );
$exposts = $query->posts;

}

if($post_type == "tribe_events"){
    $cat_id = array();
    $terms = wp_get_post_terms($post_id, "tribe_events_cat");
foreach ($terms as $termid) {  
$cat_id[] = $termid->term_id;
} 


$args22_1 = array(
'post_type' => $post_type,
'tax_query' => array(
    array(
    'taxonomy' => "tribe_events_cat",
    'field' => 'term_id',
    'terms' => $cat_id
     )
  )
);


$catids = implode(",",$cat_id);

$exposts  = eventQuery($catids);


}






}


    // echo "<pre>"; print_r($exposts);  echo "</pre>";
?>	

	<?php do_action('output_layout','end'); // Layout Manager - End Layout ?>


	<?php if ( !is_page_template( 'templates/cover.php' ) ) : ?>

	<div id="footer">
		<?php

		// The content source set in theme options
		$content_1    = get_options_data('options-page', 'footer-content-1');
		$content_2    = get_options_data('options-page', 'footer-content-2');
		$column_size  = get_options_data('options-page', 'footer-column-size');

		// Section styles
		$styles = '';
		$container_style['background-color'] = get_options_data('options-page', 'footer-bg-color');
		$container_style['background-image'] = get_options_data('options-page', 'footer-bg-image');
		foreach ($container_style as $attribute => $style) {
			if ( isset($style) && !empty($style) && $style !== '#') {
				if ($attribute == 'background-image') {
					$style = 'url('. $style .')';
				}
				$styles .= $attribute .':'. $style .';';
			}
		}
		$styles = (!empty($styles)) ? 'style="'.esc_attr($styles).'"' : '';

		// Column widths
		$column_size = (!empty($column_size)) ? explode(':', $column_size) : array('4','8');
		$class_left = 'col-lg-'.$column_size[0];
		$class_right = 'col-lg-'.$column_size[1];

		// Content check
		$content_left  = (!empty($content_1) && $content_1 !== 'disabled') ? $content_1 : '';
		$content_right = (!empty($content_2) && $content_2 !== 'disabled') ? $content_2 : '';
		$footer_content = (!empty($content_left) || !empty($content_right)) ? true : false;

		if ( $footer_content ) { ?>

			<section class="top-footer regular" <?php echo  $styles; // escaped above ?>>
				<div class="container">
					<div class="row">

						<?php if (!empty($content_left)) : ?>
						<div class="<?php echo esc_attr($class_left); ?>">
							<div class="footer-content-left">
								<?php the_static_block($content_left); ?>
							</div>
						</div>
						<?php endif; ?>

						<?php if (!empty($content_right)) : ?>
						<div class="<?php echo esc_attr($class_right); ?>">
							<div class="footer-content-right">
								<?php the_static_block($content_right); ?>
							</div>
						</div>
						<?php endif; ?>

					</div>
				</div>
			</section>

		<?php } // $footer_content



		// The content source set in theme options
		$sub_content  = get_options_data('options-page', 'sub-footer-content');

		// Section styles
		$sub_styles = '';
		$sub_container_style['background-color'] = get_options_data('options-page', 'sub-footer-bg-color');
		$sub_container_style['background-image'] = get_options_data('options-page', 'sub-footer-bg-image');
		foreach ($sub_container_style as $attribute => $style) {
			if ( isset($style) && !empty($style) && $style !== '#') {
				if ($attribute == 'background-image') {
					$style = 'url('. $style .')';
				}
				$sub_styles .= $attribute .':'. $style .';';
			}
		}
		$sub_styles = (!empty($sub_styles)) ? 'style="'. esc_attr($sub_styles) .'"' : '';

		// Content check
		$has_sub_content = (!empty($sub_content) && $sub_content !== 'disabled') ? true : false;

		if ( $has_sub_content ) {  ?>

			<section class="sub-footer" <?php echo $sub_styles; // escaped above ?>>
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<?php
							if (!empty($sub_content)) :
								the_static_block($sub_content);
							endif;
							?>
						</div>
					</div>
				</div>
			</section>

		<?php } ?>

	</div>

    <footer class="site-footer">

        <div class="footer-menu">
            <div class="container">
                <div class="row">
                    <div class="footer-links col-7 col-sm-5 col-md-3 col-lg-2">
                        <h4>
                            Travelers
                        </h4>
                        <ul class="nav flex-column">
                            <li>
                                <a class="create-tripster-modal-btn" href="#">Become a Tripster</a>
                            </li>
                            <li>
                                <a href="/account/login">Login to Your Account</a>
                            </li>
                            <li>
                                <a href="/about/faqs">FAQs - Find Answers</a>
                            </li>
                            <li>
                                <a href="/about/contact-us">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-5 col-sm-4 col-md-3 col-lg-2">
                        <h4>
                            Company
                        </h4>
                        <ul class="nav flex-column">
                            <li>
                                <a href="/about">About Tripster</a>
                            </li>
                            <li>
                                <a href="/people">Team Tripster</a>
                            </li>
                            <li>
                                <a href="/destinations">Our Destinations</a>
                            </li>
                            <li>
                                <a href="/travelguide/">Travel Guide</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links trust-marks col-sm-3 col-md-12 col-lg-2 order-md-last">
                        <div class="trusted-site logo">
                            <a href="">
                                <div class="trustedsite-trustmark loaded" data-type="202" data-width="85" data-height="35" tabindex="0" style="width: 85px; height: 35px; display: inline-block; background-image: url(&quot;https://cdn.ywxi.net/meter/tripster.com/202.svg?ts=1602636627247&amp;l=en-US&quot;); background-size: contain; background-position: center top; background-repeat: no-repeat; cursor: pointer;"></div>
                            </a>
                        </div>
                        <div class="feefo logo">
                            <a href="https://www.feefo.com/en-US/reviews/tripster?displayFeedbackType=SERVICE&timeFrame=YEAR">
                                <img src="https://content.tripster.com/content/images/feefo/feefo-platinum-vertical-2020.png" class="img-fluid" alt="Feefo Platinum Award logo">
                            </a>
                        </div>
                        <div class="bbb logo">
                            <a href="https://www.bbb.org/us/mo/branson/profile/online-travel-agency/tripster-0734-19209/customer-reviews">
                                <img src="https://content.tripster.com/content/images/bbb_rating_aplus.png" class="img-fluid" alt="Better Business Bureau logo">
                            </a>
                        </div>
                    </div>
                    <div class="footer-links col-7 col-sm-5 col-md-3 col-lg-2">
                        <h4>
                            Partners
                        </h4>
                        <ul class="nav flex-column">
                            <li>
                                <a href="/travel-affiliates">Become an Affiliate</a>
                            </li>
                            <li>
                                <a href="https://admin.tripster.com/account/loginAffiliate">Affilliate Login</a>
                            </li>
                            <li>
                                <a href="/travel-suppliers">Become a Travel Supplier</a>
                            </li>
                            <li>
                                <a href="https://admin.tripster.com/account/login">Supplier Login</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-links col-5 col-sm-4 col-md-3 col-lg-2">
                        <h4>
                            Resources
                        </h4>
                        <ul class="nav flex-column">
                            <li>
                                <a href="/about/reviews">Tripster Reviews</a>
                            </li>
                            <li>
                                <a href="/purchasing-policy">Purchase Policy</a>
                            </li>
                            <li>
                                <a href="/sitemap">Sitemap</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.footer-menu -->

        <div class="footer-copyright footer-links mb-1">
            <div class="container">
                <p>&copy; 2001 - <?php echo date("Y") ?> Tripster. All Rights Reserved. Use of this website constitutes acceptance of Tripster's <a href="/terms">Terms of Use</a> and <a href="/privacy-policy">Privacy Policy</a>.</p>
            </div>
        </div>
        <!-- /.footer-copyright -->

        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-lg-4 order-first">
                        <div class="footer-logo text-center text-sm-left">
                            <img src="<?php echo get_field('logo_footer', 'option') ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                   <div class="col-sm-6 col-lg-4">
                        <ul class="nav social-icons">
                            <li>
                                <a target="_blank" href="https://www.facebook.com/Tripster"><i class="fa fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com/Tripster/"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/Tripster/"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.linkedin.com/company/tripstertravel/"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.pinterest.com/tripstertravel/"><i class="fa fa-pinterest-p"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.youtube.com/user/ReserveDirectTravel/"><i class="fa  fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 order-lg-first">
                        <p class=" text-center mb-0">Proudly selling
							<span class="flag">
								<img alt="American owned and operated" draggable="false" role="img" class="emoji" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f1fa-1f1f8.svg">
							</span> for 20 years.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.footer-bottom -->

    </footer>

	<?php endif; // !is_page_template( 'templates/cover.php' ) ?>
<!-- <script src="https://www.tripster.com/travelguide/wp-content/plugins/destinations/assets/js/maps.js"></script> -->
<?php wp_footer(); ?>
<script>
    
      
    
const $menu = jQuery('#search_form');

jQuery(document).mouseup(e => {
   if (!$menu.is(e.target) 
   && $menu.has(e.target).length === 0) 
   {
     $menu.hide(200);
  }
 });

jQuery('.searchBtn').on('click', () => {
  $menu.show(200);
});

    
    

jQuery('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});
    
jQuery('.owl-carousel-2').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});
jQuery( document ).ready(function() {
jQuery('#SubMenu .navbar-toggle').on('click', function(){
    jQuery('#SubMenu.navbar .navbar-collapse').toggleClass('show');
});	
if (!jQuery('.tribe-events-event-meta.secondary').length) {
    //console.log('3col');
    jQuery('.tribe-events-single-section.tribe-events-event-meta.primary').css('width', '100%');
}	
});	
jQuery(window).load(function() {	
setTimeout(function(){ 
	jQuery('.tripster-widget').each(function() {
		height_p = jQuery(this).find('p').outerHeight();
		if(height_p==null){height_p = 0;}
		height_strong = jQuery(this).find('strong').outerHeight();
		if(height_strong==null){height_strong = 0;}
		height_widget = jQuery(this).outerHeight();
		if(height_widget==null){height_widget = 0;}
		total_height = (+height_p) + (+height_strong) + (+height_widget);
		//min_height = parseInt(jQuery(this).css("min-height"))
		if(total_height>height_widget){
		//if(min_height!=0){
		   jQuery(this).css('min-height', total_height+'px');
		}
		console.log(total_height);
	});
}, 2800);
});
</script>	
<script type="application/javascript" src="https://www.tripster.com/scripts/widget/1.0/create-tripster-account.js"></script>
<div id="create-tripster-account"></div>
</body>
</html>