<?php
$slides = new WP_Query(array(
    'post_type'=>'ol_slider',
    'posts_per_page'=>-1,
    'orderby'=>'menu_order',
    'order'=>'ASC',
));
if ($slides->have_posts()): ?>
<section class="hero-slider" aria-label="Featured">
    <div class="slider-track">
        <?php while ($slides->have_posts()): $slides->the_post();
            $button=get_post_meta(get_the_ID(),'_ol_button',true);
            $url=get_post_meta(get_the_ID(),'_ol_url',true);
            $overlay=get_post_meta(get_the_ID(),'_ol_overlay',true);
            $bg=has_post_thumbnail()?get_the_post_thumbnail_url(get_the_ID(),'full'):ONI_LANA_URI.'/assets/images/campus-hero.svg';
        ?>
        <article class="slide <?php echo $overlay?'has-overlay':''; ?>" style="<?php echo $bg?'background-image:url('.esc_url($bg).');':''; ?>">
            <div class="container slide-content">
                <div class="slide-copy">
                    <div class="section-meta">Welcome</div>
                    <h1><?php the_title(); ?></h1>
                    <div><?php the_content(); ?></div>
                    <?php if ($button && $url): ?><a class="button" href="<?php echo esc_url($url); ?>"><?php echo esc_html($button); ?></a><?php endif; ?>
                </div>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
    <button class="slider-prev" aria-label="Previous slide">&#10094;</button>
    <button class="slider-next" aria-label="Next slide">&#10095;</button>
    <div class="slider-dots"></div>
</section>
<?php endif; wp_reset_postdata(); ?>
