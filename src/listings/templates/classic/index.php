<?php
  use AIOS\Listings\Classses\Options;
  use AIOS\Listings\Classses\aios_template_api;
  use AIOS\Listings\Classses\Constant;
  use AIOS\Listings\Classses\aios_listing_color_scheme;

  echo '<h3>Classic Theme</h3>';
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
  
  print_r($listingData);
?>