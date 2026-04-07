<?php
/**
 * Admissions Page Template
 * Fully dynamic - course selection pulls from CPT
 */
get_header();
?>

<main class="site-main">
    
    <!-- Page Banner -->
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <h1><?php the_title(); ?></h1>
                <p>Start your journey to a brighter future with Fusion College</p>
                <div class="breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Selection -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Choose Your Course</span>
                <h2 class="section-title">Select a Course to View Admission Details</h2>
                <p class="section-subtitle">Each course has specific admission requirements, fees, and policies.</p>
            </div>

            <div class="fade-in" style="max-width: 600px; margin: 0 auto 50px;">
                <form method="GET" action="">
                    <div class="form-group">
                        <label style="font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 12px; display: block;">Select a Course</label>
                        <select name="course_id" id="courseSelect" style="width: 100%; padding: 16px 20px; border: 2px solid var(--border-color); border-radius: 12px; font-size: 16px; background: var(--bg-light); color: var(--text-dark); cursor: pointer;" onchange="this.form.submit()">
                            <option value="">-- Choose a Course --</option>
                            <?php
                            $courses = new WP_Query(['post_type' => 'course', 'posts_per_page' => -1, 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC']);
if ($courses->have_posts()) {
    while ($courses->have_posts()) {
        $courses->the_post();
        $fee = get_post_meta(get_the_ID(), '_course_fee', true);
        $selected = isset($_GET['course_id']) && $_GET['course_id'] == get_the_ID() ? 'selected' : '';
        echo '<option value="'.get_the_ID().'" '.$selected.'>'.get_the_title().' ($'.number_format($fee, 0).')</option>';
    }
    wp_reset_postdata();
}
?>
                        </select>
                    </div>
                </form>
            </div>

            <?php if (isset($_GET['course_id'])) { ?>
            <?php
            $selected_course = get_post($_GET['course_id']);
                if ($selected_course && $selected_course->post_type === 'course') {
                    $fee = get_post_meta($selected_course->ID, '_course_fee', true);
                    $duration = get_post_meta($selected_course->ID, '_course_duration', true);
                    $study_mode = get_post_meta($selected_course->ID, '_course_study_mode', true);
                    $location = get_post_meta($selected_course->ID, '_course_location', true);
                    $entry_req = get_post_meta($selected_course->ID, '_course_entry_requirements', true);
                    $intl_req = get_post_meta($selected_course->ID, '_course_international_requirements', true);
                    $how_to_apply = get_post_meta($selected_course->ID, '_course_how_to_apply', true);
                    $fees_info = get_post_meta($selected_course->ID, '_course_fees_payment_info', true);
                    ?>
            
            <div class="fade-in">
                <!-- Course Info Banner -->
                <div class="course-info-banner">
                    <h2><?php echo esc_html($selected_course->post_title); ?></h2>
                    <div class="course-info-stats">
                        <div>
                            <span class="stat-number">$<?php echo number_format($fee, 0); ?></span>
                            <p>Tuition Fee</p>
                        </div>
                        <div>
                            <span class="stat-number"><?php echo esc_html($duration); ?></span>
                            <p>Weeks</p>
                        </div>
                        <?php if ($study_mode) { ?>
                        <div>
                            <span class="stat-number"><?php echo esc_html($study_mode); ?></span>
                            <p>Study Mode</p>
                        </div>
                        <?php } ?>
                        <?php if ($location) { ?>
                        <div>
                            <span class="stat-number"><?php echo esc_html($location); ?></span>
                            <p>Location</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- How to Apply -->
                <div class="section-alt" style="padding: 80px 0; margin: 60px 0; border-radius: 20px;">
                    <div class="container">
                        <div class="section-header">
                            <span class="section-badge">How to Apply</span>
                            <h2 class="section-title">Application Process</h2>
                        </div>
                        
                        <?php if ($how_to_apply) { ?>
                        <div class="rich-content-box">
                            <?php echo wpautop($how_to_apply); ?>
                        </div>
                        <?php } else { ?>
                        <div class="process-steps">
                            <div class="step-card">
                                <div class="step-number">1</div>
                                <p>Choose your desired course</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">2</div>
                                <p>Complete the online application form</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">3</div>
                                <p>Submit required documents</p>
                            </div>
                            <div class="step-card">
                                <div class="step-number">4</div>
                                <p>Wait for assessment and offer letter</p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Entry Requirements -->
                <div class="section-header" style="margin-top: 60px;">
                    <span class="section-badge">Requirements</span>
                    <h2 class="section-title">Entry Requirements</h2>
                </div>
                
                <div class="requirements-grid">
                    <div class="requirements-card">
                        <h3>
                            <span class="req-icon">🇦🇺</span>
                            Domestic Students
                        </h3>
                        <?php if ($entry_req) { ?>
                        <div class="rich-content">
                            <?php echo wpautop($entry_req); ?>
                        </div>
                        <?php } else { ?>
                        <ul class="requirements-list">
                            <li>✓ Completion of Year 12 or equivalent</li>
                            <li>✓ English Language Proficiency</li>
                            <li>✓ Minimum 18 years of age</li>
                        </ul>
                        <?php } ?>
                    </div>

                    <div class="requirements-card">
                        <h3>
                            <span class="req-icon">🌍</span>
                            International Students
                        </h3>
                        <?php if ($intl_req) { ?>
                        <div class="rich-content">
                            <?php echo wpautop($intl_req); ?>
                        </div>
                        <?php } else { ?>
                        <ul class="requirements-list">
                            <li>✓ Valid Passport</li>
                            <li>✓ IELTS 5.5 (no band below 5.0) or equivalent</li>
                            <li>✓ Overseas Student Health Cover</li>
                        </ul>
                        <?php } ?>
                    </div>
                </div>

                <!-- Fees & Payment -->
                <div class="section-header" style="margin-top: 60px;">
                    <span class="section-badge">Fees</span>
                    <h2 class="section-title">Fees & Payment Plans</h2>
                </div>
                
                <div class="fees-card">
                    <?php if ($fees_info) { ?>
                    <div class="rich-content">
                        <?php echo wpautop($fees_info); ?>
                    </div>
                    <?php } else { ?>
                    <div class="fees-display">
                        <span class="fees-amount">$<?php echo number_format($fee, 0); ?></span>
                        <span class="fees-label">Total Tuition Fee</span>
                    </div>
                    <div class="payment-options">
                        <p>Payment Options:</p>
                        <ul>
                            <li>✓ Full payment upfront</li>
                            <li>✓ Semester-based payments</li>
                            <li>✓ Monthly payment plans available</li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>

                <!-- CTA -->
                <div class="cta-section" style="margin-top: 60px;">
                    <div class="container">
                        <div class="cta-content">
                            <h2 class="cta-title">Ready to Apply?</h2>
                            <p class="cta-subtitle">Start your application for <?php echo esc_html($selected_course->post_title); ?> today.</p>
                            <div class="hero-buttons">
                                <a href="<?php echo esc_url(home_url('/contact')); ?>?course=<?php echo esc_attr($selected_course->ID); ?>" class="btn btn-primary">Apply Now</a>
                                <a href="<?php echo esc_url(get_permalink($selected_course->ID)); ?>" class="btn btn-outline">View Course Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php } ?>

            <?php if (! isset($_GET['course_id'])) { ?>
            <!-- Default content when no course selected -->
            <div class="fade-in">
                <div class="section-header">
                    <span class="section-badge">How to Apply</span>
                    <h2 class="section-title">Simple Steps to Join Us</h2>
                    <p class="section-subtitle">Our application process is straightforward and designed to help you get started quickly.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">1</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Choose Your Course</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Browse our courses and select the one that matches your career goals.</p>
                    </div>

                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">2</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Submit Application</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Complete our online application form and submit required documents.</p>
                    </div>

                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">3</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Assessment</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Our admissions team will review your application.</p>
                    </div>

                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">4</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Enroll & Begin</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Accept your offer, complete enrollment, and start learning.</p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 60px;">
                    <a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>" class="btn btn-primary" style="padding: 18px 45px; font-size: 16px;">Browse All Courses</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

</main>

<style>
.course-info-banner {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 60px;
    color: white;
    text-align: center;
}

.course-info-banner h2 {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 30px;
}

.course-info-stats {
    display: flex;
    justify-content: center;
    gap: 50px;
    flex-wrap: wrap;
}

.course-info-stats > div {
    text-align: center;
}

.stat-number {
    font-size: 36px;
    font-weight: 700;
    display: block;
}

.course-info-stats p {
    font-size: 14px;
    opacity: 0.9;
    margin-top: 5px;
}

.process-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-top: 40px;
}

.step-card {
    background: var(--card-bg);
    padding: 35px;
    border-radius: 16px;
    text-align: center;
    border: 1px solid var(--border-color);
    transition: transform 0.3s ease;
}

.step-card:hover {
    transform: translateY(-5px);
}

.step-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    font-weight: 700;
    margin: 0 auto 20px;
}

.step-card h4 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
    color: var(--text-dark);
}

.step-card p {
    font-size: 14px;
    color: var(--text-muted);
}

.requirements-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-top: 40px;
}

.requirements-card {
    background: var(--card-bg);
    padding: 35px;
    border-radius: 20px;
    border: 1px solid var(--border-color);
}

.requirements-card h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.req-icon {
    font-size: 32px;
}

.requirements-list {
    list-style: none;
    padding: 0;
}

.requirements-list li {
    padding: 15px 0;
    color: var(--text-muted);
    border-bottom: 1px solid var(--border-color);
}

.rich-content-box {
    background: var(--card-bg);
    padding: 35px;
    border-radius: 20px;
    border: 1px solid var(--border-color);
    max-width: 800px;
    margin: 0 auto;
}

.fees-card {
    background: var(--card-bg);
    padding: 40px;
    border-radius: 20px;
    border: 1px solid var(--border-color);
    max-width: 800px;
    margin: 40px auto;
    text-align: center;
}

.fees-display {
    margin-bottom: 30px;
}

.fees-amount {
    font-size: 56px;
    font-weight: 700;
    color: var(--primary);
    display: block;
}

.fees-label {
    font-size: 16px;
    color: var(--text-muted);
}

.payment-options {
    text-align: left;
    padding: 0 30px;
}

.payment-options p {
    font-weight: 600;
    margin-bottom: 15px;
}

.payment-options ul {
    list-style: none;
    padding: 0;
}

.payment-options li {
    padding: 8px 0;
    color: var(--text-muted);
}

@media (max-width: 1024px) {
    .process-steps {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .requirements-grid {
        grid-template-columns: 1fr;
    }
    
    .process-steps {
        grid-template-columns: 1fr;
    }
    
    .course-info-stats {
        flex-direction: column;
        gap: 20px;
    }
}
</style>

<?php get_footer(); ?>
