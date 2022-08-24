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
   
    $order_set = is_null($sort) ? $order_by : 'name';

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