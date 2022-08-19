<?php foreach($listingData->listings as $listing):
    $listingDetailsMeta = maybe_unserialize($listing->meta->_listing_details[0]);
    $listingDetailsImages = maybe_unserialize($listing->meta->listing_gallery[0]);
    $listingDetailsTaxonomy = maybe_unserialize($listing->taxonomy);

    if ($currentPage == 1) {
    $listingPerm = get_the_permalink($listing->listing->ID) . $indx . '/' . $sessionName;
    }else{
    $listingPerm = get_the_permalink($listing->listing->ID) . ((($currentPage - 1) * $limit) + $indx) . '/' .  $sessionName;
    }

    $indx++;
?>
<div class="ai-classic-properties-listing" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
    <!-- BEGIN: Content -->
    <div class="ai-classic-properties-content">
        <!-- BEGIN: Image -->
        <div class="ai-classic-properties-content-img">
        <a href="<?=$listingPerm?>">
            <?php
            $image = '';
            if (! empty($listingDetailsMeta['featured_image_id'])) {
                $image = wp_get_attachment_image_src($listingDetailsMeta['featured_image_id'], 'large');
            } else {
                $images = maybe_unserialize($listing->meta->listing_gallery[0]);
                if (! empty($images)) {
                $image = wp_get_attachment_image_src($images[0], 'large');
                }
            }
            $image = isset($image[0]) && !empty($image[0]) ? $image[0] : AIOS_LISTINGS_URL_ASSETS_IMAGES . 'no-photo.jpg';
            ?>
            <canvas width="785" height="394" class="lazyload" data-bgset="<?=$image?>" style="background-image: url(<?=$image?>)"></canvas>
        </a>
        </div>
        <!-- END: Image -->

        <!-- BEGIN: Content Table -->
        <div class="ai-classic-properties-content-table">
            <div class="ai-classic-properties-content-table-heading">
                <div class="ai-classic-properties-content-table-data-address"></div>
                <div class="ai-classic-properties-content-table-data-price"></div>
                <div class="ai-classic-properties-content-table-data-beds"></div>
                <div class="ai-classic-properties-content-table-data-baths"></div>
                <div class="ai-classic-properties-content-table-data-size"></div>
            </div>
            <div class="ai-classic-properties-content-table-body">
                <div class="ai-classic-properties-content-table-data-address">
                    <span><a href="<?=$listingPerm?>"><?= "{$listingDetailsMeta['address_street_number']} {$listingDetailsMeta['address_street_name']}, {$listingDetailsMeta['address_city']}" ?></a></span>
                </div>
                <div class="ai-classic-properties-content-table-data-price">
                    <span>
                    <?php
                        echo $currency[$listingDetailsMeta['price_currency']] . number_format($listingDetailsMeta['price']);
                        echo isset($listingDetailsMeta['price_arrangement']) && $listingDetailsMeta['price_arrangement'] == 'Monthly' ? ' / mo' : '';
                    ?>
                    </span>
                </div>

                <?php
                if (! empty($listingDetailsMeta['details_bedrooms']) || ! empty($listingDetailsMeta['details_bathrooms']) || ! empty($listingDetailsMeta['details_lot_area'])) {
                    if (! empty($listingDetailsMeta['details_bedrooms'])) {
                            echo "<div class=\"ai-classic-properties-content-table-data-beds\"><span>{$listingDetailsMeta['details_bedrooms']}</span></div>";
                    }

                    if (! empty($listingDetailsMeta['details_bathrooms'])) {
                        echo "<div class=\"ai-classic-properties-content-table-data-baths\"><span>{$listingDetailsMeta['details_bathrooms']}</span></div>";
                    }

                    if (! empty($listingDetailsMeta['details_lot_area'])) {
                        $areaUnit = $listingDetailsMeta['details_lot_area_units'] ?? 'sq. ft.';
                        echo "<div class=\"ai-classic-properties-content-table-data-size\"><span>{$listingDetailsMeta['details_lot_area']} {$areaUnit}</span></div>";
                    }
                } ?>
            </div>
        </div>
        <!-- END: Content Table -->

    </div>
    <!-- END: Content -->
</div>
<?php endforeach; ?>