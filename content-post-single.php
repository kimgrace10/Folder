<?php
/**
 * Single post content
 */

$banner_position = get_field('position_bg');
if(!empty($banner_position)) : ?>
    <style>
        .single .hero {
            background-position: <?= $banner_position; ?>;
        }
    </style>
<?php endif;
?>
<?php if ( rf_show_page_title() ) :
    $bread_obj = get_field('destination');
    if ($bread_obj && $bread_obj->ID != get_page_by_path('none', OBJECT, 'destination')->ID) { ?>
    <div class="col-sm-12 col-md-12 bread-single-post">
        <?php $parent_post = get_post($bread_obj->post_parent); ?>
        <span class="icon" style="color:#999;font-size:20px;margin-right:5px;">
            <i class="fa fa-map-marker"></i>
        </span>
		
<a href="<?php echo get_permalink($parent_post->ID);?>"><?php echo  $parent_post->post_title;?></a>
        <span>></span>
        <a href="<?php echo get_permalink($bread_obj->ID);?>"><?php echo  $bread_obj->post_title;?></a>

    </div>
<?php }
endif; ?>

<div class="col-sm-12 col-md-12 header-single-post">
	<header class="entry-header">
		<?php if ( rf_show_page_title() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>
	</header><!-- .entry-header -->
</div>
<div class="col-xs-12 col-sm-12 col-md-2 blog-details-column">
	<div class="entry-meta">
        <div class="author-wrapper">
            <div class="author-post">
                <div class="author-block">
                    <div class="author-img vcard meta-item"><?php echo get_avatar( get_the_author_meta('ID') , 150 );?></div>
                    <div>
                        <div class="author-name vcard meta-item"><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php the_author(); ?></a></div>
                        <!--			<div class="author-link">-->
                        <!--				<span class="author vcard meta-item"><a href="--><?php //echo get_author_posts_url($post->post_author); ?><!--">About</a></span>-->
                        <!--				<span class="author vcard meta-item"><a href="--><?php //echo get_author_posts_url($post->post_author); ?><!--">Posts</a></span>-->
                        <!--			</div>-->
                        <div class="author-link">
                            <span class="author vcard meta-item"><?php the_field('author_title', 'user_'.get_the_author_meta('ID')); ?></span>
                            <span class="author vcard meta-item"><?php the_field('author_organization', 'user_'.get_the_author_meta('ID')); ?></span>
                        </div>
                    </div>

                </div>
                <div class="want-to-write-block">
<!--                     <span class="want-to-write meta-item">Want to write for Tripster?</span> -->
                    <span class="want-to-write meta-item"><a href="<?php echo home_url(); ?>/write-for-tripster/">Want to write for Tripster?</a></span>
                </div>
            </div>
            <!--
		<?php
            // Categories
            $category_list = get_the_category_list( '&nbsp;&nbsp; ' );
            if ( $category_list != '' ) {
                ?>
				<div class="cat-links icon-meta">
					<i class="fa fa-folder"></i><?php echo wp_kses_post($category_list); ?>
				</div>
				<?php
            }

            // Tags
            $tag_list = get_the_tag_list( '', '&nbsp;&nbsp; ' );
            if ( $tag_list != '' ) {
                ?>
				<div class="tag-links icon-meta">
					<i class="fa fa-tag"></i><?php echo wp_kses_post($tag_list); ?>
				</div>
				<?php
            }
            ?> -->
        </div>
	</div>

	<?php
	// Check for custom left sidebar from meta options
	$meta_options = get_post_custom();
	if ( isset($meta_options['theme_custom_sidebar_options_left']) ) {
		$theme_sidebar = $meta_options['theme_custom_sidebar_options_left'][0];

		// Determine the sidebar to use
		if ( $theme_sidebar !== 'default' ) {
			?>
			<div class="sidebar">
				<?php get_sidebar('left'); ?>
			</div><!-- /.sidebar-left -->
			<?php
		}
	} // end sidebar left ?>

	<?php // edit_post_link( '<span class="glyphicon glyphicon-edit"></span> &nbsp;'.__( 'Edit', 'framework' ), '<p><span class="edit-link">', '</span></p>' ); ?>

</div><!-- /.blog-details-column -->
<div class="col-sm-8 col-md-7">
	<div class="date-soc">
		<span class="date-pub"><?php the_date(); ?></span>
		<div class="soc-sharing"><?php social_sharing();?></div>
	</div>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php

		// Intro Text / Sub-title
		$summary = get_post_meta( get_the_ID(), 'theme_custom_sub_title_metabox_options_sub_title', true );
		if (!empty($summary)) {
			?>
			<div class="entry-summary">
				<p class="lead"><?php echo wp_kses_post($summary); ?></p>
			</div>
			<?php
		}
		?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'framework' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php


		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}
		?>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>

<div class="sidebar col-xs-12 col-sm-4 col-md-3">
    <div class="single-wrapper">

        <div class="sign-up-post">
            <h3>Are you a Tripster?</h3>
            <p>Create an account to get access to exclusive pricing and rewards.
            </p>
            <a href="#" class="create-tripster-modal-btn">Sign-up</a>
  
            
        </div>
        <?php
        if ( function_exists('dynamic_sidebar') )
            // dynamic_sidebar('right-sidebar-single-post');
        ?>
        <?php
        $destination = get_field('destination');
        $things_title = get_field('things_title', $destination->ID);
        $things_link = get_field('things_link', $destination->ID);
        $places_title = get_field('places_title', $destination->ID);
        $places_link = get_field('places_link', $destination->ID);
        $packages_title = get_field('packages_title', $destination->ID);
        $package_link = get_field('package_link', $destination->ID);
        ?>
        <?php if ($things_link || $places_link || $package_link): ?>
            <div class="book-you-trip">
                <h3>Book your trip</h3>
                <ul>
                    <?php if ($things_link): ?>
                        <li><a target="_blank" href="<?php echo $things_link;?>"><svg style="transform: rotate(140deg);" width="29" height="29" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="ticket-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-ticket-alt fa-w-18 fa-2x"><path fill="currentColor" d="M424 160H152c-13.255 0-24 10.745-24 24v144c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V184c0-13.255-10.745-24-24-24zm-8 160H160V192h256v128zm128-96h32V112c0-26.51-21.49-48-48-48H48C21.49 64 0 85.49 0 112v112h32c17.673 0 32 14.327 32 32s-14.327 32-32 32H0v112c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V288h-32c-17.673 0-32-14.327-32-32s14.327-32 32-32zm0 96v80c0 8.823-7.177 16-16 16H48c-8.823 0-16-7.177-16-16v-80c35.29 0 64-28.71 64-64s-28.71-64-64-64v-80c0-8.823 7.177-16 16-16h480c8.823 0 16 7.177 16 16v80c-35.29 0-64 28.71-64 64s28.71 64 64 64z" class=""></path></svg><?php echo $things_title;?></a></li>
                    <?php endif ?>
                    <?php if ($places_link): ?>
                        <li><a target="_blank" href="<?php echo $places_link;?>"><svg width="29" height="29" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="hotel" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-hotel fa-w-18 fa-2x"><path fill="currentColor" d="M396.8 224h38.4c6.4 0 12.8-6.4 12.8-12.8v-38.4c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v38.4c0 6.4 6.4 12.8 12.8 12.8zm-128-96h38.4c6.4 0 12.8-6.4 12.8-12.8V76.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v38.4c0 6.4 6.4 12.8 12.8 12.8zm128 0h38.4c6.4 0 12.8-6.4 12.8-12.8V76.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v38.4c0 6.4 6.4 12.8 12.8 12.8zm-256 0h38.4c6.4 0 12.8-6.4 12.8-12.8V76.8c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v38.4c0 6.4 6.4 12.8 12.8 12.8zm128 96h38.4c6.4 0 12.8-6.4 12.8-12.8v-38.4c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v38.4c0 6.4 6.4 12.8 12.8 12.8zM568 32c4.42 0 8-3.58 8-8V8c0-4.42-3.58-8-8-8H8C3.58 0 0 3.58 0 8v16c0 4.42 3.58 8 8 8h23.98v448H8c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8h560c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8h-24V32h24zM320 480h-64v-80c0-8.84 7.16-16 16-16h32c8.84 0 16 7.16 16 16v80zm192 0H352v-80c0-26.47-21.53-48-48-48h-32c-26.47 0-48 21.53-48 48v80H63.98V32H512v448zM140.8 224h38.4c6.4 0 12.8-6.4 12.8-12.8v-38.4c0-6.4-6.4-12.8-12.8-12.8h-38.4c-6.4 0-12.8 6.4-12.8 12.8v38.4c0 6.4 6.4 12.8 12.8 12.8zm26.31 157.66l16.25 2.26c4.3.6 8.11-2.24 9.07-6.36 9.96-42.83 49.74-74.28 95.58-74.28s85.61 31.45 95.58 74.28c.96 4.12 4.77 6.96 9.07 6.36l16.25-2.26c4.6-.64 7.9-4.92 6.94-9.34C403.22 314.29 349.72 271.5 288 271.5s-115.22 42.79-127.83 100.81c-.96 4.43 2.34 8.71 6.94 9.35z" class=""></path></svg><?php echo $places_title;?></a></li>
                    <?php endif ?>
                    <?php if ($package_link): ?>
                        <li><a target="_blank" href="<?php echo $package_link;?>"><svg width="29" height="29" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="gift" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-gift fa-w-16 fa-2x"><path fill="currentColor" d="M464 144h-39.3c9.5-13.4 15.3-29.9 15.3-48 0-44.1-33.4-80-74.5-80-42.3 0-66.8 25.4-109.5 95.8C213.3 41.4 188.8 16 146.5 16 105.4 16 72 51.9 72 96c0 18.1 5.8 34.6 15.3 48H48c-26.5 0-48 21.5-48 48v96c0 8.8 7.2 16 16 16h16v144c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V304h16c8.8 0 16-7.2 16-16v-96c0-26.5-21.5-48-48-48zm-187.8-3.6c49.5-83.3 66-92.4 89.3-92.4 23.4 0 42.5 21.5 42.5 48s-19.1 48-42.5 48H274l2.2-3.6zM146.5 48c23.4 0 39.8 9.1 89.3 92.4l2.1 3.6h-91.5c-23.4 0-42.5-21.5-42.5-48 .1-26.5 19.2-48 42.6-48zM192 464H80c-8.8 0-16-7.2-16-16V304h128v160zm0-192H32v-80c0-8.8 7.2-16 16-16h144v96zm96 192h-64V176h64v288zm160-16c0 8.8-7.2 16-16 16H320V304h128v144zm32-176H320v-96h144c8.8 0 16 7.2 16 16v80z" class=""></path></svg><?php echo $packages_title;?></a></li>
                    <?php endif ?>
                </ul>
            </div>
        <?php endif ?>
        <div class="tags-single">
            <?php 
                $tags = get_the_tags();
                if ($tags) { ?>
                    <h3>Tagged in this post</h3>
                    <ul>
                        <?php
                        foreach ( $tags as $tag ) {
                            printf(
                                '<li><a href="%s">%s</a></li>',
                                esc_url( get_tag_link($tag->term_id) ),
                                esc_html( $tag->name )
                            );
                        }?>
                    </ul>
                <?php } ?>
        </div>
        <div class="cat-single">
            <h3>Read more about</h3>
            <ul>
                <?php
                foreach ( get_the_category() as $category ) {
                    printf(
                        '<li><a href="%s">%s</a></li>',
                        esc_url( get_category_link( $category ) ),
                        esc_html( $category->name )
                    );
                }?>
            </ul>
        </div>

        <?php //get_sidebar(); ?>

    </div>

</div><!-- /.sidebar -->