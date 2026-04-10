<?php
/**
 * Template Name: Admissions Page
 */

get_header();

$selected_course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
$selected_course = $selected_course_id ? get_post($selected_course_id) : null;

// Get all courses for the dropdown
$all_courses = get_posts(array(
    'post_type' => 'course',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
));
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    'Admissions',
    'Start your journey to a brighter future with ' . fusion_college_college_name(),
    array(array('label' => 'Admissions'))
); ?>

<!-- Course Selection -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Choose Your Course</span>
            <h2 class="section-title">Select a Course to View Admission Details</h2>
            <p class="section-subtitle">Each course has specific admission requirements, fees, and policies.</p>
        </div>

        <div class="fade-in" style="max-width: 600px; margin: 0 auto 50px;">
            <div class="form-group">
                <label style="font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 12px; display: block;">Select a Course</label>
                <form method="GET" action="">
                    <select name="course_id" id="course_id" style="width: 100%; padding: 16px 20px; border: 2px solid var(--border-color); border-radius: 12px; font-size: 16px; background: var(--bg-light); color: var(--text-dark); cursor: pointer; transition: all 0.3s ease;" onchange="this.form.submit()">
                        <option value="">-- Choose a Course --</option>
                        <?php foreach ($all_courses as $course) : ?>
                            <?php $fee = get_post_meta($course->ID, '_course_fee', true); ?>
                            <option value="<?php echo esc_attr($course->ID); ?>" <?php selected($selected_course && $selected_course->ID == $course->ID); ?>>
                                <?php echo esc_html($course->post_title); ?> ($<?php echo $fee ? number_format($fee, 0) : 'TBA'; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>

        <?php if ($selected_course) :
            $fee = get_post_meta($selected_course->ID, '_course_fee', true);
            $duration = get_post_meta($selected_course->ID, '_course_duration', true);
            $location = get_post_meta($selected_course->ID, '_course_location', true);
        ?>
        <div class="fade-in">
            <!-- Course Info Banner -->
            <div style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 20px; padding: 40px; margin-bottom: 60px; color: white; text-align: center;">
                <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 10px;"><?php echo esc_html($selected_course->post_title); ?></h2>
                <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; margin-top: 20px;">
                    <div>
                        <span style="font-size: 28px; font-weight: 700;">$<?php echo $fee ? number_format($fee, 0) : 'TBA'; ?></span>
                        <p style="font-size: 14px; opacity: 0.9;">Tuition Fee</p>
                    </div>
                    <?php if ($duration) : ?>
                    <div>
                        <span style="font-size: 28px; font-weight: 700;"><?php echo esc_html($duration); ?></span>
                        <p style="font-size: 14px; opacity: 0.9;">Weeks</p>
                    </div>
                    <?php endif; ?>
                    <?php if ($location) : ?>
                    <div>
                        <span style="font-size: 28px; font-weight: 700;"><?php echo esc_html($location); ?></span>
                        <p style="font-size: 14px; opacity: 0.9;">Location</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- How to Apply -->
            <div class="section-header">
                <span class="section-badge">How to Apply</span>
                <h2 class="section-title">Application Process</h2>
            </div>
            <?php if ($selected_course->post_content) : ?>
            <div style="background: var(--card-bg); padding: 35px; border-radius: 20px; border: 1px solid var(--border-color); margin-bottom: 60px;">
                <div class="rich-content"><?php echo apply_filters('the_content', $selected_course->post_content); ?></div>
            </div>
            <?php else : ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-bottom: 60px;">
                <?php
                $steps = array('Choose your desired course', 'Complete the online application form', 'Submit required documents', 'Wait for assessment and offer letter');
                foreach ($steps as $index => $step) :
                ?>
                <div style="background: var(--card-bg); padding: 30px; border-radius: 16px; border: 1px solid var(--border-color); text-align: left;" class="stat-card">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 20px; margin-bottom: 20px;"><?php echo $index + 1; ?></div>
                    <p style="color: var(--text-muted); margin: 0; font-size: 15px; line-height: 1.6;"><?php echo esc_html($step); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Entry Requirements -->
            <div class="section-alt" style="padding: 80px 0;">
                <div class="section-header">
                    <span class="section-badge">Requirements</span>
                    <h2 class="section-title">Entry Requirements</h2>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; max-width: 1000px; margin: 0 auto;">
                    <div style="background: var(--card-bg); padding: 35px; border-radius: 20px; border: 1px solid var(--border-color);">
                        <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 25px; color: var(--text-dark); display: flex; align-items: center; gap: 12px;">
                            <span style="width: 50px; height: 50px; background: linear-gradient(135deg, #077E86 0%, #2A7970 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">🇦🇺</span>
                            Domestic Students
                        </h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 15px 0; color: var(--text-muted); border-bottom: 1px solid var(--border-color); display: flex; align-items: flex-start; gap: 12px; font-size: 15px;">
                                <span style="color: var(--primary); font-size: 18px; font-weight: 700;">✓</span>
                                Completion of Year 12 or equivalent
                            </li>
                            <li style="padding: 15px 0; color: var(--text-muted); border-bottom: 1px solid var(--border-color); display: flex; align-items: flex-start; gap: 12px; font-size: 15px;">
                                <span style="color: var(--primary); font-size: 18px; font-weight: 700;">✓</span>
                                English Language Proficiency
                            </li>
                            <li style="padding: 15px 0; color: var(--text-muted); display: flex; align-items: flex-start; gap: 12px; font-size: 15px;">
                                <span style="color: var(--primary); font-size: 18px; font-weight: 700;">✓</span>
                                Minimum 18 years of age
                            </li>
                        </ul>
                    </div>

                    <div style="background: var(--card-bg); padding: 35px; border-radius: 20px; border: 1px solid var(--border-color);">
                        <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 25px; color: var(--text-dark); display: flex; align-items: center; gap: 12px;">
                            <span style="width: 50px; height: 50px; background: linear-gradient(135deg, #172566 0%, #1e3170 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">🌍</span>
                            International Students
                        </h3>
                        <ul style="list-style: none; padding: 0;">
                            <li style="padding: 15px 0; color: var(--text-muted); border-bottom: 1px solid var(--border-color); display: flex; align-items: flex-start; gap: 12px; font-size: 15px;">
                                <span style="color: var(--primary); font-size: 18px; font-weight: 700;">✓</span>
                                Valid Passport
                            </li>
                            <li style="padding: 15px 0; color: var(--text-muted); border-bottom: 1px solid var(--border-color); display: flex; align-items: flex-start; gap: 12px; font-size: 15px;">
                                <span style="color: var(--primary); font-size: 18px; font-weight: 700;">✓</span>
                                IELTS 5.5 (no band below 5.0) or equivalent
                            </li>
                            <li style="padding: 15px 0; color: var(--text-muted); display: flex; align-items: flex-start; gap: 12px; font-size: 15px;">
                                <span style="color: var(--primary); font-size: 18px; font-weight: 700;">✓</span>
                                Overseas Student Health Cover
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Fees & Payment -->
            <div class="section-header" style="margin-top: 60px;">
                <span class="section-badge">Fees</span>
                <h2 class="section-title">Fees & Payment Plans</h2>
            </div>
            <div style="background: var(--card-bg); padding: 40px; border-radius: 20px; border: 1px solid var(--border-color); max-width: 800px; margin: 0 auto 60px; text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 30px; flex-wrap: wrap;">
                    <div>
                        <span style="font-size: 48px; font-weight: 700; color: var(--primary);">$<?php echo $fee ? number_format($fee, 0) : 'TBA'; ?></span>
                        <p style="color: var(--text-muted); font-size: 16px;">Total Tuition Fee</p>
                    </div>
                    <div style="text-align: left; padding-left: 30px; border-left: 2px solid var(--border-color);">
                        <p style="color: var(--text-muted); margin-bottom: 10px;">Payment Options:</p>
                        <ul style="list-style: none; padding: 0; color: var(--text-muted);">
                            <li style="margin-bottom: 8px;">✓ Full payment upfront</li>
                            <li style="margin-bottom: 8px;">✓ Semester-based payments</li>
                            <li>✓ Monthly payment plans available</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <?php fusion_college_cta_section('Ready to Apply?', 'Start your application for ' . esc_html($selected_course->post_title) . ' today.', 'Apply Now', get_permalink(get_page_by_path('contact')), 'View Course Details', get_permalink($selected_course->ID)); ?>
        </div>
        <?php else : ?>
        <!-- Default content when no course selected -->
        <div class="fade-in">
            <div>
                <div class="section-header">
                    <span class="section-badge">How to Apply</span>
                    <h2 class="section-title">Simple Steps to Join Us</h2>
                    <p class="section-subtitle">Our application process is straightforward and designed to help you get started quickly.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">1</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Choose Your Course</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Browse our courses and select the one that matches your career goals and interests.</p>
                    </div>

                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">2</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Submit Application</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Complete our online application form and submit the required documents.</p>
                    </div>

                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">3</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Assessment</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Our admissions team will review your application and conduct any required assessments.</p>
                    </div>

                    <div class="stat-card fade-in" style="text-align: left; padding: 35px;">
                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 700; margin-bottom: 20px;">4</div>
                        <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Enroll & Begin</h4>
                        <p style="font-size: 15px; color: var(--text-muted); line-height: 1.7;">Accept your offer, complete enrollment, and start your learning journey.</p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 60px;">
                    <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-primary" style="padding: 18px 45px; font-size: 16px;">Browse All Courses</a>
                </div>
            </div>

            <?php fusion_college_cta_section('Still Have Questions?', 'Our admissions team is here to help you every step of the way.', 'Contact Admissions', get_permalink(get_page_by_path('contact'))); ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
