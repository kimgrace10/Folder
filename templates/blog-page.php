<?php
/**
 * Template Name: Write for Tripster
 *
 * A template to replicate the ho*/

add_filter('theme_template_has_layout', function(){ return true; });
//get_header('author');

get_header(); 

$banner = get_field('banner_blog');
?>
<style>
section.hero.small-hero {
    display: none;
}
</style>


<div class="heroBanner banner-wrap">
    <div class="banner" style="background-image:url('<?= $banner['url']; ?>');">
        <div class="container c_big">
            <div class="banner-title-block">
                <h1 class="title"><?= get_field('title_banner') ?></h1>
                <div class="subtitle"><?= get_field('subtitle_banner') ?></div>
            </div>
        </div>
    </div>
</div>

<div class="whyTripster pt_60 pb_60">
    <div class="container c_big">
        <div class="row">
            <div class="col-md-7">
                <div class="textBox">
                    <h2 class="sec_title"><?php echo get_field('sec1_title')  ?></h2>
                    <p><?php echo get_field('sec1_text')  ?></p>
                    <a href="#form-wrap" class="btn theme-btn">Apply Today</a>
                </div>
            </div>
            <div class="col-md-5">
                <div class="featureList">
                    <?php
                    $sec2_blocks = get_field('sec2_blocks');
                    if($sec2_blocks):
                        foreach ($sec2_blocks as $block): ?>
                            <div class="item">
                                <div class="icon">
                                    <img src="<?php echo $block['icon']['url']; ?>" alt="">
                                </div>
                                <div class="block-text">
                                    <h3><?php echo $block['title']; ?></h3>
                                    <?php echo $block['text']; ?>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            
        </div>
    </div>
</div>


<div class="aboutInfo blue-bg text-white pt_60 pb_60">
    <div class="container">
        <h2 class="sec_title"><?php echo get_field('sec3_title')  ?></h2>
        <div class="text">
            <?php echo get_field('sec3_text')  ?>
        </div>
    </div>
</div>

<?php $users = get_users(array( 'role__in' => array( 'author') )); 
?>
<?php if(!empty($users)) : ?>
<div class="join_writer pt_60 pb_60">
    <div class="container">
        <h2 class="sec_title"><?php  the_field('wft_title') ?></h2>
        <div class="title_text">
            <p><?php    the_field('wft_description')  ?></p>
        </div>
        <div class="writers_slider owl-carousel">
        <?php foreach ($users as $user) : 
                $user_data = get_userdata($user->ID);
                $user_fn = $user_data->user_firstname;
                $user_ln = $user_data->user_lastname;

                $user_full_name = $user_fn.' '.$user_ln[0] . '.';
			
			
			   $args = array(
					'author'        =>   $user->ID,
				    'post_type' => 'post',
				    'post_status' => 'publish',
					'order'         =>  'ASC',
					'posts_per_page' => -1
				);

				$current_user_posts = get_posts( $args );
				$total = count($current_user_posts);
            ?>
               <div class="item author-id-<?php echo $user->ID; ?>">
                    <div class="img"><img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="" /></div>
                    <div class="text">
                        <h4><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo $user_full_name; ?></a></h4>
                        <p>(<?php echo $total; ?> posts)</p>
                    </div>
               </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>



<div class="talk_travel light-bg pt_60 pb_60">
    <div class="container c_big">
        <h2 class="sec_title"><?php echo get_field('sec4_title')  ?></h2>
        <div class="title_text">
            <?php echo get_field('sec4_text')  ?>
        </div>
        <div class="row">
            <?php
            $sec4_blocks = get_field('sec4_blocks');
            if($sec4_blocks):
                foreach ($sec4_blocks as $block): ?>
                    <div class="col-md-4">
                        <div class="item">
                            <div class="img"><img src="<?php echo $block['icon']; ?>" alt="" /></div>
                            <h3><?php echo $block['title']; ?></h3>
                            <p><?php echo $block['sub_title']; ?></p>
                            <div class="block-list"><?php echo $block['text']; ?></div>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>


<div class="applyForm sec form-sec">
    <div class="container">
        <div class="innerBox">
            <div class="form-blog-wrap" id="form-wrap">
                <h2 class="sec_title">Don't Wait, Apply Today</h2>
                <!--[if lte IE 8]>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
<![endif]-->
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script>
  hbspt.forms.create({
region: "na1",
portalId: "9235342",
formId: "3a13b8bf-5e52-4b50-825f-c8817d6b3c31"
});
</script>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
