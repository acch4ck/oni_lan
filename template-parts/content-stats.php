<?php
$q=new WP_Query(array('post_type'=>'ol_stat','posts_per_page'=>4,'orderby'=>'menu_order','order'=>'ASC'));
if($q->have_posts()): ?>
<section class="stats-section">
<div class="container stats-grid">
<?php while($q->have_posts()): $q->the_post(); ?>
<div class="stat-item">
<?php $icon=get_post_meta(get_the_ID(),'_ol_icon',true); if($icon): ?><span class="dashicons <?php echo esc_attr($icon); ?>"></span><?php endif; ?>
<strong><?php echo esc_html(get_post_meta(get_the_ID(),'_ol_number',true)); ?><sup><?php echo esc_html(get_post_meta(get_the_ID(),'_ol_suffix',true)); ?></sup></strong>
<span><?php the_title(); ?></span>
</div>
<?php endwhile; ?>
</div></section>
<?php endif; wp_reset_postdata(); ?>
