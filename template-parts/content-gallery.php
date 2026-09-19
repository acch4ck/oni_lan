<?php
/**
 * Homepage gallery carousel: maximum 10 selected photos, grouped into responsive slides.
 */
$gallery_q = new WP_Query(array(
    'post_type'      => 'ol_gallery',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
));

$photos = array();
if ($gallery_q->have_posts()) {
    while ($gallery_q->have_posts() && count($photos) < 10) {
        $gallery_q->the_post();
        $raw_ids = get_post_meta(get_the_ID(), '_ol_gallery_image_ids', true);
        $ids = array_filter(array_map('absint', preg_split('/[,,\s]+/', (string) $raw_ids)));
        if (!$ids) {
            $legacy = absint(get_post_meta(get_the_ID(), '_ol_gallery_image_id', true));
            if ($legacy) $ids = array($legacy);
        }
        $caption = get_post_meta(get_the_ID(), '_ol_gallery_caption', true) ?: get_the_title();
        foreach (array_slice(array_values(array_unique($ids)), 0, 10) as $image_id) {
            if (count($photos) >= 10) break;
            $src = wp_get_attachment_image_url($image_id, 'large');
            if (!$src) continue;
            $photos[] = array(
                'id'      => $image_id,
                'src'     => $src,
                'caption' => $caption,
            );
        }
    }
    wp_reset_postdata();
}
?>
<section class="section gallery-section homepage-gallery-section">
    <div class="container">
        <div class="section-heading">
            <div class="section-meta">Campus Life</div>
            <h2>Gallery</h2>
            <p>Highlights from campus life and college activities.</p>
        </div>

        <?php if ($photos): ?>
            <div class="front-gallery-carousel" data-front-gallery data-total="<?php echo count($photos); ?>">
                <button class="front-gallery-prev" type="button" aria-label="Previous gallery photos">‹</button>
                <div class="front-gallery-viewport">
                    <div class="front-gallery-track">
                        <?php foreach ($photos as $photo): ?>
                            <a class="front-gallery-card" href="<?php echo esc_url(wp_get_attachment_image_url($photo['id'], 'full')); ?>" data-gallery-item data-caption="<?php echo esc_attr($photo['caption']); ?>">
                                <?php echo wp_get_attachment_image($photo['id'], 'large', false, array('loading' => 'lazy')); ?>
                                <span class="front-gallery-caption"><?php echo esc_html($photo['caption']); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="front-gallery-next" type="button" aria-label="Next gallery photos">›</button>
                <div class="front-gallery-dots" aria-label="Gallery slide navigation"></div>
            </div>
            <div class="section-action"><a class="button button-outline" href="<?php echo esc_url(get_post_type_archive_link('ol_gallery') ?: home_url('/gallery/')); ?>">View Full Gallery →</a></div>
        <?php else: ?>
            <p class="gallery-empty">No gallery photos have been added yet.</p>
        <?php endif; ?>
    </div>
</section>
