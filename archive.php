<?php get_header(); ?>
<div class="container section archive-page">
  <div class="content-with-sidebar blog-layout">
    <main class="content-area">
      <header class="page-header"><div class="section-meta">Journal</div><h1><?php the_archive_title(); ?></h1><?php the_archive_description('<div class="archive-description">','</div>'); ?></header>
      <div class="blog-grid">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article class="post-card">
          <?php if(has_post_thumbnail()): ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><?php endif; ?>
          <div class="post-card-body"><div class="post-meta"><?php echo esc_html(get_the_date()); ?></div><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?><a class="text-link" href="<?php the_permalink(); ?>">Read More →</a></div>
        </article>
      <?php endwhile; ?>
      </div><?php the_posts_pagination(); else: ?><p>No posts found.</p><?php endif; ?>
    </main>
    <?php if (get_theme_mod('ol_blog_sidebar_enabled', false) && is_active_sidebar('sidebar-1')): ?><aside class="sidebar"><?php get_sidebar(); ?></aside><?php endif; ?>
  </div>
</div>
<?php get_footer(); ?>
