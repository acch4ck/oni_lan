<?php
/**
 * Front Page.
 */
get_header();
?>

<section class="hero-notice-section" aria-label="Featured content and notice board">
    <div class="hero-notice-grid">
        <div class="hero-notice-slider">
            <?php get_template_part('template-parts/content-slider'); ?>
        </div>

        <aside class="notice-board" aria-label="Notice Board">
            <div class="notice-head">
                <span class="eyebrow">Updates</span>
                <h2>Notice Board</h2>
                <p>Latest college notices and important updates.</p>
            </div>
            <div class="notice-list">
                <?php
                $notice_query = new WP_Query(array(
                    'post_type'      => 'ol_notice',
                    'post_status'    => 'publish',
                    'posts_per_page' => max(1, min(12, absint(get_theme_mod('ol_notice_count', 6)))),
                    'orderby'        => array('menu_order' => 'ASC', 'date' => 'DESC'),
                ));
                if ($notice_query->have_posts()):
                    while ($notice_query->have_posts()): $notice_query->the_post();
                        $notice_url  = get_post_meta(get_the_ID(), '_ol_url', true);
                        $notice_date = get_post_meta(get_the_ID(), '_ol_notice_date', true);
                        $notice_date_label = $notice_date ? date_i18n('d M', strtotime($notice_date)) : get_the_date('d M');
                        ?>
                        <article class="notice-row">
                            <time datetime="<?php echo esc_attr($notice_date ?: get_the_date('c')); ?>"><?php echo esc_html($notice_date_label); ?></time>
                            <div>
                                <h3>
                                    <?php if ($notice_url): ?><a href="<?php echo esc_url($notice_url); ?>"><?php the_title(); ?></a><?php else: ?><?php the_title(); ?><?php endif; ?>
                                </h3>
                                <?php if (get_the_excerpt()): ?><p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 16)); ?></p><?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p class="notice-empty">No notices have been published yet.</p>';
                endif;
                ?>
            </div>
        </aside>
    </div>
</section>

<div class="home-main-sections<?php echo (get_theme_mod('ol_home_sidebar_enabled', false) && is_active_sidebar('sidebar-1')) ? ' has-home-sidebar' : ''; ?>">
    <div class="home-body-content">
        <?php
        get_template_part('template-parts/content-about');
        get_template_part('template-parts/content-programmes');
        get_template_part('template-parts/content-stats');
        get_template_part('template-parts/content-events');
        get_template_part('template-parts/content-blog');
        get_template_part('template-parts/content-gallery');
        get_template_part('template-parts/content-quick-links');
        ?>
    </div>

    <?php if (get_theme_mod('ol_home_sidebar_enabled', false) && is_active_sidebar('sidebar-1')): ?>
        <aside class="sidebar home-sidebar" aria-label="Homepage Sidebar">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    <?php endif; ?>
</div>

<?php get_template_part('template-parts/content-popup'); ?>

<?php get_footer(); ?>
