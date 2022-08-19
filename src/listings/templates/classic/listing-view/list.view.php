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

        <!-- BEGIN: Content List -->
        <div class="ai-classic-properties-content-list">
            <div class="ai-classic-properties-content-list-address">
                <?= "{$listingDetailsMeta['address_street_number']} {$listingDetailsMeta['address_street_name']}" ?>
                <span><?= $listingDetailsMeta['address_city'] ?></span>
            </div>
            <div class="ai-classic-properties-content-list-price">
                <?php
                    echo $currency[$listingDetailsMeta['price_currency']] . number_format($listingDetailsMeta['price']);
                    echo isset($listingDetailsMeta['price_arrangement']) && $listingDetailsMeta['price_arrangement'] == 'Monthly' ? ' / mo' : '';
                ?>
            </div>
            <?php
            if (! empty($listingDetailsMeta['details_bedrooms']) || ! empty($listingDetailsMeta['details_bathrooms']) || ! empty($listingDetailsMeta['details_lot_area'])) {
                $extras = '<div class="ai-classic-properties-content-list-features">';
            if (! empty($listingDetailsMeta['details_bedrooms'])) {
                $extras .= "<div class=\"ai-classic-properties-content-list-features-beds\"><span class=\"ai-font-bed-a\"></span> {$listingDetailsMeta['details_bedrooms']} Beds</div>";
            }

            if (! empty($listingDetailsMeta['details_bathrooms'])) {
                $extras .= "<div class=\"ai-classic-properties-content-list-features-baths\"><span class=\"ai-font-showers-a\"></span> {$listingDetailsMeta['details_bathrooms']} Baths</div>";
            }
            if (! empty($listingDetailsMeta['details_lot_area'])) {
                $areaUnit = $listingDetailsMeta['details_lot_area_units'] ?? 'sq. ft.';
                $extras .= "<div class=\"ai-classic-properties-content-list-features-area\"><span class=\"ai-font-measurement-c\"></span> {$listingDetailsMeta['details_lot_area']} {$areaUnit}</div>";
            }
                $extras .= '</div>';
            echo $extras;
            } ?>
            <a href="<?=$listingPerm?>" class="ai-classic-properties-content-list-link">Details</a>
        </div>
        <!-- END: Content List -->

    </div>
    <!-- END: Content -->
</div>
<?php endforeach; ?>