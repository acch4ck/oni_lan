<?php
$phone = get_theme_mod('ol_phone');
$email = get_theme_mod('ol_email');
?>
<div class="topbar">
    <div class="container topbar-inner">
        <div class="topbar-left">
            <span><?php echo esc_html(get_theme_mod('ol_top_text','Welcome to our college')); ?></span>
        </div>
        <div class="topbar-right">
            <a class="topbar-search" href="<?php echo esc_url(home_url('/')); ?>?s=" aria-label="Search" title="Search"><?php echo oni_lana_social_icon('search'); ?></a>
            <div class="topbar-contact">
                <?php if ($phone): ?><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/','',$phone)); ?>"><?php echo esc_html($phone); ?></a><?php endif; ?>
                <?php if ($email): ?><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><?php endif; ?>
            </div>
            <?php if (is_user_logged_in()): ?>
                <a class="topbar-login" href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>">Logout</a>
            <?php else: ?>
                <a class="topbar-login" href="<?php echo esc_url(wp_login_url(home_url('/'))); ?>">Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>
