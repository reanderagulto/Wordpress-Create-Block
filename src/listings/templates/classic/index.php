<?php
  use AIOS\Listings\Classses\Options;
  use AIOS\Listings\Classses\aios_template_api;
  use AIOS\Listings\Classses\Constant;
  use AIOS\Listings\Classses\aios_listing_color_scheme;

  $featured_only = isset($attributes['featured_only']) && ! empty($attributes['featured_only']) ? $attributes['featured_only'] : 0;
  $posts_per_page = isset($attributes['posts_per_page']) && ! empty($attributes['posts_per_page']) ? $attributes['posts_per_page'] : 4;

  // Query Args
  $queryArgs = [
    'listingIDs' =>	$ids,
    'meta' => 	[
      'address'       => ! empty($params['address']) ? $params['address'] : '',
      'minPrice'      => ! empty($params['min_price']) ? $params['min_price'] : 0,
      'maxPrice'      => ! empty($params['max_price']) ? $params['max_price']:10000000,
      'beds'          => ! empty($params['bedrooms']) ? $params['bedrooms'] : 0,
      'baths'         => ! empty($params['bathrooms']) ? $params['bathrooms'] : 0,
      'featured_only' => $featured_only,
      'neighborhood'  => ! empty($params['neighborhood']) ? $params['neighborhood'] : [],
      'agents'        => ! empty($params['agents']) ? $params['agents'] : [],
      'cities'        => ! empty($params['cities']) ? $params['cities'] : [],
      'mls_area'      => ! empty($params['mls_area']) ? $params['mls_area'] : []
    ],
    'tax' => $tax,
    'sort' => $params['sort']
  ];

  // Get queries of listing
  $listingData = aios_template_api::query($posts_per_page, 1, $queryArgs);
  $listingData = json_decode($listingData);
  $color_scheme = new aios_listing_color_scheme('listings_results_page');
  $currency = Constant::currency();
  ?>
  <!-- BEGIN: Classic Properties -->
<div class="ai-classic-properties">
  <div class="ai-classic-properties-listings" data-view="<?=$attributes['selected_view']?>">
    <div class="ai-classic-properties-listings-row">
        <?php 
            if($attributes['selected_view'] == 'list'){
                require_once plugin_dir_path( __FILE__ ) . 'listing-view/list.view.php';
            }else if($attributes['selected_view'] == 'table'){
                require_once plugin_dir_path( __FILE__ ) . 'listing-view/table.view.php';
            }else{
                require_once plugin_dir_path( __FILE__ ) . 'listing-view/grid.view.php';
            }
        ?>
    </div>
  </div>
</div>

<script>
  AOS.init();
</script>