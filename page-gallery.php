<?php
/* Template Name: Gallery */
get_header();
?>
<section class="container section gallery-page">
    <div class="section-heading">
        <div class="section-meta">Explore</div>
        <h1><?php the_title(); ?></h1>
        <p>Browse the selected photos from each gallery album.</p>
    </div>
    <div class="gallery-albums gallery-albums-grid">
        <?php
        $q = new WP_Query(array(
            'post_type'      => 'ol_gallery',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ));
        if ($q->have_posts()):
            while ($q->have_posts()): $q->the_post();
                $raw_ids = get_post_meta(get_the_ID(), '_ol_gallery_image_ids', true);
                $ids = array_filter(array_map('absint', preg_split('/[,,\s]+/', (string) $raw_ids)));
                if (!$ids) {
                    $legacy = absint(get_post_meta(get_the_ID(), '_ol_gallery_image_id', true));
                    if ($legacy) $ids = array($legacy);
                }
                $ids = array_slice(array_values(array_unique($ids)), 0, 10);
                if (!$ids) continue;
                $caption = get_post_meta(get_the_ID(), '_ol_gallery_caption', true) ?: get_the_title();
                ?>
                <article class="gallery-album gallery-album-grid-item">
                    <header class="gallery-album-head">
                        <div>
                            <div class="section-meta">Album</div>
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <span class="gallery-photo-count"><?php echo count($ids); ?> photos</span>
                    </header>
                    <div class="gallery-album-photos">
                        <?php foreach ($ids as $image_id):
                            $src = wp_get_attachment_image_url($image_id, 'full');
                            if (!$src) continue;
                            ?>
                            <a class="gallery-album-photo" href="<?php echo esc_url($src); ?>" data-gallery-item data-caption="<?php echo esc_attr($caption); ?>">
                                <?php echo wp_get_attachment_image($image_id, 'medium_large', false, array('loading' => 'lazy')); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($caption): ?><p class="gallery-album-caption"><?php echo esc_html($caption); ?></p><?php endif; ?>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else:
            echo '<p class="gallery-empty">No gallery albums have been added yet. Add a Gallery Item from the WordPress dashboard.</p>';
        endif;
        ?>
    </div>
</section>
<?php get_footer(); ?>
