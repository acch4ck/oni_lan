<?php
$q=new WP_Query(array('post_type'=>'post','posts_per_page'=>4));
if($q->have_posts()): ?>
<section class="section blog-section">
<div class="container">
<div class="section-heading"><div class="section-meta">News</div><h2>Latest Blog</h2></div>
<div class="blog-grid">
<?php while($q->have_posts()): $q->the_post(); ?>
<article class="post-card">
<?php if(has_post_thumbnail()): ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><?php endif; ?>
<div class="post-card-body"><div class="post-meta"><?php echo esc_html(get_the_date()); ?></div><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php the_excerpt(); ?></div>
</article>
<?php endwhile; ?>
</div></div></section>
<?php endif; wp_reset_postdata(); ?>
