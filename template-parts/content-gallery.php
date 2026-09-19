<?php
/**
 * Homepage gallery carousel.
 */

$latest_photos = get_posts( array(
    'post_type'      => 'attachment',
    'post_status'    => 'inherit',
    'post_mime_type' => 'image',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'no_found_rows'  => true,
) );

$gallery_url = oni_lana_get_gallery_page_url();
?>
<section class="container section home-gallery" aria-labelledby="home-gallery-title">
    <div class="section-heading gallery-section-heading">
        <div>
            <div class="section-meta"><?php esc_html_e('Latest moments', 'oni-lana'); ?></div>
            <h2 id="home-gallery-title"><?php esc_html_e('Photo Gallery', 'oni-lana'); ?></h2>
            <p><?php esc_html_e('A look at the latest photos from our community.', 'oni-lana'); ?></p>
        </div>
        <a class="gallery-all-link" href="<?php echo esc_url($gallery_url); ?>"><?php esc_html_e('View all albums', 'oni-lana'); ?><span aria-hidden="true"> →</span></a>
    </div>

    <?php if ($latest_photos): ?>
        <div class="home-gallery-carousel" data-gallery-carousel aria-roledescription="carousel" aria-label="<?php esc_attr_e('Latest gallery photos', 'oni-lana'); ?>">
            <div class="home-gallery-viewport">
                <div class="home-gallery-track">
                    <?php foreach ($latest_photos as $index => $photo):
                        $photo_id = $photo->ID;
                        $full_url = wp_get_attachment_image_url($photo_id, 'full');
                        if (!$full_url) continue;
                        $caption = wp_get_attachment_caption($photo_id) ?: get_the_title($photo_id);
                        $alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true) ?: get_the_title($photo_id);
                        ?>
                        <a class="home-gallery-slide" href="<?php echo esc_url($full_url); ?>" data-gallery-item data-gallery-group="latest-photos" data-caption="<?php echo esc_attr($caption); ?>" data-alt="<?php echo esc_attr($alt); ?>" aria-label="<?php echo esc_attr(sprintf(__('View photo %1$d of %2$d', 'oni-lana'), $index + 1, count($latest_photos))); ?>">
                            <?php echo wp_get_attachment_image($photo_id, 'large', false, array(
                                'loading'       => 0 === $index ? 'eager' : 'lazy',
                                'fetchpriority' => 0 === $index ? 'high' : 'auto',
                                'alt'           => $alt,
                            )); ?>
                            <?php if ($caption): ?><span class="home-gallery-caption"><?php echo esc_html($caption); ?></span><?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if (count($latest_photos) > 1): ?>
                <button class="gallery-carousel-control gallery-carousel-prev" type="button" data-carousel-prev aria-label="<?php esc_attr_e('Previous photo', 'oni-lana'); ?>"><span aria-hidden="true">‹</span></button>
                <button class="gallery-carousel-control gallery-carousel-next" type="button" data-carousel-next aria-label="<?php esc_attr_e('Next photo', 'oni-lana'); ?>"><span aria-hidden="true">›</span></button>
                <div class="gallery-carousel-dots" aria-label="<?php esc_attr_e('Choose a photo', 'oni-lana'); ?>">
                    <?php foreach ($latest_photos as $index => $photo): ?>
                        <button type="button" data-carousel-dot="<?php echo esc_attr($index); ?>" aria-label="<?php echo esc_attr(sprintf(__('Show photo %d', 'oni-lana'), $index + 1)); ?>"<?php echo 0 === $index ? ' aria-current="true"' : ''; ?>></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p class="gallery-empty"><?php esc_html_e('The latest photos will appear here automatically after images are uploaded.', 'oni-lana'); ?></p>
    <?php endif; ?>
</section>
