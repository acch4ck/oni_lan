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
            <div class="ol-inline-search" data-inline-search>
                <button class="topbar-search ol-inline-search-toggle" type="button" aria-expanded="false" aria-controls="ol-topbar-search-form" aria-label="<?php esc_attr_e( 'Open search', 'oni-lana' ); ?>" data-open-label="<?php esc_attr_e( 'Open search', 'oni-lana' ); ?>" data-close-label="<?php esc_attr_e( 'Close search', 'oni-lana' ); ?>" data-search-toggle>
                    <?php echo oni_lana_social_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </button>
                <form id="ol-topbar-search-form" class="ol-inline-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-hidden="true" data-search-form>
                    <label class="screen-reader-text" for="ol-topbar-search-input"><?php esc_html_e( 'Search the website', 'oni-lana' ); ?></label>
                    <input id="ol-topbar-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search the website…', 'oni-lana' ); ?>" autocomplete="off" tabindex="-1" data-search-input>
                    <button type="submit" tabindex="-1" aria-label="<?php esc_attr_e( 'Submit search', 'oni-lana' ); ?>" data-search-submit>
                        <?php echo oni_lana_social_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </button>
                </form>
            </div>
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
