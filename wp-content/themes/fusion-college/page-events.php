<?php
/**
 * Template Name: Events Page
 */

get_header();

// Upcoming events
$today = date('Y-m-d');
$upcoming_args = array(
    'post_type' => 'event',
    'posts_per_page' => -1,
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

// Past events
$past_args = array(
    'post_type' => 'event',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'meta_key' => '_event_start_date',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => '_event_start_date',
            'value' => $today,
            'compare' => '<',
            'type' => 'DATE',
        ),
    ),
);
$past_events = new WP_Query($past_args);
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    'Events',
    'Stay updated with upcoming events, workshops, and activities at ' . fusion_college_college_name(),
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

<!-- Past Events -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Past Events</span>
            <h2 class="section-title">Recent Highlights</h2>
        </div>

        <?php if ($past_events->have_posts()) : ?>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <?php while ($past_events->have_posts()) : $past_events->the_post(); ?>
                <div class="gallery-item" style="aspect-ratio: auto; height: 200px; background: linear-gradient(135deg, #077E86 0%, #2A7970 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; text-align: center; padding: 20px;">
                    <div>
                        <strong><?php the_title(); ?></strong>
                        <?php $start = get_post_meta(get_the_ID(), '_event_start_date', true); ?>
                        <?php if ($start) : ?>
                            <p style="font-size: 12px; opacity: 0.8; margin-top: 5px;"><?php echo date('F Y', strtotime($start)); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php else : ?>
        <div style="text-align: center; padding: 40px;">
            <p style="color: var(--text-muted);">No past events to display.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<?php fusion_college_cta_section('Stay Connected', 'Subscribe to our newsletter to get updates about upcoming events.', 'Contact Us', get_permalink(get_page_by_path('contact')), 'View Courses', get_post_type_archive_link('course')); ?>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
