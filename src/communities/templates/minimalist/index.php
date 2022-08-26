<?php
    use AIOS\Communities\Controllers\Options;

    $communities_settings 		= Options::options();
    if( !empty( $communities_settings ) ) extract( $communities_settings );
    $show_overlay = 'aios-communities-show-overlay';
    $text_shadow = 'aios-communities-has-text-shadow';

    $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

    $aioscm_used_custom_title   = get_post_meta( get_queried_object()->ID, 'aioscm_used_custom_title', true );
    $aioscm_main_title          = get_post_meta( get_queried_object()->ID, 'aioscm_main_title', true );
    $aioscm_sub_title           = get_post_meta( get_queried_object()->ID, 'aioscm_sub_title', true );
   
    $paged = 1;
    $order = 'ASC';
    $order_by = 'name';

    $args = array(
        'post_type' 		=> 'aios-communities',
        'posts_per_page' 	=> $attributes['no_shown'],
        'paged' 			=> $paged,
        'order' 			=> $order,
        'orderby' 			=> $order_by,
        'ignore_custom_sort' => true
    );

    $community_query = new WP_Query( $args );
    $community_total_posts = $community_query->post_count;
    $aios_metaboxes_banner_title_layout = get_option( 'aios-metaboxes-banner-title-layout', '' );

?>

<div class="ai-communities-minimalist-wrap">
    <div class="ai-communities-minimalist-container">
        <div class="ai-communities-minimalist-row">
            <?php if($community_query->have_posts()) : ?>
                <?php while($community_query->have_posts()) : $community_query->the_post(); ?>
                    <div class="ai-communities-minimalist-list" data-aos="fade-up"  data-aos-duration="500" data-aos-once="true">
                        <a href="<?php the_permalink() ?>" class="<?= $show_overlay ?> <?= $text_shadow ?> ">
                            <div class="ai-communities-minimalist-img">
                                <canvas width="675" height="387"></canvas>
                                <?php if ( has_post_thumbnail() ) : ?>                                    
                                    <img src="<?= get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?>" alt="<?= get_the_title() ?>">
                                <?php else : ?>
                                    <?php if (!empty($default_photo) ) : ?>
                                    <img src="<?= $default_photo ?>" alt="<?= get_the_title()?>">
                                    <?php endif ?>
                                <?php endif; ?>  
                            </div>
                            <div class="ai-communities-minimalist-content">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <div class="ai-communities-minimalist-content-hover">
                                <h2><?php the_title(); ?></h2>
                            </div>
                        </a>
                    </div><!-- end of communities lists -->
                <?php endwhile; ?>
            <?php else: ?>
                <div class="aios-no-communities-found"> <p>No communities found</p></div>    
            <?php endif ?>
        </div><!-- end of communities row -->
    </div>
</div>

<script>
    AOS.init();
</script>