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
    $order = 'ASC'
    $order_by = 'name';

    $args = array(
        'post_type' 		=> 'aios-communities',
        'posts_per_page' 	=> $attributes['no_shown'],
        'paged' 			=> $paged,
        'order' 			=> $order,
        'orderby' 			=> $order_by,
        'ignore_custom_sort' => true
    );

?>

<script>
    AOS.init();
</script>