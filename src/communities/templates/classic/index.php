<?php

    use AIOS\Communities\Controllers\Options;

    $communities_settings 		= Options::options();
    if( !empty( $communities_settings ) ) extract( $communities_settings );
    $show_overlay = ($show_overlay == true ? 'aios-communities-show-overlay' : '' );
    $text_shadow = ($text_shadow == true ? 'aios-communities-has-text-shadow' : '' );

    $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

    $paged = 1;
    $aioscm_used_custom_title   = get_post_meta( get_queried_object()->ID, 'aioscm_used_custom_title', true );
    $aioscm_main_title          = get_post_meta( get_queried_object()->ID, 'aioscm_main_title', true );
    $aioscm_sub_title           = get_post_meta( get_queried_object()->ID, 'aioscm_sub_title', true );
   
    $order_set = 'name';

    // check if the curent url is taxonomy
    if ( is_tax() )  {
        $tax_query = array(
            'relation' => 'AND'
        );
    
        $tax_query[] =  array(
            'taxonomy' => 'sub-community',
            'field'    => 'slug',
            'terms'    => array($term->slug),
        );
    }

    $args = array(
        'post_type' 		=> 'aios-communities',
        'posts_per_page' 	=> $attributes['no_shown'],
        'paged' 			=> $paged,
        'order' 			=> is_null($sort) ? 'ASC' : $sort,
        'orderby' 			=> $order_set,
        'ignore_custom_sort' => true,
        'tax_query'          => $tax_query,
        's' => $address 

    );

    $community_query = new WP_Query( $args );
    $community_total_posts = $community_query->post_count;
    $aios_metaboxes_banner_title_layout = get_option( 'aios-metaboxes-banner-title-layout', '' );

?>

<!-- BEGIN: Classic Communities -->
<div class="ai-classic-communities">

    <!-- BEGIN: Listings -->
    <div class="ai-classic-communities-listings">
        <div class="ai-classic-communities-listings-row">
            <?php if($community_query->have_posts()) : ?>
                <?php while($community_query->have_posts()) : $community_query->the_post(); ?>
                    <!-- BEGIN: Listing -->
                    <div class="ai-classic-communities-listing" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                        <!-- BEGIN: Content -->
                        <div class="ai-classic-communities-content <?= $show_overlay ?> <?= $text_shadow ?>">
                            <!-- BEGIN: Image -->
                            <div class="ai-classic-communities-content-img">
                                <a href="<?php the_permalink() ?>">
                                    <canvas width="785" height="394"></canvas>
                                    <?php if ( has_post_thumbnail() ) : ?>                                    
                                        <img src="<?= get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?>" alt="<?= get_the_title() ?>">
                                    <?php else : ?>
                                        <?php if (!empty($default_photo) ) : ?>
                                        <img src="<?= $default_photo ?>" alt="<?= get_the_title()?>">
                                        <?php endif ?>
                                    <?php endif; ?>                        
                                </a>
                            </div>
                            <!-- END: Image -->
                            <!-- BEGIN: Content Grid -->
                            <div class="ai-classic-communities-content-grid">
                                <div class="ai-classic-communities-content-grid-price">
                                <?php the_title(); ?>
                                </div>
                            </div>
                            <a href="<?php the_permalink() ?>" class="ai-classic-communities-content-grid-link"><?php the_title(); ?></a>
                            <!-- END: Content Grid -->
                        </div>
                        <!-- END: Content -->
                    </div>
                    <!-- END: Listing -->
                <?php endwhile; ?>
            <?php else: ?>
                <div class="aios-no-communities-found"> <p>No communities found</p></div>    
            <?php endif ?>
        </div>
    </div>
    <!-- END: Listings -->

</div>
<!-- END: Classic Properties -->

<script>
  AOS.init();
</script>