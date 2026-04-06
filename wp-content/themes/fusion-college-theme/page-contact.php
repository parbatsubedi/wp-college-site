<?php
/*
Template Name: Contact Page
*/

get_header();
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <p>Get in touch with us for any inquiries about our courses and programs.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="grid grid-2">
                <!-- Contact Form -->
                <div class="contact-form-container">
                    <h2>Send us a Message</h2>

                    <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                        <div class="success-message">
                            <p>Thank you for your message! We'll get back to you soon.</p>
                        </div>
                    <?php endif; ?>

                    <form class="contact-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
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
                                <input type="text" id="subject" name="subject" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="contact-info">
                    <h2>Contact Information</h2>

                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div>
                                <h4>Phone</h4>
                                <p><?php echo get_theme_mod('contact_phone', '1300 123 456'); ?></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">✉️</div>
                            <div>
                                <h4>Email</h4>
                                <p><?php echo get_theme_mod('contact_email', 'info@pacificinstitute.edu.au'); ?></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <div>
                                <h4>Address</h4>
                                <p><?php echo get_theme_mod('contact_address', 'Sydney, Australia'); ?></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">🏢</div>
                            <div>
                                <h4>Office Hours</h4>
                                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p>Saturday: 9:00 AM - 2:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Map Placeholder -->
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.743!2d151.2099!3d-33.8688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae67c73f4b9f%3A0x8c6b8b7b7b7b7b7b!2sSydney%20NSW%2C%20Australia!5e0!3m2!1sen!2s!4v1634567890123!5m2!1sen!2s"
                            width="100%"
                            height="300"
                            style="border:0; border-radius: 8px;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.page-header {
    background: linear-gradient(135deg, #077E86, #2A7970);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.contact-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.contact-form-container h2,
.contact-info h2 {
    color: #077E86;
    margin-bottom: 30px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.contact-form {
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.success-message {
    background: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
}

.contact-info {
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.contact-details {
    margin-bottom: 40px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
    gap: 15px;
}

.contact-icon {
    font-size: 24px;
    color: #077E86;
    flex-shrink: 0;
}

.contact-item h4 {
    margin: 0 0 5px;
    color: #077E86;
}

.contact-item p {
    margin: 0;
    color: #666;
}

.map-container {
    margin-top: 30px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }

    .grid-2 {
        grid-template-columns: 1fr;
        gap: 40px;
    }
}
</style>

<?php get_footer(); ?>