<?php
/**
 * Single Course Template
 * Fully dynamic - pulls content from CPT meta fields
 */
get_header();
?>

<main class="site-main">
    <?php while (have_posts()) {
        the_post(); ?>
    
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="separator">/</span>
                <a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Courses</a>
                <span class="separator">/</span>
                <span class="current"><?php the_title(); ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
            <?php
                $cricos_code = get_post_meta(get_the_ID(), '_course_cricos_code', true);
        if ($cricos_code) {
            echo '<p class="course-meta-text">CRICOS: '.esc_html($cricos_code).'</p>';
        }
        ?>
        </div>
    </section>

    <!-- Course Detail -->
    <section class="section">
        <div class="container">
            <div class="course-detail-grid">
                <!-- Main Content -->
                <div class="course-main-content">
                    
                    <!-- Course Overview -->
                    <div class="course-section fade-in">
                        <h2>Course Overview</h2>
                        <div class="course-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Course Structure -->
                    <?php
                $core_units = get_post_meta(get_the_ID(), '_course_core_units', true);
        $elective_units = get_post_meta(get_the_ID(), '_course_elective_units', true);

        if ($core_units || $elective_units) {
            ?>
                    <div class="course-section fade-in">
                        <h2>Course Structure</h2>
                        <div class="course-structure-card">
                            <?php if ($core_units) {
                                $core_array = explode("\n", trim($core_units));
                                if (count($core_array) > 0) {
                                    ?>
                            <div class="units-block">
                                <h4>Core Units</h4>
                                <ul class="units-list">
                                    <?php foreach ($core_array as $unit) {
                                        $unit = trim($unit);
                                        if (! empty($unit)) {
                                            ?>
                                        <li><?php echo esc_html($unit); ?></li>
                                    <?php }
                                        } ?>
                                </ul>
                            </div>
                            <?php }
                                } ?>
                            
                            <?php if ($elective_units) {
                                $elective_array = explode("\n", trim($elective_units));
                                if (count($elective_array) > 0) {
                                    ?>
                            <div class="units-block">
                                <h4>Elective Units</h4>
                                <ul class="units-list">
                                    <?php foreach ($elective_array as $unit) {
                                        $unit = trim($unit);
                                        if (! empty($unit)) {
                                            ?>
                                        <li><?php echo esc_html($unit); ?></li>
                                    <?php }
                                        } ?>
                                </ul>
                            </div>
                            <?php }
                                } ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Career Outcomes -->
                    <?php
                    $career_outcomes = get_post_meta(get_the_ID(), '_course_career_outcomes', true);
        if ($career_outcomes) {
            $outcomes_array = explode("\n", trim($career_outcomes));
            if (count($outcomes_array) > 0) {
                ?>
                    <div class="course-section fade-in">
                        <h2>Career Outcomes</h2>
                        <div class="career-outcomes-grid">
                            <?php foreach ($outcomes_array as $outcome) {
                                $outcome = trim($outcome);
                                if (! empty($outcome)) {
                                    ?>
                            <div class="career-outcome-item">
                                <span class="career-icon">✓</span>
                                <span><?php echo esc_html($outcome); ?></span>
                            </div>
                            <?php }
                                } ?>
                        </div>
                    </div>
                    <?php }
            } ?>

                    <!-- Entry Requirements -->
                    <?php
            $entry_requirements = get_post_meta(get_the_ID(), '_course_entry_requirements', true);
        if ($entry_requirements) {
            ?>
                    <div class="course-section fade-in">
                        <h2>Entry Requirements</h2>
                        <div class="requirements-card">
                            <?php echo wpautop($entry_requirements); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- International Requirements -->
                    <?php
            $intl_requirements = get_post_meta(get_the_ID(), '_course_international_requirements', true);
        if ($intl_requirements) {
            ?>
                    <div class="course-section fade-in">
                        <h2>International Students</h2>
                        <div class="requirements-card">
                            <?php echo wpautop($intl_requirements); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- How to Apply -->
                    <?php
            $how_to_apply = get_post_meta(get_the_ID(), '_course_how_to_apply', true);
        if ($how_to_apply) {
            ?>
                    <div class="course-section fade-in">
                        <h2>How to Apply</h2>
                        <div class="requirements-card">
                            <?php echo wpautop($how_to_apply); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Fees & Payment -->
                    <?php
            $fees_payment = get_post_meta(get_the_ID(), '_course_fees_payment_info', true);
        if ($fees_payment) {
            ?>
                    <div class="course-section fade-in">
                        <h2>Fees & Payment Plans</h2>
                        <div class="requirements-card">
                            <?php echo wpautop($fees_payment); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Policies & Forms -->
                    <?php
            $policies_forms = get_post_meta(get_the_ID(), '_course_policies_forms', true);
        if ($policies_forms) {
            ?>
                    <div class="course-section fade-in">
                        <h2>Policies & Forms</h2>
                        <div class="requirements-card">
                            <?php echo wpautop($policies_forms); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <!-- Sidebar -->
                <aside class="course-sidebar">
                    <div class="course-sidebar-card">
                        <h3>Quick Facts</h3>
                        
                        <div class="quick-facts">
                            <?php
                    $duration = get_post_meta(get_the_ID(), '_course_duration', true);
        $study_mode = get_post_meta(get_the_ID(), '_course_study_mode', true);
        $location = get_post_meta(get_the_ID(), '_course_location', true);
        $fee = get_post_meta(get_the_ID(), '_course_fee', true);
        ?>
                            
                            <?php if ($duration) { ?>
                            <div class="fact-item">
                                <span class="fact-label">Duration</span>
                                <span class="fact-value"><?php echo esc_html($duration); ?></span>
                            </div>
                            <?php } ?>
                            
                            <?php if ($study_mode) { ?>
                            <div class="fact-item">
                                <span class="fact-label">Study Mode</span>
                                <span class="fact-value"><?php echo esc_html($study_mode); ?></span>
                            </div>
                            <?php } ?>
                            
                            <?php if ($location) { ?>
                            <div class="fact-item">
                                <span class="fact-label">Location</span>
                                <span class="fact-value"><?php echo esc_html($location); ?></span>
                            </div>
                            <?php } ?>
                            
                            <?php if ($cricos_code) { ?>
                            <div class="fact-item">
                                <span class="fact-label">CRICOS</span>
                                <span class="fact-value"><?php echo esc_html($cricos_code); ?></span>
                            </div>
                            <?php } ?>
                        </div>

                        <?php if ($fee && $fee > 0) { ?>
                        <div class="fee-display">
                            <span class="fee-label">Tuition Fee</span>
                            <span class="fee-value">$<?php echo number_format($fee, 0); ?></span>
                        </div>
                        <?php } ?>

                        <div class="sidebar-buttons">
                            <a href="<?php echo esc_url(home_url('/admissions')); ?>?course_id=<?php echo esc_attr(get_the_ID()); ?>" class="btn btn-primary btn-full">Apply Now</a>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline btn-full">Enquire Now</a>
                        </div>

                        <div class="contact-help">
                            <h4>Need Help?</h4>
                            <p>Speak to our course advisors</p>
                            <a href="tel:<?php echo esc_attr(fusion_get_contact_info()['phone']); ?>" class="phone-link">
                                📞 <?php echo esc_html(fusion_get_contact_info()['phone']); ?>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- Related Courses -->
    <?php
    $terms = get_the_terms(get_the_ID(), 'course_category');
        if ($terms) {
            $term_ids = wp_list_pluck($terms, 'term_id');
            $related_courses = new WP_Query([
                'post_type' => 'course',
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'post_status' => 'publish',
                'tax_query' => [
                    [
                        'taxonomy' => 'course_category',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                    ],
                ],
            ]);

            if ($related_courses->have_posts()) {
                ?>
    <section class="section section-alt">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">More Courses</span>
                <h2 class="section-title">Related Courses</h2>
            </div>
            <div class="courses-grid">
                <?php while ($related_courses->have_posts()) {
                    $related_courses->the_post(); ?>
                <div class="course-card fade-in">
                    <div class="course-image">
                        <?php if (has_post_thumbnail()) { ?>
                            <?php the_post_thumbnail('course-thumbnail'); ?>
                        <?php } else { ?>
                            <div class="course-image-bg" style="background: linear-gradient(135deg, #077E86, #2A7970);"></div>
                        <?php } ?>
                        <?php
                            $course_terms = get_the_terms(get_the_ID(), 'course_category');
                    if ($course_terms) {
                        echo '<span class="course-category">'.esc_html($course_terms[0]->name).'</span>';
                    }
                    ?>
                    </div>
                    <div class="course-content">
                        <h3 class="course-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="course-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <div class="course-meta">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-small">View Details</a>
                        </div>
                    </div>
                </div>
                <?php } wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php }
            } ?>

    <?php } ?>
</main>

<style>
.course-detail-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 50px;
}

.course-section {
    margin-bottom: 50px;
}

.course-section h2 {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--border-color);
}

.course-content {
    font-size: 16px;
    line-height: 1.8;
    color: var(--text-muted);
}

.course-content p {
    margin-bottom: 20px;
}

.course-structure-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
}

.units-block {
    padding: 25px;
}

.units-block:first-child {
    border-bottom: 1px solid var(--border-color);
}

.units-block h4 {
    color: var(--primary);
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
}

.units-list {
    list-style: none;
    padding: 0;
}

.units-list li {
    padding: 10px 0;
    color: var(--text-muted);
    border-bottom: 1px solid var(--border-color);
}

.units-list li:last-child {
    border-bottom: none;
}

.career-outcomes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.career-outcome-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    background: var(--card-bg);
    border-radius: 10px;
    border: 1px solid var(--border-color);
}

.career-icon {
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    flex-shrink: 0;
}

.requirements-card {
    background: var(--card-bg);
    padding: 30px;
    border-radius: 16px;
    border: 1px solid var(--border-color);
}

/* Sidebar */
.course-sidebar-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 40px var(--shadow);
    border: 1px solid var(--border-color);
    position: sticky;
    top: 100px;
}

.course-sidebar-card h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--border-color);
}

.quick-facts {
    margin-bottom: 25px;
}

.fact-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid var(--border-color);
}

.fact-label {
    color: var(--text-muted);
    font-size: 14px;
}

.fact-value {
    color: var(--text-dark);
    font-weight: 600;
    font-size: 14px;
}

.fee-display {
    text-align: center;
    padding: 25px 0;
    border-top: 2px solid var(--border-color);
    margin-top: 10px;
}

.fee-label {
    display: block;
    color: var(--text-muted);
    font-size: 14px;
    margin-bottom: 8px;
}

.fee-value {
    font-size: 42px;
    font-weight: 700;
    color: var(--primary);
}

.sidebar-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 25px;
}

.btn-full {
    width: 100%;
    text-align: center;
}

.btn-outline {
    background: transparent;
    border: 2px solid var(--primary);
    color: var(--primary);
}

.btn-outline:hover {
    background: var(--primary);
    color: white;
}

.contact-help {
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
    text-align: center;
}

.contact-help h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}

.contact-help p {
    font-size: 14px;
    color: var(--text-muted);
    margin-bottom: 12px;
}

.phone-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
}

@media (max-width: 1024px) {
    .course-detail-grid {
        grid-template-columns: 1fr;
    }
    
    .course-sidebar {
        order: -1;
    }
    
    .course-sidebar-card {
        position: static;
    }
}

@media (max-width: 768px) {
    .fee-value {
        font-size: 32px;
    }
}
</style>

<?php get_footer(); ?>
