<div class="row listings-table active" data-sort-view-content="table">
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
  <div class="listings-table-header">
    <div class="header-img">
      <!-- Spacer -->
    </div>
    <div class="header-address">Address</div>
    <div class="header-price">Price</div>
    <div class="header-beds">Beds</div>
    <div class="header-baths">Baths</div>
    <div class="header-lot">Lot Size</div>
  </div>
  <div class="listings-table-body">
    <div class="listings-col">
      <div class="listings-item">
        <div class="listings-img">
          <a href="<?php echo $listingPerm; ?>" class="thumbnail-loader"  data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
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
                echo '<canvas width="280" height="240" class="aos-lazy-img" data-src="'.$image[0].'" style="background-image: url('.$image[0].')"></canvas>';
              }else{
                echo '<canvas width="280" height="240" class="aos-lazy-img" data-src="'.AIOS_LISTINGS_URL_ASSETS_IMAGES.'no-photo.jpg" style="background-image: url('.AIOS_LISTINGS_URL_ASSETS_IMAGES.'no-photo.jpg)"></canvas>';
              }
            ?>
            <div class="property-status tabular">
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
            </div>
          </a>
        </div>
        <div class="listings-address">
          <a href="<?php echo get_the_permalink($listing->listing->ID); ?>">
            <?php
              echo $listingDetailsMeta['address_street_number'] . ' ' .  $listingDetailsMeta['address_street_name'] .  (!empty($listingDetailsMeta['address_unit_number'])?', ' . $listingDetailsMeta['address_unit_number']:'') . ' ' . $listingDetailsMeta['address_city'] . ', ' . $listingDetailsMeta['address_state'] . ' ' . $listingDetailsMeta['address_zip_code'];
            ?>
          </a>
        </div>
        <div class="listings-price">
          <?php
            echo $currArr[$listingDetailsMeta['price_currency']];
            echo number_format($listingDetailsMeta['price']);
            echo (isset($listingDetailsMeta['price_arrangement']) && $listingDetailsMeta['price_arrangement'] == 'Monthly')?' / mo':'';
           ?>
        </div>
	      <?php if (! empty($listingDetailsMeta['details_bedrooms'])) : ?>
        <div class="listings-plan listings-bed">
          <?php echo $listingDetailsMeta['details_bedrooms']; ?>
        </div>
	      <?php endif; ?>
	      <?php if (! empty($listingDetailsMeta['details_bathrooms'])) : ?>
        <div class="listings-plan listings-bath">
          <?php echo $listingDetailsMeta['details_bathrooms']; ?>
        </div>
	      <?php endif; ?>
	      <?php if (! empty($listingDetailsMeta['details_lot_area'])) : ?>
        <div class="listings-plan listings-sqft">
          <?php echo number_format($listingDetailsMeta['details_lot_area']); ?>
        </div>
	      <?php endif; ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
