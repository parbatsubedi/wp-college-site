<?php
/**
 * Archive Template for Events
 */
get_header();
?>

<main class="site-main">
    
    <!-- Page Banner -->
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <h1><?php post_type_archive_title(); ?></h1>
                <p>Stay updated with our latest events, workshops, and activities.</p>
            </div>
        </div>
    </div>

    <!-- Events Grid -->
    <section class="section">
        <div class="container">
            <?php echo do_shortcode('[fusion_events limit="12"]'); ?>

            <?php if (! have_posts()) { ?>
            <div style="text-align: center; padding: 60px 20px;">
                <h3>No upcoming events</h3>
                <p style="color: var(--text-muted); margin-top: 10px;">Check back soon for new events and announcements.</p>
            </div>
            <?php } ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
