<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up to the start of the content output.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if (function_exists( 'rf_html_cover_class' )) : rf_html_cover_class(); endif; ?>>
<head>
	
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="robots" content="index,follow">
		
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url(get_options_data('options-page', 'favorites-icon')); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url(get_options_data('options-page', 'mobile-bookmark')); ?>">
    <?php wp_head(); ?>
    <script async defer src="https://www.tripster.com/scripts/widget/1.0/widget.js"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/webfonts/fonts.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/child-custom.css" />
    <!-- GetYourGuide Analytics -->

<script async defer src="https://widget.getyourguide.com/dist/pa.umd.production.min.js" data-gyg-partner-id="HRW75UR"></script>
</head>

<body <?php body_class(); ?>>
    <?php do_action( 'before' ); ?>

    <div id="top"></div>

    <!-- Navigation (main menu)
    ================================================== -->
    <div class="navbar-wrapper">
        <header class="navbar navbar-default navbar-fixed-top" id="MainMenu" role="navigation">
            <div class="navbar-extra-top clearfix">
                <div class="navbar container-fluid">
                    <?php 
                        if (class_exists('wp_bootstrap_navwalker')) {
                            // Main navbar (left)
                            wp_nav_menu( array(
                                'menu'              => 'top-left',
                                'theme_location'    => 'top-left',
                                'container'         => false,
                                'menu_class'        => 'nav navbar-nav navbar-left',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker()
                            ));
                        } else {
                            _e('Please make sure the Bootstrap Navigation extension is active. Go to "Runway > Extensions" to activate.', 'framework');
                        }
                    ?>
                    <div class="navbar-top-right">
                        
                        <?php
                        $nav_right = get_options_data('options-page', 'nav-top-right-source');
                        if ($nav_right !== 'none') { 
                            ?>
                            <ul class="nav navbar-nav navbar-right">
                                
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $icon_sym = get_options_data('options-page', 'nav-top-right-icon-'.$i);
                                    $icon_url = get_options_data('options-page', 'nav-top-right-icon-'.$i.'-url');

                                    if ($icon_sym !== 'none') {
                                        echo '<li><a href="'.esc_url($icon_url).'" target="_blank"><i class="fa fa-'.esc_attr($icon_sym).' fa-fw"></i></a></li>';
                                    }
                                } ?>
                            </ul>
                            <?php
                        }

                        // Search in Navigation
                        $nav_search = get_options_data('options-page', 'nav-search');
                        if ($nav_search !== 'hide') { ?>
                            <form class="navbar-form navbar-right navbar-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="<?php echo esc_attr__( 'Search...', 'framework' ); ?>" value="" name="s" title="<?php _e( 'Search for:', 'framework' ); ?>">
                                </div>
                                <button type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
                            </form>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid collapse_md" id="navbar-main-container">
                <div class="navbar-header">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="navbar-brand">
                        <?php 
                        $logo_image = get_options_data('options-page', 'logo', '');
                        $has_logo = false;
                        if (!empty($logo_image)) {
                            echo '<img src="'.$logo_image.'" alt="'.esc_attr(get_bloginfo('name', 'display')).'">';
                            $has_logo = true;
                        }
                        $brand_title = get_options_data('options-page', 'brand-title', '');
                        if (!empty($brand_title)) {
                            if ($has_logo) {
                                echo ' &nbsp;';
                            }
                            echo apply_filters('get_qtranslate_rw', esc_attr($brand_title));
                        }
                        ?>
                    </a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                
				<nav class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav cart-nav">
                        <li class="searchBox"><a class="searchBtn"><i class="fa fa-search"></i></a>
                        <form id="search_form" class="navbar-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="<?php echo esc_attr__( 'Search Travel Guide', 'framework' ); ?>" value="" name="s" title="<?php _e( 'Search for:', 'framework' ); ?>">
                                </div>
                                <button type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
                            </form>
                        </li>
                        <li class="bookTrip"><a target="_blank" href="https://www.tripster.com/">Book a Trip</a></li>
                        <li class="wishlist_item"><a href="#"><i class="fa fa-heart"></i>My Favs (4)</a></li>
                        <li class="cart_item"><a href="#"><i class="fa fa-shopping-cart"></i>Cart (2)</a></li>
                    </ul>
					<?php 
						if (class_exists('wp_bootstrap_navwalker')) {				
							// Main navbar (right)
							wp_nav_menu( array(
								'menu'              => 'primary',
								'theme_location'    => 'primary',
								'container'         => false,
								'menu_class'        => 'nav navbar-nav mainMenu',
								'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								'walker'            => new wp_bootstrap_navwalker()
							));
						} else {
							_e('Please make sure the Bootstrap Navigation extension is active. Go to "Runway > Extensions" to activate.', 'framework');
						}
					?>
                    <div class="btnBox"><a class="btn signupBtn" href="#">Sign up</a></div>
				</nav>
				
<!--                 <nav class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav cart-nav">
                        <li class="searchBox"><a class="searchBtn"><i class="fa fa-search"></i></a>
                        <form id="search_form" class="navbar-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="<?php echo esc_attr__( 'Search Travel Guide', 'framework' ); ?>" value="" name="s" title="<?php _e( 'Search for:', 'framework' ); ?>">
                                </div>
                                <button type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
                            </form>
                        </li>
                        <li><a href="#"><i class="fa fa-heart"></i>My Favs (4)</a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i>Cart (2)</a></li>
                    </ul>
                    <?php 
                        if (class_exists('wp_bootstrap_navwalker')) {               
                            // Main navbar (right)
                            wp_nav_menu( array(
                                'menu'              => 'primary',
                                'theme_location'    => 'primary',
                                'container'         => false,
                                'menu_class'        => 'nav navbar-nav mainMenu',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker()
                            ));
                        } else {
                            _e('Please make sure the Bootstrap Navigation extension is active. Go to "Runway > Extensions" to activate.', 'framework');
                        }
                    ?>
                    <div class="btnBox"><a class="btn signupBtn" href="#">Sign up</a></div>
                </nav> -->
            </div><!-- /.container-fluid -->
        </header>
    </div><!-- /.navbar-wrapper -->
<!-- Variable Declaration -->
<?php 
$evnt_post = get_queried_object();
$event_desinations = get_the_terms($evnt_post->ID, 'tribe_events_cat'); 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $evnt_post->ID ), 'single-post-thumbnail' ); 
$title = $evnt_post->post_title;
?>
<!-- End Variable Declaration -->


<section class="hero <?php echo rf_default_header_class(); ?>" <?php rf_header_styles() ?>>


    <div class="bg-overlay test" <?php if ($image) { echo 'style="background-image:linear-gradient(0deg, rgba(0,0,0,0.4) 0%, rgba(238,238,255,0) 100%), url( '. $image[0] .' )!important; background-repeat: no-repeat background-position: center center; background-size: cover; height: 100%; overflow: hidden;"';  } // for overlay gradient, but no click/drag for maps ?>>
        <div class="container" <?php rf_header_container_styles() ?> >

            <div class="intro-wrap">
            <?php

            $content = apply_filters('theme_header_subtitle', '');
            // echo '<pre>'; print_r($evnt_post); echo '</pre>';
            // Clean up

            // Output the title and content text
            if (!empty($title)) {
                ?>
                <h1 class="intro-title"><?php echo wp_kses_post($title); ?></h1>
                    <ul class="breadcrumbs">
                         
                        <li class="no-arrow"><i class="icon fa fa-map-marker"></i></li>
                        <?php 
                        foreach ($event_desinations as $destination) {
                            if($destination->name !== 'Upcoming Events' && $destination->parent == 0 ){
                                $parent_dest_url = get_site_url().'/destination/'.$destination->slug;
                                echo '<li><a href="' . $parent_dest_url.'">'. $destination->name . '</a></li>';
                            }
                        }

                        foreach ($event_desinations as $destination) {
                            if($destination->name !== 'Upcoming Events' && $destination->parent !== 0 ){
                                echo '<li><a href="'.$parent_dest_url.'/'.$destination->slug.'">'. $destination->name . '</a></li>';
                            }
                        }
                         ?>
                    </ul>
                <?php if ( (is_page() || is_single()) && !is_singular('destination') ): ?>
                    <?php $bread_obj = get_field('destination');
                    $parent_post = get_post($bread_obj->post_parent);
                    if ($bread_obj && $bread_obj->ID != get_page_by_path('none', OBJECT, 'destination')->ID) { ?>
                    <ul class="breadcrumbs">
                        <li class="no-arrow"><i class="icon fa fa-map-marker"></i></li>
                        <li><a href="<?php echo get_permalink($parent_post->ID);?>"><?php echo  $parent_post->post_title;?></a></li>
                        <li><a href="<?php echo get_permalink($bread_obj->ID);?>"><?php echo  $bread_obj->post_title;?></a></li>
                    </ul>
                <?php }
                    endif; ?>
                <?php
            }

            do_action('after_header_title'); // make accessible to add custom content after title

            if (!empty($content) && $content !== '<p></p>' ) {
                ?>
                <div class="intro-text">
                    <?php echo wp_kses_post($content); ?>
                </div>
                <?php echo $search_html; ?>
                <?php
            }

            do_action('after_header_intro_text'); // make accessible to add custom content after intro text

            ?>
            </div>
        </div>
    </div>
</section>