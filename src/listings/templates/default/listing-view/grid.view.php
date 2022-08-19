<div class="row listings-grid active" data-sort-view-content="grid">
  <?php
    $indx = 1;
    foreach($listingData->listings as $listing):
      $listingDetailsMeta = maybe_unserialize($listing->meta->_listing_details[0]);
      $listingDetailsImages = maybe_unserialize($listing->meta->listing_gallery[0]);
      $listingDetailsTaxonomy = maybe_unserialize($listing->taxonomy);

      if($currentPage==1){
        $listingPerm = get_the_permalink($listing->listing->ID) . $indx . '/' . $sessionName;
      }else{
        $listingPerm = get_the_permalink($listing->listing->ID) . ((($currentPage - 1) * $limit) + $indx) . '/' .  $sessionName;
      }

      $indx++;

  ?>
  <div class="col-md-6 listings-col">
    <a href="<?php echo $listingPerm; ?>" class="listings-item" data-aios-double-tap>
      <div class="thumbnail-loader listings-img">
        <?php
          $image = '';
          if(!empty($listingDetailsMeta['featured_image_id'])){
            $image = wp_get_attachment_image_src($listingDetailsMeta['featured_image_id'], 'large');
          }else{
            $images = maybe_unserialize($listing->meta->listing_gallery[0]);
            if(!empty($images)){
              $image = wp_get_attachment_image_src($images[0], 'large');
            }
          }

          if(isset($image[0]) && !empty($image[0])){
            echo '<canvas width="590" height="400"  class="aos-lazy-img" data-src="'.$image[0].'" style="background-image: url('.$image[0].')"></canvas>';
          }else{
            echo '<canvas width="590" height="400"  class="aos-lazy-img" data-src="'.AIOS_LISTINGS_URL_ASSETS_IMAGES.'no-photo.jpg" style="background-image: url('.AIOS_LISTINGS_URL_ASSETS_IMAGES.'no-photo.jpg)"></canvas>';
          }
        ?>
        <div class="property-status">
            <?php
              if($listingDetailsMeta['temporary_status']){
                echo '<span class="aios-ps-for-sale status-orange">Coming Soon</span>';
              }else{
                $tax='';
                foreach($listingDetailsTaxonomy->property_statuses as $taxData){
                  if($taxData->slug == 'for-sale' || $taxData->slug == 'for-lease'){
                    $statusColor = 'status-green';
                  }else if($taxData->slug == 'sold'){
                    $statusColor = 'status-red';
                  }else if($taxData->slug == 'pending'){
                    $statusColor = 'status-yellow';
                  }else{
                    $statusColor = 'status-white';
                  }

                  $tax .= '<span class="aios-ps-for-sale '.$statusColor.'">' . $taxData->name .'</span> ';
                }
                echo rtrim($tax, ' ');
              }
            ?>
          </span>
        </div>
      </div>
      <div class="listings-info">

        <div class="listings-address" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
          <?php
            echo $listingDetailsMeta['address_street_number'] . ' ' .  $listingDetailsMeta['address_street_name'] .  (!empty($listingDetailsMeta['address_unit_number'])?', ' . $listingDetailsMeta['address_unit_number']:'');
          ?>
          <span>
            <?php
              echo $listingDetailsMeta['address_city'] . ', ' . $listingDetailsMeta['address_state']. ' ' . $listingDetailsMeta['address_zip_code'];
            ?>
          </span>
        </div>

        <div class="listings-price" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
          <?php
           echo $currArr[$listingDetailsMeta['price_currency']];
           echo number_format($listingDetailsMeta['price']);
           echo (isset($listingDetailsMeta['price_arrangement']) && $listingDetailsMeta['price_arrangement'] == 'Monthly')?' / mo':'';
          ?>
        </div>
        <div class="listings-plan">
	        <?php if (! empty($listingDetailsMeta['details_bedrooms'])) : ?>
          <span data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
            <em>Beds</em>
            <?php echo $listingDetailsMeta['details_bedrooms']; ?>
          </span>
	        <?php endif; ?>
	        <?php if (! empty($listingDetailsMeta['details_bathrooms'])) : ?>
          <span data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
            <em>Baths</em>
              <?php echo $listingDetailsMeta['details_bathrooms']; ?>
          </span>
	        <?php endif; ?>
	        <?php if (! empty($listingDetailsMeta['details_lot_area'])) : ?>
          <span data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
            <em>sq. ft</em>
            <?php echo $listingDetailsMeta['details_lot_area']; ?>
          </span>
	        <?php endif; ?>
        </div>
      </div>
    </a>
  </div>
<?php endforeach; ?>
</div>
