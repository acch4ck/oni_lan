<?php
$q=new WP_Query(array('post_type'=>'ol_programme','posts_per_page'=>4,'orderby'=>'menu_order','order'=>'ASC'));
if($q->have_posts()): ?>
<section class="section programmes-section">
<div class="container">
<div class="section-heading"><div class="section-meta">Academics</div><h2>Programmes & Courses</h2><p>Explore our academic programmes.</p></div>
<div class="programme-grid">
<?php while($q->have_posts()): $q->the_post(); $url=get_post_meta(get_the_ID(),'_ol_url',true); $label=get_post_meta(get_the_ID(),'_ol_label',true) ?: 'View Programme'; ?>
<article class="programme-card">
<?php if(has_post_thumbnail()): ?><div class="card-image"><?php the_post_thumbnail('large'); ?></div><?php endif; ?>
<div class="card-body"><h3><?php the_title(); ?></h3><?php the_excerpt(); ?><?php if($url): ?><a class="text-link" href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?> →</a><?php endif; ?></div>
</article>
<?php endwhile; ?>
</div></div></section>
<?php endif; wp_reset_postdata(); ?>
