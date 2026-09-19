<?php get_header(); ?>
<div class="container content-with-sidebar">
    <article class="content-area">
        <?php while (have_posts()): the_post(); ?>
            <header class="page-header"><h1><?php the_title(); ?></h1></header>
            <div class="entry-content"><?php the_content(); ?></div>
        <?php endwhile; ?>
    </article>
    <?php if (get_theme_mod('ol_sidebar_enabled', false)): ?><aside class="sidebar"><?php get_sidebar(); ?></aside><?php endif; ?>
</div>
<?php get_footer(); ?>
