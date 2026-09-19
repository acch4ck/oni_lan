<?php if (get_theme_mod('ol_announcement_enabled', true)): ?>
<div class="announcement-bar">
    <div class="container announcement-inner">
        <span class="announcement-label">ANNOUNCEMENT</span>
        <?php echo do_shortcode('[oni_announcements]'); ?>
    </div>
</div>
<?php endif; ?>
