<?php
/* Template Name: Contact */
get_header();
?>
<section class="container section contact-page">
    <div class="section-heading"><div class="section-meta">Get in touch</div><h1><?php the_title(); ?></h1></div>
    <div class="contact-layout">
        <div>
            <?php while (have_posts()): the_post(); the_content(); endwhile; ?>
            <?php echo do_shortcode('[oni_contact_form]'); ?>
        </div>
        <aside class="contact-info">
            <?php if ($address=get_theme_mod('ol_address')): ?><div><strong>Address</strong><p><?php echo nl2br(esc_html($address)); ?></p></div><?php endif; ?>
            <?php if ($email=get_theme_mod('ol_contact_email',get_option('admin_email'))): ?><div><strong>Email</strong><p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p></div><?php endif; ?>
            <?php if ($phone=get_theme_mod('ol_contact_phone')): ?><div><strong>Phone</strong><p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone)); ?>"><?php echo esc_html($phone); ?></a></p></div><?php endif; ?>
            <?php if (get_theme_mod('ol_facebook') || get_theme_mod('ol_instagram') || get_theme_mod('ol_youtube')): ?>
                <div class="contact-social" aria-label="Social media">
                    <?php if ($url=get_theme_mod('ol_facebook')): ?><a class="social-icon social-facebook" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Facebook"><?php echo oni_lana_social_icon('facebook'); ?></a><?php endif; ?>
                    <?php if ($url=get_theme_mod('ol_instagram')): ?><a class="social-icon social-instagram" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram" title="Instagram"><?php echo oni_lana_social_icon('instagram'); ?></a><?php endif; ?>
                    <?php if ($url=get_theme_mod('ol_youtube')): ?><a class="social-icon social-youtube" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube" title="YouTube"><?php echo oni_lana_social_icon('youtube'); ?></a><?php endif; ?>
                </div>
            <?php endif; ?>
        </aside>
    </div>
    <?php if ($map=get_theme_mod('ol_map_embed')): ?>
        <?php
        $map_src = '';
        if (preg_match('/<iframe[^>]+src=["\']([^"\']+)["\']/i', $map, $matches)) {
            $map_src = html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8');
        } else {
            $map_src = trim(wp_strip_all_tags($map));
        }
        ?>
        <?php if ($map_src && wp_http_validate_url($map_src)): ?>
            <div class="map-embed"><iframe src="<?php echo esc_url($map_src); ?>" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" title="College map"></iframe></div>
        <?php else: ?>
            <p class="map-help">Map URL is not valid. In Customizer → Contact & Footer, paste the Google Maps <strong>Embed URL</strong> or complete iframe code.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php get_footer(); ?>
