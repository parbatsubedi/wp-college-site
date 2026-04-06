<?php get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        <!-- Course Header -->
        <section class="course-header">
            <div class="container">
                <div class="course-header-content">
                    <div class="course-info">
                        <h1><?php the_title(); ?></h1>
                        <div class="course-meta">
                            <?php
                            $duration = get_post_meta(get_the_ID(), '_course_duration', true);
                            $fee = get_post_meta(get_the_ID(), '_course_fee', true);
                            $study_mode = get_post_meta(get_the_ID(), '_course_study_mode', true);
                            $location = get_post_meta(get_the_ID(), '_course_location', true);
                            $cricos_code = get_post_meta(get_the_ID(), '_course_cricos_code', true);
                            ?>

                            <?php if ($duration): ?>
                                <span class="meta-item">⏱️ Duration: <?php echo esc_html($duration); ?></span>
                            <?php endif; ?>

                            <?php if ($fee): ?>
                                <span class="meta-item">💰 Fee: $<?php echo number_format($fee, 2); ?></span>
                            <?php endif; ?>

                            <?php if ($study_mode): ?>
                                <span class="meta-item">📚 Mode: <?php echo esc_html($study_mode); ?></span>
                            <?php endif; ?>

                            <?php if ($location): ?>
                                <span class="meta-item">📍 Location: <?php echo esc_html($location); ?></span>
                            <?php endif; ?>

                            <?php if ($cricos_code): ?>
                                <span class="meta-item">🎓 CRICOS: <?php echo esc_html($cricos_code); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="course-actions">
                            <a href="#apply" class="btn btn-primary">Apply Now</a>
                            <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-secondary">View All Courses</a>
                        </div>
                    </div>

                    <?php if (has_post_thumbnail()): ?>
                        <div class="course-image">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Course Content -->
        <section class="course-content">
            <div class="container">
                <div class="content-grid">
                    <div class="main-content">
                        <div class="course-description">
                            <h2>Course Overview</h2>
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <?php
                        $curriculum = get_post_meta(get_the_ID(), '_course_curriculum', true);
                        if ($curriculum):
                        ?>
                            <div class="course-section">
                                <h3>Curriculum</h3>
                                <div class="curriculum-content">
                                    <?php echo wpautop(esc_html($curriculum)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $core_units = get_post_meta(get_the_ID(), '_course_core_units', true);
                        if ($core_units):
                        ?>
                            <div class="course-section">
                                <h3>Core Units</h3>
                                <div class="units-list">
                                    <?php
                                    $units = json_decode($core_units, true);
                                    if (is_array($units)) {
                                        echo '<ul>';
                                        foreach ($units as $unit) {
                                            echo '<li>' . esc_html($unit) . '</li>';
                                        }
                                        echo '</ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $elective_units = get_post_meta(get_the_ID(), '_course_elective_units', true);
                        if ($elective_units):
                        ?>
                            <div class="course-section">
                                <h3>Elective Units</h3>
                                <div class="units-list">
                                    <?php
                                    $units = json_decode($elective_units, true);
                                    if (is_array($units)) {
                                        echo '<ul>';
                                        foreach ($units as $unit) {
                                            echo '<li>' . esc_html($unit) . '</li>';
                                        }
                                        echo '</ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $career_outcomes = get_post_meta(get_the_ID(), '_course_career_outcomes', true);
                        if ($career_outcomes):
                        ?>
                            <div class="course-section">
                                <h3>Career Outcomes</h3>
                                <div class="outcomes-list">
                                    <?php
                                    $outcomes = json_decode($career_outcomes, true);
                                    if (is_array($outcomes)) {
                                        echo '<ul>';
                                        foreach ($outcomes as $outcome) {
                                            echo '<li>' . esc_html($outcome) . '</li>';
                                        }
                                        echo '</ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $entry_requirements = get_post_meta(get_the_ID(), '_course_entry_requirements', true);
                        if ($entry_requirements):
                        ?>
                            <div class="course-section">
                                <h3>Entry Requirements</h3>
                                <div class="requirements-content">
                                    <?php echo wpautop(esc_html($entry_requirements)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $how_to_apply = get_post_meta(get_the_ID(), '_course_how_to_apply', true);
                        if ($how_to_apply):
                        ?>
                            <div class="course-section">
                                <h3>How to Apply</h3>
                                <div class="apply-content">
                                    <?php echo wpautop(esc_html($how_to_apply)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $international_requirements = get_post_meta(get_the_ID(), '_course_international_requirements', true);
                        if ($international_requirements):
                        ?>
                            <div class="course-section">
                                <h3>International Student Requirements</h3>
                                <div class="requirements-content">
                                    <?php echo wpautop(esc_html($international_requirements)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $fees_payment_info = get_post_meta(get_the_ID(), '_course_fees_payment_info', true);
                        if ($fees_payment_info):
                        ?>
                            <div class="course-section">
                                <h3>Fees & Payment Information</h3>
                                <div class="fees-content">
                                    <?php echo wpautop(esc_html($fees_payment_info)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $policies_forms = get_post_meta(get_the_ID(), '_course_policies_forms', true);
                        if ($policies_forms):
                        ?>
                            <div class="course-section">
                                <h3>Policies & Forms</h3>
                                <div class="policies-content">
                                    <?php echo wpautop(esc_html($policies_forms)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar -->
                    <div class="course-sidebar">
                        <!-- Application Form -->
                        <div class="application-widget" id="apply">
                            <h3>Apply for this Course</h3>

                            <?php if (isset($_GET['applied']) && $_GET['applied'] == '1'): ?>
                                <div class="success-message">
                                    <p>Thank you for your application! We'll review it and get back to you soon.</p>
                                </div>
                            <?php endif; ?>

                            <form class="application-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                                <input type="hidden" name="action" value="application_form">
                                <input type="hidden" name="course_id" value="<?php echo get_the_ID(); ?>">
                                <?php wp_nonce_field('application_form_nonce', 'application_nonce'); ?>

                                <div class="form-group">
                                    <label for="first_name">First Name *</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name *</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth">
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="education">Educational Background</label>
                                    <textarea id="education" name="education" rows="3" placeholder="Please describe your educational qualifications"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="english_proficiency">English Proficiency</label>
                                    <select id="english_proficiency" name="english_proficiency">
                                        <option value="">Select Level</option>
                                        <option value="Native Speaker">Native Speaker</option>
                                        <option value="IELTS 7.0+">IELTS 7.0+</option>
                                        <option value="IELTS 6.5">IELTS 6.5</option>
                                        <option value="IELTS 6.0">IELTS 6.0</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Application</button>
                            </form>
                        </div>

                        <!-- Course Info Widget -->
                        <div class="course-info-widget">
                            <h3>Course Information</h3>
                            <ul class="course-info-list">
                                <?php if ($duration): ?>
                                    <li><strong>Duration:</strong> <?php echo esc_html($duration); ?></li>
                                <?php endif; ?>

                                <?php if ($fee): ?>
                                    <li><strong>Fee:</strong> $<?php echo number_format($fee, 2); ?></li>
                                <?php endif; ?>

                                <?php if ($study_mode): ?>
                                    <li><strong>Study Mode:</strong> <?php echo esc_html($study_mode); ?></li>
                                <?php endif; ?>

                                <?php if ($location): ?>
                                    <li><strong>Location:</strong> <?php echo esc_html($location); ?></li>
                                <?php endif; ?>

                                <?php if ($cricos_code): ?>
                                    <li><strong>CRICOS Code:</strong> <?php echo esc_html($cricos_code); ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- Related Courses -->
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'course_category');
                        if ($categories) {
                            $category_ids = wp_list_pluck($categories, 'term_id');
                            $related_args = array(
                                'post_type' => 'course',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'course_category',
                                        'field' => 'term_id',
                                        'terms' => $category_ids
                                    )
                                )
                            );

                            $related_courses = new WP_Query($related_args);

                            if ($related_courses->have_posts()):
                            ?>
                                <div class="related-courses-widget">
                                    <h3>Related Courses</h3>
                                    <ul class="related-courses-list">
                                        <?php while ($related_courses->have_posts()): $related_courses->the_post(); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?php the_title(); ?>">
                                                    <?php endif; ?>
                                                    <div class="related-course-info">
                                                        <h4><?php the_title(); ?></h4>
                                                        <p><?php echo get_the_excerpt(); ?></p>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            <?php
                            endif;
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<style>
.course-header {
    background: linear-gradient(135deg, #077E86, #2A7970);
    color: white;
    padding: 80px 0;
}

.course-header-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
    align-items: center;
}

.course-info h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.course-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}

.meta-item {
    background: rgba(255,255,255,0.1);
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 14px;
}

.course-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.course-image img {
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.course-content {
    padding: 80px 0;
}

.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
}

.course-section {
    margin-bottom: 40px;
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.course-section h3 {
    color: #077E86;
    margin-bottom: 20px;
    border-bottom: 2px solid #077E86;
    padding-bottom: 10px;
}

.units-list ul,
.outcomes-list ul {
    list-style: none;
    padding: 0;
}

.units-list li,
.outcomes-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 20px;
}

.units-list li:before,
.outcomes-list li:before {
    content: "✓";
    color: #077E86;
    font-weight: bold;
    position: absolute;
    left: 0;
}

.course-sidebar {
    position: sticky;
    top: 20px;
}

.application-widget,
.course-info-widget,
.related-courses-widget {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.application-widget h3,
.course-info-widget h3,
.related-courses-widget h3 {
    color: #077E86;
    margin-bottom: 20px;
}

.course-info-list {
    list-style: none;
    padding: 0;
}

.course-info-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
}

.related-courses-list {
    list-style: none;
    padding: 0;
}

.related-courses-list li {
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.related-courses-list a {
    display: flex;
    gap: 15px;
    text-decoration: none;
    color: inherit;
}

.related-courses-list img {
    width: 60px;
    height: 60px;
    border-radius: 4px;
    object-fit: cover;
}

.related-course-info h4 {
    margin: 0 0 5px;
    color: #077E86;
}

.related-course-info p {
    margin: 0;
    font-size: 14px;
    color: #666;
}

@media (max-width: 768px) {
    .course-header-content,
    .content-grid {
        grid-template-columns: 1fr;
    }

    .course-info h1 {
        font-size: 2rem;
    }

    .course-meta {
        flex-direction: column;
        gap: 10px;
    }

    .course-actions {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>