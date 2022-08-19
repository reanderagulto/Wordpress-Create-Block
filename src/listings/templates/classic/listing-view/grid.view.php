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

        <!-- BEGIN: Content Grid -->
        <div class="ai-classic-properties-content-grid">
            <div class="ai-classic-properties-content-grid-price">
                <?php
                echo $currency[$listingDetailsMeta['price_currency']] . number_format($listingDetailsMeta['price']);
                echo isset($listingDetailsMeta['price_arrangement']) && $listingDetailsMeta['price_arrangement'] == 'Monthly' ? ' / mo' : '';
                ?>
            </div>
            <div class="ai-classic-properties-content-grid-address">
                <div>
                    <span class="ai-font-location-c"></span>
                    <?= "{$listingDetailsMeta['address_street_number']} {$listingDetailsMeta['address_street_name']}" ?>
                </div>
                <div>
                    <?= $listingDetailsMeta['address_city'] ?>
                </div>
            </div>
        </div>
        <a href="<?=$listingPerm?>" class="ai-classic-properties-content-grid-link"> <?= "{$listingDetailsMeta['address_street_number']} {$listingDetailsMeta['address_street_name']}, {$listingDetailsMeta['address_city']}" ?></a>
        <!-- END: Content Grid -->

    </div>
    <!-- END: Content -->
</div>
<?php endforeach; ?>