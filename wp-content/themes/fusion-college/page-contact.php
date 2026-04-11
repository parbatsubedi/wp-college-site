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
                    <div class="contact-info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                    <div class="contact-info-content">
                        <h4>Address</h4>
                        <p>Level 5, 16-18 Wentworth Street<br>Parramatta NSW 2150, Australia</p>
                    </div>
                </div>

                <div class="contact-info-card fade-in">
                    <div class="contact-info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 002.37 7.38 2 2 0 01-.45 2.32L8 16a2 2 0 012 2v2a2 2 0 01-2 2h-.06a19.68 19.68 0 01-1.21-3.08A2 2 0 015 9a2 2 0 012-2h3z"/></svg></div>
                    <div class="contact-info-content">
                        <h4>Phone</h4>
                        <p id="contactPhoneInfo">1300 123 456<br>+61 2 7806 8110</p>
                    </div>
                </div>

                <div class="contact-info-card fade-in">
                    <div class="contact-info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
                    <div class="contact-info-content">
                        <h4>Email</h4>
                        <p id="contactEmailInfo">info@fusioncollege.edu.au<br>admissions@fusioncollege.edu.au</p>
                    </div>
                </div>

                <div class="contact-info-card fade-in">
                    <div class="contact-info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
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
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3314.740968718644!2d151.0030679769348!3d-33.81899711648308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xae88cffb7e3d8165%3A0x839d7dc306d0073e!2sFusion%20College%20of%20Technology!5e0!3m2!1sen!2snp!4v1775886283539!5m2!1sen!2snp"
                width="100%" 
                height="450" 
                style="border:0; border-radius: 20px; box-shadow: 0 20px 60px var(--shadow);" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"
                title="Fusion College Location">
            </iframe>
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
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; margin-bottom: 20px;"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/></svg></div>
                <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Sydney Campus</h4>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                    Level 5, 16-18 Wentworth Street<br>Parramatta NSW 2150
                </p>
                <p style="font-size: 14px; color: var(--text-muted);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle;"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 002.37 7.38 2 2 0 01-.45 2.32L8 16a2 2 0 012 2v2a2 2 0 01-2 2h-.06a19.68 19.68 0 01-1.21-3.08A2 2 0 015 9a2 2 0 012-2h3z"/></svg> +61 2 7806 8110
                </p>
            </div>

            <div class="stat-card fade-in" style="text-align: left; padding: 30px;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; margin-bottom: 20px;"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/></svg></div>
                <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Melbourne Campus</h4>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                    Level 8, 456 Collins Street<br>Melbourne VIC 3000
                </p>
                <p style="font-size: 14px; color: var(--text-muted);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle;"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 002.37 7.38 2 2 0 01-.45 2.32L8 16a2 2 0 012 2v2a2 2 0 01-2 2h-.06a19.68 19.68 0 01-1.21-3.08A2 2 0 015 9a2 2 0 012-2h3z"/></svg> +61 3 9000 0000
                </p>
            </div>

            <div class="stat-card fade-in" style="text-align: left; padding: 30px;">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #172566 0%, #1e3170 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; margin-bottom: 20px;"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg></div>
                <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Online Learning</h4>
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                    Study from anywhere with our online courses
                </p>
                <p style="font-size: 14px; color: var(--text-muted);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle;"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 002.37 7.38 2 2 0 01-.45 2.32L8 16a2 2 0 012 2v2a2 2 0 01-2 2h-.06a19.68 19.68 0 01-1.21-3.08A2 2 0 015 9a2 2 0 012-2h3z"/></svg> 1300 123 456
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>