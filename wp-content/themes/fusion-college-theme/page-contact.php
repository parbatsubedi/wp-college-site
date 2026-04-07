<?php
/**
 * Contact Page Template
 * Fully dynamic using Customizer settings and shortcodes
 */
get_header();
?>

<main class="site-main">
    
    <!-- Page Banner -->
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <h1><?php the_title(); ?></h1>
                <p>Get in touch with us for any inquiries</p>
                <div class="breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="contact-grid">
                
                <!-- Contact Info -->
                <div class="fade-in">
                    <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 20px; color: var(--text-dark);">Get in Touch</h2>
                    <p style="font-size: 16px; color: var(--text-muted); line-height: 1.8; margin-bottom: 40px;">
                        Have questions about our courses, admissions, or anything else? Our friendly team is here to help you.
                    </p>
                    
                    <?php echo do_shortcode('[fusion_contact_info]'); ?>
                </div>

                <!-- Contact Form -->
                <div class="fade-in">
                    <div class="contact-form">
                        <h3 style="font-size: 24px; font-weight: 700; margin-bottom: 25px; color: var(--text-dark);">Send us a Message</h3>
                        
                        <?php if (isset($_GET['success']) && $_GET['success'] == '1') { ?>
                        <div class="alert alert-success">
                            <p>Thank you for your message! We'll get back to you soon.</p>
                        </div>
                        <?php } ?>

                        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                            <input type="hidden" name="action" value="contact_form">
                            <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>

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
                                        <option value="Course Inquiry">Course Inquiry</option>
                                        <option value="Admissions">Admissions</option>
                                        <option value="General Inquiry">General Inquiry</option>
                                        <option value="Student Support">Student Support</option>
                                        <option value="Feedback">Feedback</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="6" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campuses Section -->
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
                        📞 <?php echo esc_html(fusion_get_contact_info()['phone']); ?>
                    </p>
                </div>

                <div class="stat-card fade-in" style="text-align: left; padding: 30px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin-bottom: 20px;">🏢</div>
                    <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Melbourne Campus</h4>
                    <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                        Level 8, 456 Collins Street<br>Melbourne VIC 3000
                    </p>
                    <p style="font-size: 14px; color: var(--text-muted);">
                        📞 1300 123 456
                    </p>
                </div>

                <div class="stat-card fade-in" style="text-align: left; padding: 30px;">
                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #172566 0%, #1e3170 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; margin-bottom: 20px;">🌐</div>
                    <h4 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px;">Online Learning</h4>
                    <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 15px;">
                        Study from anywhere with our online courses
                    </p>
                    <p style="font-size: 14px; color: var(--text-muted);">
                        📞 1300 123 456
                    </p>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}

.contact-form {
    background: var(--card-bg);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 40px var(--shadow);
    border: 1px solid var(--border-color);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--text-dark);
    font-size: 14px;
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 14px 16px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: var(--bg-light);
    color: var(--text-dark);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(7, 126, 134, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 150px;
}

.alert {
    padding: 16px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.campus-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.campus-card {
    background: var(--card-bg);
    padding: 35px;
    border-radius: 16px;
    text-align: center;
    border: 1px solid var(--border-color);
    transition: transform 0.3s ease;
}

.campus-card:hover {
    transform: translateY(-5px);
}

.campus-icon {
    font-size: 48px;
    margin-bottom: 20px;
}

.campus-card h4 {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 15px;
    color: var(--text-dark);
}

.campus-card p {
    font-size: 14px;
    color: var(--text-muted);
    line-height: 1.6;
    margin-bottom: 10px;
}

@media (max-width: 1024px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .campus-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .campus-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
