<?php

    use AIOS\Communities\Controllers\Options;

    $communities_settings 		= Options::options();
    if( !empty( $communities_settings ) ) extract( $communities_settings );
    $show_overlay = true;
    $text_shadow = true;
    $show_overlay = ($show_overlay == true ? 'aios-communities-show-overlay' : '' );
    $text_shadow = ($text_shadow == true ? 'aios-communities-has-text-shadow' : '' );

    $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );


    $paged = 1;
    $order = 'ASC';
    $order_by = 'name';
    $aioscm_used_custom_title   = get_post_meta( get_queried_object()->ID, 'aioscm_used_custom_title', true );
    $aioscm_main_title          = get_post_meta( get_queried_object()->ID, 'aioscm_main_title', true );
    $aioscm_sub_title           = get_post_meta( get_queried_object()->ID, 'aioscm_sub_title', true );
   
    $args = array(
        'post_type' 		=> 'aios-communities',
        'posts_per_page' 	=> $attributes['no_shown'],
        'paged' 			=> $paged,
        'order' 			=> $order,
        'orderby' 			=> $order_by,
        'ignore_custom_sort' => true,
    );
  
    $community_query = new WP_Query( $args );
    $community_total_posts = $community_query->post_count;

    $community_posts = $community_query->posts;

    $groupPosts = array_chunk( $community_posts, 7 );
    $aios_metaboxes_banner_title_layout = get_option( 'aios-metaboxes-banner-title-layout', '' );
?>

<section id="content" class="aios-communities-legacy">
<?php 
    foreach( $groupPosts as $posts ) {
    
        $html = '';
        $row_index = 1;
        $column_index = 1;
        $delay = 0.1;
        $column_settings = [
            [
                "items" => 3,
                "sizes" => [
                    [
                        "width" => 660,
                        "height" => 373
                    ],
                    [
                        "width" => 327,
                        "height" => 183
                    ],
                    [
                        "width" => 327,
                        "height" => 183
                    ]
                ]
            ],
            [
                "items" => 1,
                "sizes" => [
                    [
                        "width" => 960,
                        "height" => 800
                    ]
                ]
            ],
            [
                "items" => 3,
                "sizes" => [
                    [
                        "width" => 327,
                        "height" => 183
                    ],
                    [
                        "width" => 327,
                        "height" => 183
                    ],
                    [
                        "width" => 327,
                        "height" => 183
                    ]
                ]
            ]
        ];



        $html .= '<div class="aioscomu-holder" data-aos="fade-up"  data-aos-duration="500" data-aos-once="true">';
            foreach( $posts as $key => $post ) {

                $post_id = $post->ID;
                $post_title = $post->post_title;
                $post_permalink = get_the_permalink( $post_id );

                $post_thumbnail_url = get_post_meta( $post_id,'_thumbnail_id', true );
                $canvas_width = $column_settings[ $row_index - 1 ][ 'sizes' ][ $column_index -1 ][ 'width' ];
                $canvas_height = $column_settings[ $row_index - 1 ][ 'sizes' ][ $column_index -1 ][ 'height' ];

                $thumb_image = '';

                if(!empty($post_thumbnail_url)){
                    $thumb_image  = '<img src="'.wp_get_attachment_url($post_thumbnail_url).'" alt="'.$post_title.'">';
                }else{
                    $thumb_image = !empty($default_photo) ? '<img src="'.$default_photo.'" alt="'.$post_title.'">': '';
                }

                if ( $column_index == 1 ) {
                    // starting tag of .aioscomu-col
                    $html .= '
                        <div class="aioscomu-col' . $row_index . '">
                    ';
                }

                $html .= '
                    <div class="aioscomu-list '.$show_overlay.' '.$text_shadow.'">
                        <a href="' . $post_permalink . '">
                            <div class="aioscomu-photo">
                                <canvas width="' . $canvas_width . '" height="' . $canvas_height . '"></canvas>
                                '.$thumb_image.'
                            </div>
                            <div class="aioscomu-content">
                                <div class="aioscomu-label">
                                    ' . $post_title . '
                                </div>
                            </div>
                        </a>
                    </div>
                ';

                if ( $column_index == $column_settings[ $row_index - 1 ][ 'items' ] ) {
                
                    // closing tag of .aioscomu-col
                    $html .= '
                        </div><!-- End of .aioscomu-col' . $row_index . '-->
                    ';
                }
                
                $delay += 0.2;
                $column_index++;
                
                if ( $column_index > $column_settings[ $row_index - 1 ][ 'items' ]  ) {
                    $row_index++;
                    $column_index = 1;
                }

            }
        $html .= '</div>';

        echo $html;
    }
?>
</section>

<script>
  AOS.init();
</script>


