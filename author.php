<?php
/**
 * The main template file. (loads blog posts)
 */
//obal $post; echo $post->ID;
$postStyle = get_options_data('options-page', 'blog-layout-style'); // update to check theme option
$postStyle = ( !empty($postStyle) ) ? '-'.$postStyle : ''; // set to layout style #
$user = get_user_by('slug', get_query_var('author_name'));
$user_id = $user->ID;
$img_banner = get_field( 'banner_author' ,'user_'.$user_id);
$is_banner = get_field( 'is_banner' ,'user_'.$user_id);
$select_banner = get_field( 'select_banner' ,'user_'.$user_id);
$intro_text = get_field( 'author_intro_text', 'user_'.$user_id );
$args = [
    'post_status' => 'publish',
    'author' => $user_id,
	'order' => 'DESC',
	'orderby' => 'ID'
];



$recent_posts = wp_get_recent_posts([
    'numberposts' => 1,
    'post_status' => 'publish',
    'post_author' => $user_id
]);
// echo '<pre>';
// print_r($recent_posts);
// echo '</pre>';
$posts = new WP_Query($args);

// print_r($posts );
// echo $posts['posts'][0]->ID; 



$recent_post_image = get_the_post_thumbnail_url( $posts->posts[0]->ID, 'full' );
$top_banner = $recent_post_image;
if($is_banner and $is_banner[0] == 'yes'){
    if($select_banner and $select_banner == 'banner_img'){
        $top_banner = $img_banner['url'];
    }
}
$avatar = get_avatar_url($user_id, ['size' => 215]);
$title = get_field( 'author_title' ,'user_'.$user_id);
$organization = get_field( 'author_organization' ,'user_'.$user_id);
$twitter = get_the_author_meta( 'twitter', $user_id );
$linkedin = get_the_author_meta( 'linkedin', $user_id );
$facebook = get_the_author_meta( 'facebook', $user_id );
$instagram = get_the_author_meta( 'instagram', $user_id );
$pinterest = get_the_author_meta( 'pinterest', $user_id );
$youtube = get_the_author_meta( 'youtube', $user_id );
$desc = get_the_author_meta( 'description', $user_id );
$intro_text = get_the_author_meta( 'author_intro_text', $user_id );

get_header('author'); ?>
<div class="banner-wrap" style="background-image: url(<?= $top_banner; ?>);">
    <div class="banner author-banner">
        <?php //if($is_banner and $is_banner[0] == 'yes'):?>
        
        <div class="container innerColumn">
            <div class="intro-wrap">
                <h1 class="intro-title"><?= $user->display_name; ?>&nbsp;<?= $user->user_lastname; ?></h1>
                <div class="subtitle intro-subtitle"><?= $title; ?> - <?= $organization; ?></div>
            </div>
        </div>
        <?php //endif ?>
    </div>
</div>
<?php if(!$is_banner or $is_banner[0] != 'yes'):?>
<?php endif; ?>
<section class="main container"
         <?php if(!$is_banner or $is_banner[0] != 'yes'):?>
         
        <?php endif; ?>
>
    <div class="author-info-wrap">
        <div class="author-info-block">
            <div class="avatar-block">
                <img src="<?= $avatar ?>" alt="">
            </div>
            <div class="info-block">
                <div class="title">About <?= $user->display_name; ?></div>
                <div class="author-intro-block">
                    <?= $intro_text; ?>
                </div>
                <div class="social-wrap">
                    <div class="social-block">
                    <?php echo empty($facebook)? '': '<a href="'. $facebook .'"><i class="fa fa-facebook"></i></a>' ?>
                    <?php echo empty($twitter)? '': '<a href="'. $twitter .'"><i class="fa fa-twitter"></i></i></a>' ?>
                    <?php echo empty($linkedin)? '': '<a href="'. $linkedin .'"><i class="fa fa-linkedin"></i></a>' ?>
                    <?php echo empty($instagram)? '': '<a href="'. $instagram .'"><i class="fa fa-instagram"></i></a>' ?>
                    <?php echo empty($pinterest)? '': '<a href="'. $pinterest .'"><i class="fa fa-pinterest"></i></a>' ?>
                    <?php echo empty($youtube)? '': '<a href="'. $youtube .'"><i class="fa fa-youtube"></i></a>' ?>
                    </div>
                    <div class="follow">
						
                        <?php //echo do_shortcode('[wpw_follow_me]'); ?>
                        <?php echo do_shortcode('[wpw_follow_author_me]'); ?>
						
						
<!--                        <a href="#" id="follow">-->
<!--                            <span class="text">follow</span>-->
<!--                            <span class="icon icon-2"><i class="fa fa-ellipsis-h"></i></span>-->
<!--                        </a>-->
                    </div>
                </div>
            </div>
         </div>
        
        <div class="author-desc-block">
            <?= $desc; ?>
        </div>
    </div>
    <div class="author-blog-posts row blog-posts<?php echo esc_html($postStyle) ?>">
        <div id="main" class="col-lg-12">
            <div class="title-blog">Read <?= $user->display_name; ?>'s posts </div>
            <?php

            if ($posts->have_posts() ) : ?>


                <div class="row" id="content">

                    <?php /* Start the Loop */
                    while ( $posts->have_posts() ) : $posts->the_post();

                        /* Include the Post-Format-specific template for the content.
                         * If you want to overload this in a child theme then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'content-post-3-author', get_post_format() );

                    endwhile;
                    ?>

                </div><!-- /.row -->
<?php // echo do_shortcode( '[ajax_load_more post_type="post"]' ); ?>
                <?php

                // Paging function
                if (function_exists( 'rf_get_pagination' )) :
                //    rf_get_pagination();
                endif;

            else :

                get_template_part( 'no-results', 'index' );

            endif; // end of loop. ?>

        </div><!-- / #content -->

        
    </div><!-- /.row -->
</section>
<?php get_footer(); ?>
<?php  //get_footer( 'author' ); ?>