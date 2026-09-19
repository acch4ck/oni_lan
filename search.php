<?php get_header(); ?>
<div class="container section search-page">
<div class="section-heading"><div class="section-meta">Search</div><h1><?php printf(esc_html__('Search results for: %s','oni-lana'), esc_html(get_search_query())); ?></h1></div>
<form class="site-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"><label class="screen-reader-text" for="site-search-input">Search</label><input id="site-search-input" type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Search the website…"><button type="submit" class="button">Search</button></form>
<?php if(have_posts()): ?><div class="blog-grid search-results-grid"><?php while(have_posts()): the_post(); ?><article class="post-card"><?php if(has_post_thumbnail()): ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><?php endif; ?><div class="post-card-body"><div class="post-meta"><?php echo esc_html(get_the_date()); ?></div><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?><a class="text-link" href="<?php the_permalink(); ?>">Read More →</a></div></article><?php endwhile; ?></div><?php the_posts_pagination(); else: ?><p>No results found. Try a different search.</p><?php endif; ?>
</div>
<?php get_footer(); ?>
