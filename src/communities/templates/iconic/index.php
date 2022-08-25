<?php

    use AIOS\Communities\Controllers\Options;

    $communities_settings 		= Options::options();
    if( !empty( $communities_settings ) ) extract( $communities_settings );
    $show_overlay = ($show_overlay == true ? 'aios-communities-show-overlay' : '' );
    $text_shadow = ($text_shadow == true ? 'aios-communities-has-text-shadow' : '' );

    $paged = 1;
    $aioscm_used_custom_title   = get_post_meta( get_queried_object()->ID, 'aioscm_used_custom_title', true );
    $aioscm_main_title          = get_post_meta( get_queried_object()->ID, 'aioscm_main_title', true );
    $aioscm_sub_title           = get_post_meta( get_queried_object()->ID, 'aioscm_sub_title', true );
   
    $args = array(
        'post_type' 		=> 'aios-communities',
        'posts_per_page' 	=> $attributes['no_shown'],
        'paged' 			=> $paged,
        'order' 			=> 'ASC',
        'orderby' 			=> 'name',
        'ignore_custom_sort' => true,
    );
  
    $community_query = new WP_Query( $args );
    $community_total_posts = $community_query->post_count;
    $aios_metaboxes_banner_title_layout = get_option( 'aios-metaboxes-banner-title-layout', '' );

?>

<?php if ( $community_query->have_posts() ) : ?>
    <section id="aios-communities-iconic" data-aos="fade-up"  data-aos-duration="500" data-aos-once="true">
        <div class="aioscomu-list <?= $show_overlay ?> <?= $text_shadow?>">
            <?php while( $community_query->have_posts() ) : $community_query->the_post(); ?>
                <?php 
                    $post_id = get_the_ID();
                    $post_permalink = get_the_permalink( $post_id );
                    $post_title = get_the_title( $post_id );
                    $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
                ?>
                <a href="<?= $post_permalink ?>" class="aioscomu-cont">
                    <div class="img-holder">
                        <canvas width="533" height="468"></canvas>
                    <?php if( $post_thumbnail_url != '') : ?>
                        <img src="<?= $post_thumbnail_url ?>" alt="<?= get_the_title()?>">
                    <?php else : ?>
                        <?php if (!empty($default_photo) ) : ?>
                        <img src="<?= $default_photo ?>" alt="<?= get_the_title()?>">
                        <?php endif ?>
                    <?php endif ?>
                    </div>
                    <div class="aioscomu-details"><?= $post_title ?></div>
                </a>
            <?php endwhile; ?>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php else: ?>
    <p>Coming soon...</p>
<?php endif; ?>

<script>
  AOS.init();
</script>