<?php
/**
 * Elementor Full Page Template
 * Full width page with theme header/footer + Elementor editing
 */
if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main class="site-main">
    <?php while (have_posts()) {
        the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php 
            if (defined('ELEMENTOR_VERSION') && class_exists('Elementor\Plugin')) {
                \Elementor\Plugin::$instance->frontend->enqueue_styles();
            }
            the_content();
            ?>
        </article>
    <?php } ?>
</main>

<?php get_footer(); ?>