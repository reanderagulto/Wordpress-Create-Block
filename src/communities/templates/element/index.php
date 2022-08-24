<?php 

use AIOS\Communities\Controllers\Options;

$communities_settings         = Options::options();
if (!empty($communities_settings)) extract($communities_settings);

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$paged = 1;

$aioscm_used_custom_title   = get_post_meta(get_queried_object()->ID, 'aioscm_used_custom_title', true);
$aioscm_main_title          = get_post_meta(get_queried_object()->ID, 'aioscm_main_title', true);
$aioscm_sub_title           = get_post_meta(get_queried_object()->ID, 'aioscm_sub_title', true);

$args = array(
    'post_type'         => 'aios-communities',
    'posts_per_page'    => $attributes['no_shown'],
    'paged'             => $paged,
    'order'             => 'ASC',
    'ignore_custom_sort' => true,
);

$community_query = new WP_Query($args);
$community_total_posts = $community_query->post_count;
$aios_metaboxes_banner_title_layout = get_option( 'aios-metaboxes-banner-title-layout', '' );

?>

<?php if ($community_query->have_posts()) : ?>
    <section id="aios-communties-element">
        <h2 class="hidden">IP Area Of Expertise</h2>
        <div class="aoe-wrap">
            <div class="row aoe-inner">
                <div class="col-md-6">
                    <div class="aoe-left bootstrap-extend-left">
                        <div class="aoe-img" data-aos="fade-up" data-aos-duration="500" data-aos-once="true">
                            <div class="img-wrap">
                                <canvas width="761" height="785"></canvas>
                                    <?php
                                    $post_thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');
                                    
                                    $default_photo = $default_photo != '' ? $default_photo : AIOS_COMMUNITIES_URL . 'templates/themes/element/images/default-communities-photo.jpg';

                                    if (!empty($default_photo)) {
                                        echo '<img src="' . $default_photo . '" alt="' . get_the_title() . '">';
                                    }
                                
                                ?>

                            </div>
                        </div>  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="aoe-main">
                        <div class="aoe-list-wrap" data-aos="fade-up" data-aos-duration="500" data-aos-once="true">
                            <ul class="aoe-list">
                                <?php while ($community_query->have_posts()) : $community_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else : ?>

<?php endif ?>

