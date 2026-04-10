<?php
/**
 * Template Name: Contact Page
 */

get_header();
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    'Contact Us',
    "We're here to help. Get in touch with us for any inquiries",
    array(array('label' => 'Contact'))
); ?>

<!-- Page Content (Elementor / Gutenberg) -->
<?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile; endif; wp_reset_postdata(); ?>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div>
                <div class="fade-in">
                    <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 20px; color: var(--text-dark);">Get in Touch</h2>
                    <p style="font-size: 16px; color: var(--text-muted); line-height: 1.8; margin-bottom: 40px;">
                        Have questions about our courses, admissions, or anything else? Our friendly team is here to help you.
                    </p>
                </div>

                <div class="contact-info-card fade-in">
                    <div class="contact-info-icon">📍</div>
                    <div class="contact-info-content">
                        <h4>Address</h4>
                        <p><?php echo nl2br(esc_html(fusion_college_address())); ?></p>
                    </div>
                </div>

                <div class="contact-info-card fade-in">
                    <div class="contact-info-icon">📞</div>
                    <div class="contact-info-content">
                        <h4>Phone</h4>
                        <p id="contactPhoneInfo"><?php echo esc_html(fusion_college_phone()); ?></p>
                    </div>
                </div>

                <div class="contact-info-card fade-in">
                    <div class="contact-info-icon">✉️</div>
                    <div class="contact-info-content">
                        <h4>Email</h4>
                        <p id="contactEmailInfo"><?php echo esc_html(fusion_college_email()); ?></p>
                    </div>
                </div>

                <div class="contact-info-card fade-in">
                    <div class="contact-info-icon">🕐</div>
                    <div class="contact-info-content">
                        <h4>Office Hours</h4>
                        <p>Monday - Friday: 9:00 AM - 5:00 PM<br>Saturday: By appointment</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="fade-in">
                <div class="contact-form">
                    <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 25px; color: var(--text-dark);">Send us a Message</h3>
                    <form id="contactForm">
                        <?php wp_nonce_field('fusion-college-nonce', 'nonce'); ?>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="course">Course Inquiry</option>
                                    <option value="admission">Admissions</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="support">Student Support</option>
                                    <option value="feedback">Feedback</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="map-container fade-in">
            <div class="map-placeholder">
                <div style="text-align: center; color: var(--text-muted);">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin-bottom: 15px;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <p>Map placeholder - Interactive map coming soon</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Campuses -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Our Campuses</span>
            <h2 class="section-title">Visit Us</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <div class="stat-card fade-in" style="text-align: left; padding: 30px;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin-bottom: 20px;">🏫</div>
                <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Sydney Campus</h4>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                    Level 5, 123 George Street<br>Sydney NSW 2000
                </p>
                <p style="font-size: 14px; color: var(--text-muted);">
                    📞 +61 2 9000 0000
                </p>
            </div>

            <div class="stat-card fade-in" style="text-align: left; padding: 30px;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin-bottom: 20px;">🏫</div>
                <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Melbourne Campus</h4>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                    Level 8, 456 Collins Street<br>Melbourne VIC 3000
                </p>
                <p style="font-size: 14px; color: var(--text-muted);">
                    📞 +61 3 9000 0000
                </p>
            </div>

            <div class="stat-card fade-in" style="text-align: left; padding: 30px;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #172566 0%, #1e3170 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin-bottom: 20px;">🌐</div>
                <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Online Learning</h4>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                    Study from anywhere with our online courses
                </p>
                <p style="font-size: 14px; color: var(--text-muted);">
                    📞 <?php echo esc_html(fusion_college_phone()); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
