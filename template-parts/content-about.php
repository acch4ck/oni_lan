<section class="section about-section">
    <div class="container about-grid">
        <div class="about-copy">
            <span class="eyebrow"><?php esc_html_e('About Us','oni-lana'); ?></span>
            <h2><?php echo esc_html(get_theme_mod('ol_about_title','About Our College')); ?></h2>
            <div class="lead"><?php echo wp_kses_post(get_theme_mod('ol_about_text','Write a short introduction to your institution here.')); ?></div>
            <?php if ($url=get_theme_mod('ol_about_url')): ?><a class="button button-outline" href="<?php echo esc_url($url); ?>">Read More</a><?php endif; ?>
        </div>
        <div class="about-card">
            <div class="about-card-icon">✦</div>
            <h3>Learn. Lead. Serve.</h3>
            <p>Building knowledge, character and opportunity for every student.</p>
        </div>
    </div>
</section>
