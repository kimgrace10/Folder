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
                    <div class="btnBox"><a class="btn signupBtn create-tripster-modal-btn" href="#">Sign up</a></div>
                </nav>
            </div><!-- /.container-fluid -->
        </header>
    </div><!-- /.navbar-wrapper -->



    <?php

    // Layout Manager Support - start layout here...
    // ----------------------------------------------------------------------
    /**
     * We're also using the output_layout action to add a theme specific HTML container
     * for all template files that do not explicitly state they have pre-defined elements
     * the applying content containers.
     */
    // do_action('output_layout','start');  

    ?>