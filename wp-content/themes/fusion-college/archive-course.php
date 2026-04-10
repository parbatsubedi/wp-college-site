<?php
/**
 * Course Archive Template
 */

get_header();

$category_colors = array(
    'it' => '#077E86 0%, #2A7970 100%',
    'business' => '#172566 0%, #1e3170 100%',
    'leadership' => '#CF5E1C 0%, #FD6406 100%',
    'community' => '#2A7970 0%, #077E86 100%',
);
$default_color = '#077E86 0%, #172566 100%';

$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$tax_query = array();

if ($current_category) {
    $tax_query[] = array(
        'taxonomy' => 'course_category',
        'field'    => 'slug',
        'terms'    => $current_category,
    );
}

$args = array(
    'post_type' => 'course',
    'posts_per_page' => 12,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
);

if (!empty($tax_query)) {
    $args['tax_query'] = $tax_query;
}

$courses = new WP_Query($args);
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    'Our Courses',
    'Explore our comprehensive range of vocational education and training programs',
    array(array('label' => 'Courses'))
); ?>

<!-- Page Navigation -->
<div class="page-nav">
    <div class="container">
        <div class="page-nav-links">
            <a href="<?php echo get_post_type_archive_link('course'); ?>" class="page-nav-link <?php echo empty($current_category) ? 'active' : ''; ?>">All Courses</a>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'course_category',
                'hide_empty' => true,
            ));
            if ($categories && !is_wp_error($categories)) :
                foreach ($categories as $cat) :
            ?>
                <a href="<?php echo esc_url(get_post_type_archive_link('course') . '?category=' . $cat->slug); ?>" class="page-nav-link <?php echo $current_category === $cat->slug ? 'active' : ''; ?>"><?php echo esc_html($cat->name); ?></a>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>

<!-- Courses Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Our Programs</span>
            <h2 class="section-title">Choose Your Path to Success</h2>
        </div>

        <div class="courses-grid">
            <?php if ($courses->have_posts()) : ?>
                <?php while ($courses->have_posts()) : $courses->the_post(); ?>
                    <?php get_template_part('templates/course-card'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                    <p style="font-size: 18px; color: var(--text-muted);">No courses available at the moment. Please check back later.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<?php fusion_college_cta_section(); ?>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
