<?php
/*
Template Name: Admissions Page
*/
get_header();
?>

<main>
    <!-- Hero Section -->
    <section class="admissions-hero">
        <div class="container">
            <div class="hero-content">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_the_excerpt(); ?></p>
                <div class="hero-actions">
                    <a href="#apply" class="btn btn-primary">Apply Now</a>
                    <a href="#requirements" class="btn btn-secondary">View Requirements</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Admissions Content -->
    <section class="admissions-content">
        <div class="container">
            <div class="content-wrapper">
                <!-- Main Content -->
                <div class="main-content">
                    <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; endif; ?>

                    <!-- Application Process -->
                    <div class="application-process-section" id="process">
                        <h2>Application Process</h2>
                        <div class="process-steps">
                            <div class="process-step">
                                <div class="step-number">1</div>
                                <h3>Choose Your Course</h3>
                                <p>Browse our courses and select the program that best fits your goals and interests.</p>
                                <a href="<?php echo get_post_type_archive_link('course'); ?>" class="step-link">View Courses</a>
                            </div>

                            <div class="process-step">
                                <div class="step-number">2</div>
                                <h3>Check Requirements</h3>
                                <p>Review the entry requirements and ensure you meet the criteria for your chosen course.</p>
                                <a href="#requirements" class="step-link">View Requirements</a>
                            </div>

                            <div class="process-step">
                                <div class="step-number">3</div>
                                <h3>Submit Application</h3>
                                <p>Complete and submit your application form with all required documents.</p>
                                <a href="#apply" class="step-link">Apply Now</a>
                            </div>

                            <div class="process-step">
                                <div class="step-number">4</div>
                                <h3>Assessment & Interview</h3>
                                <p>Your application will be reviewed and you may be invited for an interview or assessment.</p>
                            </div>

                            <div class="process-step">
                                <div class="step-number">5</div>
                                <h3>Receive Offer</h3>
                                <p>If successful, you'll receive a formal offer letter with enrollment instructions.</p>
                            </div>

                            <div class="process-step">
                                <div class="step-number">6</div>
                                <h3>Enroll & Start</h3>
                                <p>Accept your offer, complete enrollment, and begin your educational journey.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Entry Requirements -->
                    <div class="requirements-section" id="requirements">
                        <h2>Entry Requirements</h2>

                        <div class="requirements-tabs">
                            <div class="tab-buttons">
                                <button class="tab-btn active" data-tab="domestic">Domestic Students</button>
                                <button class="tab-btn" data-tab="international">International Students</button>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="domestic">
                                    <h3>Domestic Student Requirements</h3>
                                    <div class="requirements-list">
                                        <div class="requirement-item">
                                            <h4>Academic Requirements</h4>
                                            <ul>
                                                <li>Completion of secondary education (Year 12 or equivalent)</li>
                                                <li>Minimum ATAR score as specified by course requirements</li>
                                                <li>English proficiency (if English is not your first language)</li>
                                            </ul>
                                        </div>

                                        <div class="requirement-item">
                                            <h4>English Language Requirements</h4>
                                            <ul>
                                                <li>IELTS: 6.0 overall (no band less than 5.5)</li>
                                                <li>TOEFL iBT: 60</li>
                                                <li>PTE Academic: 50</li>
                                                <li>Equivalent qualifications accepted</li>
                                            </ul>
                                        </div>

                                        <div class="requirement-item">
                                            <h4>Additional Requirements</h4>
                                            <ul>
                                                <li>Valid identification documents</li>
                                                <li>Proof of residency status</li>
                                                <li>Portfolio (for creative courses)</li>
                                                <li>References (if required)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="international">
                                    <h3>International Student Requirements</h3>
                                    <div class="requirements-list">
                                        <div class="requirement-item">
                                            <h4>Academic Requirements</h4>
                                            <ul>
                                                <li>Completion of secondary education equivalent to Australian Year 12</li>
                                                <li>Academic transcripts and certificates</li>
                                                <li>Course-specific prerequisites</li>
                                            </ul>
                                        </div>

                                        <div class="requirement-item">
                                            <h4>English Language Requirements</h4>
                                            <ul>
                                                <li>IELTS: 6.5 overall (no band less than 6.0)</li>
                                                <li>TOEFL iBT: 79</li>
                                                <li>PTE Academic: 58</li>
                                                <li>Cambridge English: 176</li>
                                            </ul>
                                        </div>

                                        <div class="requirement-item">
                                            <h4>Visa & Financial Requirements</h4>
                                            <ul>
                                                <li>Valid student visa</li>
                                                <li>Financial capacity proof</li>
                                                <li>Health insurance (OSHC)</li>
                                                <li>Accommodation arrangements</li>
                                            </ul>
                                        </div>

                                        <div class="requirement-item">
                                            <h4>Additional Documents</h4>
                                            <ul>
                                                <li>Passport copy</li>
                                                <li>Birth certificate</li>
                                                <li>Police clearance certificate</li>
                                                <li>Medical examination results</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Application Form -->
                    <div class="application-form-section" id="apply">
                        <h2>Apply Now</h2>

                        <?php if (isset($_GET['applied']) && $_GET['applied'] == '1'): ?>
                            <div class="success-message">
                                <p>Thank you for your application! We'll review it and get back to you within 5-7 business days.</p>
                            </div>
                        <?php endif; ?>

                        <form class="application-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                            <input type="hidden" name="action" value="admission_application_form">
                            <?php wp_nonce_field('admission_application_form_nonce', 'admission_application_nonce'); ?>

                            <div class="form-section">
                                <h3>Personal Information</h3>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="first_name">First Name *</label>
                                        <input type="text" id="first_name" name="first_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name">Last Name *</label>
                                        <input type="text" id="last_name" name="last_name" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone Number *</label>
                                        <input type="tel" id="phone" name="phone" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth *</label>
                                        <input type="date" id="date_of_birth" name="date_of_birth" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nationality">Nationality *</label>
                                        <input type="text" id="nationality" name="nationality" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h3>Course Selection</h3>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="preferred_course">Preferred Course *</label>
                                        <select id="preferred_course" name="preferred_course" required>
                                            <option value="">Select a course</option>
                                            <?php
                                            $courses = get_posts(array(
                                                'post_type' => 'course',
                                                'posts_per_page' => -1,
                                                'orderby' => 'title',
                                                'order' => 'ASC'
                                            ));
                                            foreach ($courses as $course) {
                                                echo '<option value="' . esc_attr($course->ID) . '">' . esc_html($course->post_title) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="study_mode">Preferred Study Mode</label>
                                        <select id="study_mode" name="study_mode">
                                            <option value="">Select study mode</option>
                                            <option value="full-time">Full Time</option>
                                            <option value="part-time">Part Time</option>
                                            <option value="online">Online</option>
                                            <option value="blended">Blended</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Preferred Start Date</label>
                                    <select id="start_date" name="start_date">
                                        <option value="">Select start date</option>
                                        <option value="2024-semester-1">Semester 1, 2024</option>
                                        <option value="2024-semester-2">Semester 2, 2024</option>
                                        <option value="2025-semester-1">Semester 1, 2025</option>
                                        <option value="2025-semester-2">Semester 2, 2025</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-section">
                                <h3>Educational Background</h3>
                                <div class="form-group">
                                    <label for="highest_qualification">Highest Qualification *</label>
                                    <select id="highest_qualification" name="highest_qualification" required>
                                        <option value="">Select qualification</option>
                                        <option value="year-12">Year 12</option>
                                        <option value="certificate">Certificate</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="bachelor">Bachelor Degree</option>
                                        <option value="masters">Masters Degree</option>
                                        <option value="phd">PhD</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="institution">Institution Name</label>
                                    <input type="text" id="institution" name="institution" placeholder="School/University attended">
                                </div>

                                <div class="form-group">
                                    <label for="graduation_year">Year of Completion</label>
                                    <input type="number" id="graduation_year" name="graduation_year" min="1950" max="2030">
                                </div>

                                <div class="form-group">
                                    <label for="english_proficiency">English Proficiency</label>
                                    <select id="english_proficiency" name="english_proficiency">
                                        <option value="">Select level</option>
                                        <option value="native">Native Speaker</option>
                                        <option value="ielts-7">IELTS 7.0+</option>
                                        <option value="ielts-65">IELTS 6.5</option>
                                        <option value="ielts-6">IELTS 6.0</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-section">
                                <h3>Additional Information</h3>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" name="address" rows="3" placeholder="Your full address"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="emergency_contact">Emergency Contact</label>
                                    <input type="text" id="emergency_contact" name="emergency_contact" placeholder="Name and relationship">
                                </div>

                                <div class="form-group">
                                    <label for="emergency_phone">Emergency Contact Phone</label>
                                    <input type="tel" id="emergency_phone" name="emergency_phone">
                                </div>

                                <div class="form-group">
                                    <label for="special_needs">Special Needs or Requirements</label>
                                    <textarea id="special_needs" name="special_needs" rows="3" placeholder="Any special assistance or requirements you may need"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="how_did_you_hear">How did you hear about us?</label>
                                    <select id="how_did_you_hear" name="how_did_you_hear">
                                        <option value="">Select option</option>
                                        <option value="website">Website</option>
                                        <option value="social-media">Social Media</option>
                                        <option value="friend">Friend/Family</option>
                                        <option value="advertisement">Advertisement</option>
                                        <option value="school">School Counselor</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="terms_agreed" required>
                                        I agree to the <a href="#" target="_blank">Terms and Conditions</a> and <a href="#" target="_blank">Privacy Policy</a> *
                                    </label>
                                </div>

                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="information_accurate" required>
                                        I certify that the information provided is true and accurate *
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="admissions-sidebar">
                    <!-- Quick Facts -->
                    <div class="sidebar-widget">
                        <h3>Application Facts</h3>
                        <ul class="facts-list">
                            <li><strong>Processing Time:</strong> 5-7 business days</li>
                            <li><strong>Application Fee:</strong> $100 (refundable)</li>
                            <li><strong>Intake Periods:</strong> Feb, Jul, Nov</li>
                            <li><strong>Scholarships:</strong> Available for eligible students</li>
                        </ul>
                    </div>

                    <!-- Important Dates -->
                    <div class="sidebar-widget">
                        <h3>Important Dates</h3>
                        <div class="dates-list">
                            <div class="date-item">
                                <h4>Semester 1, 2024</h4>
                                <p>Applications close: January 15, 2024</p>
                                <p>Classes start: February 26, 2024</p>
                            </div>

                            <div class="date-item">
                                <h4>Semester 2, 2024</h4>
                                <p>Applications close: June 15, 2024</p>
                                <p>Classes start: July 22, 2024</p>
                            </div>

                            <div class="date-item">
                                <h4>Semester 1, 2025</h4>
                                <p>Applications close: January 15, 2025</p>
                                <p>Classes start: February 24, 2025</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="sidebar-widget">
                        <h3>Need Help?</h3>
                        <p>Our admissions team is here to assist you with your application.</p>
                        <ul class="contact-info">
                            <li><strong>Phone:</strong> <a href="tel:+1234567890">(123) 456-7890</a></li>
                            <li><strong>Email:</strong> <a href="mailto:admissions@college.edu">admissions@college.edu</a></li>
                            <li><strong>Office Hours:</strong> Mon-Fri 9AM-5PM</li>
                        </ul>
                        <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn btn-secondary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.admissions-hero {
    background: linear-gradient(135deg, #077E86, #2A7970);
    color: white;
    padding: 100px 0;
    text-align: center;
}

.admissions-hero h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

.admissions-hero p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto 30px;
}

.hero-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.admissions-content {
    padding: 80px 0;
}

.content-wrapper {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
}

.page-content {
    margin-bottom: 60px;
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.application-process-section h2,
.requirements-section h2,
.application-form-section h2 {
    color: #077E86;
    margin-bottom: 30px;
    border-bottom: 2px solid #077E86;
    padding-bottom: 10px;
}

.process-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.process-step {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
    position: relative;
}

.step-number {
    width: 50px;
    height: 50px;
    background: #077E86;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0 auto 20px;
}

.process-step h3 {
    color: #077E86;
    margin-bottom: 15px;
}

.process-step p {
    color: #666;
    margin-bottom: 20px;
    line-height: 1.5;
}

.step-link {
    color: #077E86;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 1px solid transparent;
    transition: border-color 0.3s ease;
}

.step-link:hover {
    border-bottom-color: #077E86;
}

.requirements-tabs {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.tab-buttons {
    display: flex;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.tab-btn {
    flex: 1;
    padding: 15px 20px;
    background: none;
    border: none;
    cursor: pointer;
    font-weight: 600;
    color: #666;
    transition: all 0.3s ease;
}

.tab-btn.active {
    background: #077E86;
    color: white;
}

.tab-content {
    padding: 30px;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.requirements-list {
    display: grid;
    gap: 30px;
}

.requirement-item h4 {
    color: #077E86;
    margin-bottom: 15px;
    border-bottom: 1px solid #077E86;
    padding-bottom: 5px;
}

.requirement-item ul {
    list-style: none;
    padding: 0;
}

.requirement-item li {
    padding: 5px 0;
    position: relative;
    padding-left: 20px;
}

.requirement-item li:before {
    content: "✓";
    color: #077E86;
    font-weight: bold;
    position: absolute;
    left: 0;
}

.application-form {
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid #eee;
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 30px;
}

.form-section h3 {
    color: #077E86;
    margin-bottom: 20px;
    border-bottom: 2px solid #077E86;
    padding-bottom: 10px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #077E86;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.checkbox-group {
    margin-bottom: 15px;
}

.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-weight: normal;
    cursor: pointer;
}

.checkbox-label input[type="checkbox"] {
    width: auto;
    margin: 0;
}

.checkbox-label a {
    color: #077E86;
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 20px;
    border-radius: 5px;
    margin-bottom: 30px;
    border: 1px solid #c3e6cb;
}

.admissions-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-widget {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.sidebar-widget h3 {
    color: #077E86;
    margin-bottom: 20px;
    border-bottom: 2px solid #077E86;
    padding-bottom: 10px;
}

.facts-list {
    list-style: none;
    padding: 0;
}

.facts-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}

.facts-list strong {
    color: #077E86;
}

.dates-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.date-item {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.date-item h4 {
    color: #077E86;
    margin: 0 0 8px;
}

.date-item p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.contact-info {
    list-style: none;
    padding: 0;
    margin-bottom: 20px;
}

.contact-info li {
    margin-bottom: 8px;
    color: #666;
}

.contact-info a {
    color: #077E86;
    text-decoration: none;
}

@media (max-width: 768px) {
    .content-wrapper {
        grid-template-columns: 1fr;
    }

    .hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .process-steps {
        grid-template-columns: 1fr;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .tab-buttons {
        flex-direction: column;
    }

    .admissions-hero h1 {
        font-size: 2.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');

            // Remove active class from all buttons and panes
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Add active class to clicked button and corresponding pane
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });
});
</script>

<?php get_footer(); ?>