<?php
/**
 * Event Archive Template
 */

get_header();

$today = date('Y-m-d');

$upcoming_args = array(
    'post_type' => 'event',
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'meta_key' => '_event_start_date',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => '_event_start_date',
            'value' => $today,
            'compare' => '>=',
            'type' => 'DATE',
        ),
    ),
);
$upcoming_events = new WP_Query($upcoming_args);
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    'Events',
    'Stay updated with upcoming events, workshops, and activities',
    array(array('label' => 'Events'))
); ?>

<!-- Events Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Upcoming Events</span>
            <h2 class="section-title">Join Our Events</h2>
            <p class="section-subtitle">Discover workshops, open days, and networking opportunities</p>
        </div>

        <div class="events-grid">
            <?php if ($upcoming_events->have_posts()) : ?>
                <?php while ($upcoming_events->have_posts()) : $upcoming_events->the_post(); ?>
                    <?php get_template_part('templates/event-card'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <p style="font-size: 18px; color: var(--text-muted);">No upcoming events at the moment. Please check back later.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<?php fusion_college_cta_section('Stay Connected', 'Subscribe to our newsletter to get updates about upcoming events.', 'Contact Us', get_permalink(get_page_by_path('contact'))); ?>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
