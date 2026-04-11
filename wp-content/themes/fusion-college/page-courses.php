<?php
/**
 * Template Name: Courses Page
 */

get_header();

$category_colors = array(
    'it' => '#077E86 0%, #2A7970 100%',
    'business' => '#172566 0%, #1e3170 100%',
    'leadership' => '#CF5E1C 0%, #FD6406 100%',
    'community' => '#2A7970 0%, #077E86 100%',
);
$default_color = '#077E86 0%, #172566 100%';

// Get category filter
$current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// Build query args
$args = array(
    'post_type' => 'course',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
);

if ($current_category) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'course_category',
            'field'    => 'slug',
            'terms'    => $current_category,
        ),
    );
}

$courses = new WP_Query($args);
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    'Our Courses',
    'Explore our comprehensive range of vocational education and training programs',
    array(array('label' => 'Courses'))
); ?>

<!-- Page Content (Elementor / Gutenberg) -->
<?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile; endif; wp_reset_postdata(); ?>

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
            <p class="section-subtitle">We offer a wide range of nationally recognized qualifications designed to help you achieve your career goals.</p>
        </div>

        <div class="courses-grid">
            <?php if ($courses->have_posts()) : ?>
                <?php while ($courses->have_posts()) : $courses->the_post(); ?>
                    <?php
                    $duration = get_post_meta(get_the_ID(), '_course_duration', true);
                    $terms = get_the_terms(get_the_ID(), 'course_category');
                    $cat = $terms && !is_wp_error($terms) ? $terms[0]->name : 'Course';
                    $thumb_url = get_post_meta(get_the_ID(), '_course_featured_image', true);
                    if (!$thumb_url) {
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'course-thumb');
                    }
                    ?>
                    <div class="course-card fade-in">
                        <div class="course-image">
                            <?php if ($thumb_url) : ?>
                                <div class="course-image-bg" style="background-image: url('<?php echo esc_url($thumb_url); ?>'); background-size: cover; background-position: center;"></div>
                            <?php else : ?>
                                <div class="course-image-bg" style="background: linear-gradient(135deg, #077E86 0%, #2A7970 100%); display: flex; align-items: center; justify-content: center;">
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                                        <path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4"/>
                                        <path d="M3 9h18M3 15h18"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <span class="course-category"><?php echo esc_html($cat); ?></span>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title"><?php the_title(); ?></h3>
                            <p class="course-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <div class="course-meta">
                                <?php if ($duration) : ?>
                                    <span class="course-duration"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> <?php echo esc_html($duration); ?> Weeks</span>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-small">View Details</a>
                            </div>
                        </div>
                    </div>
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
