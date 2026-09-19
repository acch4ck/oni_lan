<?php get_header(); ?>
<section class="error-404-page">
    <div class="container">
        <div class="error-404-card">
            <div class="error-404-number" aria-hidden="true">404</div>
            <div class="section-meta">Page Not Found</div>
            <h1>We couldn't find that page.</h1>
            <p>The page may have moved, the address may be incorrect, or the content is no longer available.</p>
            <div class="error-404-actions">
                <a class="button" href="<?php echo esc_url(home_url('/')); ?>">Back to Home</a>
                <a class="button button-outline" href="<?php echo esc_url(home_url('/?s=')); ?>">Search Website</a>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
