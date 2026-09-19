<?php
$q = new WP_Query(array(
    'post_type'      => 'ol_event',
    'post_status'    => 'publish',
    'posts_per_page' => 4,
    'meta_key'       => '_ol_event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => '_ol_event_date',
            'value'   => current_time('Y-m-d'),
            'compare' => '>=',
            'type'    => 'DATE',
        ),
    ),
));
?>
<section class="section events-section" aria-labelledby="upcoming-events-title">
    <div class="container">
        <div class="section-heading">
            <div class="section-meta">Calendar</div>
            <h2 id="upcoming-events-title">Upcoming Events</h2>
            <p>Events published from the WordPress dashboard appear here automatically with their event date.</p>
        </div>

        <?php if ($q->have_posts()): ?>
            <div class="events-grid">
                <?php while ($q->have_posts()): $q->the_post();
                    $date = get_post_meta(get_the_ID(), '_ol_event_date', true);
                    $timestamp = $date ? strtotime($date) : false;
                    ?>
                    <article class="event-card">
                        <div class="event-date">
                            <?php echo $timestamp ? esc_html(date_i18n('d M Y', $timestamp)) : esc_html(get_the_date('d M Y')); ?>
                        </div>
                        <div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php if ($time = get_post_meta(get_the_ID(), '_ol_event_time', true)): ?><p>◷ <?php echo esc_html($time); ?></p><?php endif; ?>
                            <?php if ($loc = get_post_meta(get_the_ID(), '_ol_event_location', true)): ?><p>⌖ <?php echo esc_html($loc); ?></p><?php endif; ?>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else: ?>
            <div class="events-empty">
                <strong>No upcoming events yet.</strong>
                <p>New events will appear here as soon as they are published from the WordPress dashboard.</p>
            </div>
        <?php endif; ?>

        <?php $events_page = get_post_type_archive_link('ol_event'); if ($events_page): ?>
            <p class="section-action"><a class="button button-outline" href="<?php echo esc_url($events_page); ?>">View All Events →</a></p>
        <?php endif; ?>
    </div>
</section>
