<?php
/**
 * Courses Page Template
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
                <p>Explore our comprehensive range of vocational education and training programs</p>
                <div class="breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Navigation / Category Filter -->
    <div class="page-nav">
        <div class="container">
            <div class="page-nav-links">
                <a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>" class="page-nav-link <?php echo ! isset($_GET['category']) ? 'active' : ''; ?>">All Courses</a>
                <?php
                $categories = get_terms(['taxonomy' => 'course_category', 'hide_empty' => false]);
foreach ($categories as $cat) {
    ?>
                <a href="<?php echo esc_url(add_query_arg('category', $cat->slug)); ?>" 
                   class="page-nav-link <?php echo isset($_GET['category']) && $_GET['category'] == $cat->slug ? 'active' : ''; ?>">
                    <?php echo esc_html($cat->name); ?>
                </a>
                <?php } ?>
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

            <?php
            $limit = 12;
$category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
echo do_shortcode('[fusion_courses limit="'.$limit.'" category="'.$category.'" columns="3"]');
?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Start Your Journey?</h2>
                <p class="cta-subtitle">Join thousands of students who have transformed their careers with Fusion College.</p>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(home_url('/admissions')); ?>" class="btn btn-primary">Apply Now</a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
.page-nav {
    background: var(--card-bg);
    border-bottom: 1px solid var(--border-color);
    padding: 15px 0;
}

.page-nav-links {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
}

.page-nav-link {
    padding: 10px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-muted);
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.page-nav-link:hover {
    color: var(--primary);
    background: var(--accent-light);
}

.page-nav-link.active {
    background: var(--primary);
    color: white;
}
</style>

<?php get_footer(); ?>
