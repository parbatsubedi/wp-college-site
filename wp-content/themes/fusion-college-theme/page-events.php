<?php
/**
 * Events Page Template
 * Fully dynamic using shortcodes and CPTs
 */
get_header();
?>

<main class="site-main">

    <!-- Page Banner -->
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <h1><?php the_title(); ?></h1>
                <p>Stay updated with upcoming events, workshops, and activities at Fusion College</p>
                <div class="breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Upcoming Events</span>
                <h2 class="section-title">Join Our Events</h2>
                <p class="section-subtitle">Discover workshops, open days, and networking opportunities</p>
            </div>

            <?php echo do_shortcode('[fusion_events limit="6"]'); ?>
        </div>
    </section>

    <!-- Past Events -->
    <section class="section section-alt">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Past Events</span>
                <h2 class="section-title">Recent Highlights</h2>
            </div>

            <?php
            $past_events = new WP_Query([
                'post_type' => 'event',
                'posts_per_page' => 4,
                'post_status' => 'publish',
                'meta_query' => [
                    [
                        'key' => '_event_date',
                        'value' => date('Y-m-d'),
                        'compare' => '<',
                        'type' => 'DATE',
                    ],
                ],
                'orderby' => 'meta_value',
                'meta_key' => '_event_date',
                'order' => 'DESC',
            ]);
            ?>

            <?php if ($past_events->have_posts()) { ?>
                <div class="past-events-grid">
                    <?php while ($past_events->have_posts()) {
                        $past_events->the_post();
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                        ?>
                        <div class="past-event-card fade-in">
                            <div class="past-event-content">
                                <h4><?php the_title(); ?></h4>
                                <p><?php echo date('F Y', strtotime($event_date)); ?></p>
                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            <?php } else { ?>
                <div style="text-align: center; padding: 40px;">
                    <p style="color: var(--text-muted);">No past events to display.</p>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Stay Connected</h2>
                <p class="cta-subtitle">Subscribe to our newsletter to get updates about upcoming events.</p>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Contact Us</a>
                    <a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>" class="btn btn-outline">View
                        Courses</a>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
    .past-events-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .past-event-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        color: white;
    }

    .past-event-content h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .past-event-content p {
        font-size: 14px;
        opacity: 0.8;
    }

    @media (max-width: 1024px) {
        .past-events-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .past-events-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<?php get_footer(); ?>