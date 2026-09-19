<?php get_header(); ?>
<div class="container content-with-sidebar blog-layout">
    <section class="content-area">
        <header class="page-header"><h1><?php single_post_title(); ?></h1></header>
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <article <?php post_class('post-card'); ?>>
                <?php if (has_post_thumbnail()): ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><?php endif; ?>
                <div class="post-card-body">
                    <div class="post-meta"><?php echo esc_html(get_the_date()); ?></div>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; the_posts_pagination(); else: ?><p>No posts found.</p><?php endif; ?>
    </section>
    <?php if (get_theme_mod('ol_blog_sidebar_enabled', false)): ?><aside class="sidebar"><?php get_sidebar(); ?></aside><?php endif; ?>
</div>
<?php get_footer(); ?>
