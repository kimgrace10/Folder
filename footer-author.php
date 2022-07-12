<?php
/**
 * The template for displaying the footer.
 */
?>
<section class="newsletter-cls pb_60">
<div class="container">
<div class="tnp tnp-subscription">
<h3>Subscribe to our Newsletter</h3>
<div id="mc_embed_signup">
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
			</div>
</div>
</div>
</section>
<section><div class="container bt_2"><br></div></section>
<?php $users = get_users(array( 'role__in' => array( 'author') )); ?>
<?php if(!empty($users)) : ?>

        <div class="join_writer pt_60">
            <div class="container">
                <h2 class="sec_title">Join Our Tripster Travel Writers</h2>
                <div class="title_text">
                    <p>If you're a travel enthusiast, whether as a local expert or tourist, and you love sharing your experiences and insight, Tripster is looking for you. As a Tripster content contributor, you will join our community of writers who help fellow travelers make the most of their weekend getaways and dream vacations.</p>
                </div>
                <div class="writers_slider owl-carousel">
                <?php foreach ($users as $user) : 
                $user_data = get_userdata($user->ID);
                $user_fn = $user_data->user_firstname;
                $user_ln = $user_data->user_lastname;

                $user_full_name = $user_fn.' '.$user_ln[0] . '.'; ?>
                       <div class="item author-id-<?php echo $user->ID; ?>">
                            <div class="img"><img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="" /></div>
                            <div class="text">

                                <?php 
                                 $ps = get_posts( array('author'=>$user->ID,'fields'=>'ids','numberposts' => -1) );
                                 $count = count($ps);
                                ?>


                                <h4><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo $user_full_name; ?></a></h4>
                                <p>(<?php echo $count; ?> posts)</p>
                            </div>
                       </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>

<?php endif; ?>
<div class="more-link" style="margin-bottom: 40px;"><a href="<?php the_permalink(28162); ?>" class="btn btn-primary btn-xs">Want to write for Tripster?</a></div>
<!-- <div class="want-to-write text-center cs-want-to-write"><a href="<?php the_permalink(28162); ?>" class="cs-link-btn">Want to write for Tripster?</a></div> -->
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
                                <a href="#">Login to Your Account</a>
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
                                <a href="/about/tripster">About Tripster</a>
                            </li>
                            <li>
                                <a href="/about/people">Team Tripster</a>
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
                                <a href="/partner/travel-affiliates">Become an Affiliate</a>
                            </li>
                            <li>
                                <a href="https://admin.tripster.com/account/loginAffiliate">Affilliate Login</a>
                            </li>
                            <li>
                                <a href="/partner/travel-suppliers">Become a Travel Supplier</a>
                            </li>
                            <li>
                                <a href="https://admin.tripster.com/account/Login">Supplier Login</a>
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
                                <a href="/about/purchasing-policy">Purchase Policy</a>
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
                <p>&copy; 2001 - <?php echo date("Y") ?> Tripster. All Rights Reserved. Use of this website constitutes acceptance of Tripster's <a href="/about/terms">Terms of Use</a> and <a href="/about/privacy-policy">Privacy Policy</a>.</p>
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
                                <a target="_blank" href="https://www.facebook.com/tripster/"><i class="fa fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com/tripster/"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/tripster/"><i class="fa fa-instagram"></i></a>
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
                        <p class=" text-center mb-0">Proudly selling <span class="flag"><img draggable="false" role="img" class="emoji" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f1fa-1f1f8.svg"></span> for 20 years.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.footer-bottom -->

    </footer>

	<?php endif; // !is_page_template( 'templates/cover.php' ) ?>

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
})
jQuery('.owl-carousel-2').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
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
})
</script>	
<script type="application/javascript" src="https://www.tripster.com/scripts/widget/1.0/create-tripster-account.js"></script>
<div id="create-tripster-account"></div>
</body>
</html>