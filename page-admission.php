<?php
/* Template Name: Admission */
get_header();
?>
<section class="container section admission-page">
    <div class="section-heading"><div class="section-meta">Join us</div><h1><?php the_title(); ?></h1></div>
    <div class="entry-content"><?php while (have_posts()): the_post(); the_content(); endwhile; ?></div>
</section>
<?php get_footer(); ?>
