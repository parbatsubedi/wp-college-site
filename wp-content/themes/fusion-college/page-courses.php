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
                    $cat = '';
                    $terms = get_the_terms(get_the_ID(), 'course_category');
                    if ($terms && !is_wp_error($terms)) {
                        $cat = $terms[0]->slug;
                    }
                    ?>
                    <div class="course-card fade-in">
                        <div class="course-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="course-image-bg" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'course-thumb')); ?>'); background-size: cover; background-position: center;"></div>
                            <?php else : ?>
                                <div class="course-image-bg" style="background: linear-gradient(135deg, <?php echo isset($category_colors[$cat]) ? $category_colors[$cat] : $default_color; ?>); display: flex; align-items: center; justify-content: center;">
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                                        <?php if ($cat === 'it') : ?>
                                            <path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4"/>
                                            <path d="M3 9h18M3 15h18"/>
                                        <?php elseif ($cat === 'business') : ?>
                                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                        <?php elseif ($cat === 'leadership') : ?>
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                        <?php else : ?>
                                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                            <circle cx="9" cy="7" r="4"/>
                                        <?php endif; ?>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <?php if ($cat) : ?>
                                <span class="course-category"><?php echo esc_html(ucfirst(str_replace('-', ' ', $cat))); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title"><?php the_title(); ?></h3>
                            <p class="course-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <div class="course-meta">
                                <?php if ($duration) : ?>
                                    <span class="course-duration">📅 <?php echo esc_html($duration); ?> Weeks</span>
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
