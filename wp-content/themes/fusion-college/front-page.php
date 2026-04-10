<?php
/**
 * Template Name: Front Page
 * The main front page template
 */

get_header();
?>

<?php
// Check if page has Gutenberg blocks content
$has_content = have_posts();
?>

<!-- Hero Section -->
<?php fusion_college_hero_section(); ?>

<!-- Stats Section -->
<?php fusion_college_stats_section(); ?>

<!-- About Section -->
<?php fusion_college_about_section(); ?>

<!-- Elementor / Gutenberg content area -->
<?php while (have_posts()) : the_post(); ?>
<section class="section">
    <div class="container">
        <div class="rich-content">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php endwhile; wp_reset_postdata(); ?>

<!-- Featured Courses Section -->
<?php fusion_college_featured_courses(3); ?>

<!-- Why Choose Us Section -->
<?php fusion_college_why_choose_us(); ?>

<!-- Upcoming Events Section -->
<?php fusion_college_upcoming_events(3); ?>

<!-- Testimonials Section -->
<?php fusion_college_testimonials_section(); ?>

<!-- CTA Section -->
<?php fusion_college_cta_section(); ?>

<?php get_footer(); ?>
