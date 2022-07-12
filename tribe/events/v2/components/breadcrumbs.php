<?php
/**
 * View: Breadcrumbs
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/components/breadcrumbs.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.9.11
 *
 * @var array $breadcrumbs An array of data for breadcrumbs.
 */

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$post_id = url_to_postid( $actual_link );

if( is_tax('tribe_events_cat') ){
    $term_id = get_queried_object()->term_id;
    $title = get_term( $term_id )->name;
    ?>
    
    <div class="tribe-events-header__breadcrumbs tribe-events-c-breadcrumbs">
    <ol class="tribe-events-c-breadcrumbs__list">
        
        <li class="tribe-events-c-breadcrumbs__list-item">
            <a href="https://www.tripster.com/travelguide/events/" class="tribe-events-c-breadcrumbs__list-item-link"
                >
                Category </a>
            <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--caret-right tribe-events-c-breadcrumbs__list-item-icon-svg"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 16">
                <path d="M.3 1.6L1.8.1 9.7 8l-7.9 7.9-1.5-1.5L6.7 8 .3 1.6z"></path>
            </svg>
        </li>

        <li class="tribe-events-c-breadcrumbs__list-item">
            <span class="tribe-events-c-breadcrumbs__list-item-text">
                <?php echo $title; ?></span>
            <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--caret-right tribe-events-c-breadcrumbs__list-item-icon-svg"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 16">
                <path d="M.3 1.6L1.8.1 9.7 8l-7.9 7.9-1.5-1.5L6.7 8 .3 1.6z"></path>
            </svg>
        </li>

    </ol>
</div>

<?php }elseif( (get_post_type( $post_id ) == 'tribe_venue') ){ $title = get_the_title($post_id); ?>


    <div class="tribe-events-header__breadcrumbs tribe-events-c-breadcrumbs">
    <ol class="tribe-events-c-breadcrumbs__list">
        
        <li class="tribe-events-c-breadcrumbs__list-item">
            <a href="javascript:void(0)" class="tribe-events-c-breadcrumbs__list-item-link"
                >
                Venue </a>
            <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--caret-right tribe-events-c-breadcrumbs__list-item-icon-svg"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 16">
                <path d="M.3 1.6L1.8.1 9.7 8l-7.9 7.9-1.5-1.5L6.7 8 .3 1.6z"></path>
            </svg>
        </li>

        <li class="tribe-events-c-breadcrumbs__list-item">
            <span class="tribe-events-c-breadcrumbs__list-item-text">
            <?php echo $title; ?> </span>
            <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--caret-right tribe-events-c-breadcrumbs__list-item-icon-svg"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 16">
                <path d="M.3 1.6L1.8.1 9.7 8l-7.9 7.9-1.5-1.5L6.7 8 .3 1.6z"></path>
            </svg>
        </li>

    </ol>
</div>


<?php }elseif( (get_post_type( $post_id ) == 'tribe_organizer') ){ $title = get_the_title($post_id);?>


    <div class="tribe-events-header__breadcrumbs tribe-events-c-breadcrumbs">
    <ol class="tribe-events-c-breadcrumbs__list">
        
        <li class="tribe-events-c-breadcrumbs__list-item">
            <a href="javascript:void(0)" class="tribe-events-c-breadcrumbs__list-item-link"
                >
                Organizer </a>
            <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--caret-right tribe-events-c-breadcrumbs__list-item-icon-svg"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 16">
                <path d="M.3 1.6L1.8.1 9.7 8l-7.9 7.9-1.5-1.5L6.7 8 .3 1.6z"></path>
            </svg>
        </li>

        <li class="tribe-events-c-breadcrumbs__list-item">
            <span class="tribe-events-c-breadcrumbs__list-item-text">
                <?php echo $title; ?> </span>
            <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--caret-right tribe-events-c-breadcrumbs__list-item-icon-svg"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 16">
                <path d="M.3 1.6L1.8.1 9.7 8l-7.9 7.9-1.5-1.5L6.7 8 .3 1.6z"></path>
            </svg>
        </li>

    </ol>
</div>




<?php }else{ 


        if ( empty( $breadcrumbs ) ) {
            return;
        }
        $fonrd = '';
        ?>
        <div class="tribe-events-header__breadcrumbs tribe-events-c-breadcrumbs">
            <ol class="tribe-events-c-breadcrumbs__list">
                <?php foreach ( $breadcrumbs as $breadcrumb ) : ?>
                
                <?php 
                    //print_r($breadcrumb);
                ?>

                    <?php if ( ! empty( $breadcrumb['link'] ) ) : ?>
                        <?php $this->template( 'components/breadcrumbs/linked-breadcrumb', [ 'breadcrumb' => $breadcrumb ] ); ?>
                    <?php else : ?>
                        <?php $this->template( 'components/breadcrumbs/breadcrumb', [ 'breadcrumb' => $breadcrumb ] ); ?>
                    <?php endif; ?>

                <?php endforeach; ?>
            </ol>
        </div>

<?php

}
?>