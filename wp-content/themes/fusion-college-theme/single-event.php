<?php
/**
 * Single Event Template
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
                <span>/</span>
                <a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>">Events</a>
                <span>/</span>
                <span class="current"><?php the_title(); ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
        </div>
    </section>

    <!-- Event Detail -->
    <section class="section">
        <div class="container">
            <div class="event-detail-grid">
                <!-- Main Content -->
                <div class="event-main-content">
                    
                    <!-- Event Image -->
                    <?php if (has_post_thumbnail()) { ?>
                    <div class="event-featured-image fade-in">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                    <?php } ?>

                    <!-- Event Content -->
                    <div class="event-section fade-in">
                        <h2>About This Event</h2>
                        <div class="event-content">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="event-section fade-in">
                        <h2>Event Details</h2>
                        <div class="event-details-grid">
                            <?php
                                $event_date = get_post_meta(get_the_ID(), '_event_date', true);
        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
        $location = get_post_meta(get_the_ID(), '_event_location', true);
        $organizer = get_post_meta(get_the_ID(), '_event_organizer', true);
        $contact_email = get_post_meta(get_the_ID(), '_event_contact_email', true);
        $contact_phone = get_post_meta(get_the_ID(), '_event_contact_phone', true);
        ?>
                            
                            <?php if ($event_date) { ?>
                            <div class="detail-item">
                                <span class="detail-icon">📅</span>
                                <div>
                                    <strong>Date</strong>
                                    <p><?php echo date('l, F j, Y', strtotime($event_date)); ?></p>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <?php if ($event_time) { ?>
                            <div class="detail-item">
                                <span class="detail-icon">⏰</span>
                                <div>
                                    <strong>Time</strong>
                                    <p><?php echo esc_html($event_time); ?></p>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <?php if ($location) { ?>
                            <div class="detail-item">
                                <span class="detail-icon">📍</span>
                                <div>
                                    <strong>Location</strong>
                                    <p><?php echo esc_html($location); ?></p>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <?php if ($organizer) { ?>
                            <div class="detail-item">
                                <span class="detail-icon">👤</span>
                                <div>
                                    <strong>Organizer</strong>
                                    <p><?php echo esc_html($organizer); ?></p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <?php if ($contact_email || $contact_phone) { ?>
                    <div class="event-section fade-in">
                        <h2>Contact Information</h2>
                        <div class="event-contact-info">
                            <?php if ($contact_phone) { ?>
                            <p>📞 <a href="tel:<?php echo esc_attr($contact_phone); ?>"><?php echo esc_html($contact_phone); ?></a></p>
                            <?php } ?>
                            <?php if ($contact_email) { ?>
                            <p>✉️ <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <!-- Sidebar -->
                <aside class="event-sidebar">
                    <!-- Registration Form -->
                    <div class="event-sidebar-card" id="register">
                        <h3>Register for This Event</h3>
                        
                        <?php if (isset($_GET['registered']) && $_GET['registered'] == '1') { ?>
                        <div class="alert alert-success">
                            <p>Thank you for registering! We'll be in touch soon.</p>
                        </div>
                        <?php } ?>

                        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                            <input type="hidden" name="action" value="event_registration_form">
                            <input type="hidden" name="event_id" value="<?php echo esc_attr(get_the_ID()); ?>">
                            <?php wp_nonce_field('event_registration_form_nonce', 'event_registration_nonce'); ?>

                            <div class="form-group">
                                <label>First Name *</label>
                                <input type="text" name="first_name" required>
                            </div>

                            <div class="form-group">
                                <label>Last Name *</label>
                                <input type="text" name="last_name" required>
                            </div>

                            <div class="form-group">
                                <label>Email Address *</label>
                                <input type="email" name="email" required>
                            </div>

                            <div class="form-group">
                                <label>Phone Number *</label>
                                <input type="tel" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label>Organization</label>
                                <input type="text" name="organization">
                            </div>

                            <div class="form-group">
                                <label>Special Requirements</label>
                                <textarea name="special_requirements" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-full">Register Now</button>
                        </form>
                    </div>

                    <!-- Share -->
                    <div class="event-sidebar-card">
                        <h3>Share This Event</h3>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn facebook">📘 Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-btn twitter">🐦 Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn linkedin">💼 LinkedIn</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <?php } ?>
</main>

<style>
.event-detail-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 50px;
}

.event-featured-image {
    margin-bottom: 40px;
    border-radius: 16px;
    overflow: hidden;
}

.event-featured-image img {
    width: 100%;
    height: auto;
}

.event-section {
    margin-bottom: 40px;
}

.event-section h2 {
    font-size: 24px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--border-color);
}

.event-content {
    font-size: 16px;
    line-height: 1.8;
    color: var(--text-muted);
}

.event-details-grid {
    display: grid;
    gap: 20px;
}

.detail-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 20px;
    background: var(--card-bg);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.detail-icon {
    font-size: 24px;
    flex-shrink: 0;
}

.detail-item strong {
    display: block;
    color: var(--text-dark);
    margin-bottom: 5px;
}

.detail-item p {
    color: var(--text-muted);
    margin: 0;
}

.event-contact-info p {
    margin-bottom: 10px;
    font-size: 16px;
}

.event-contact-info a {
    color: var(--primary);
}

/* Sidebar */
.event-sidebar-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 10px 40px var(--shadow);
    border: 1px solid var(--border-color);
    margin-bottom: 30px;
    position: sticky;
    top: 100px;
}

.event-sidebar-card h3 {
    font-size: 20px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--border-color);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
    color: var(--text-dark);
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 15px;
    background: var(--bg-light);
    color: var(--text-dark);
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
}

.btn-full {
    width: 100%;
}

.alert {
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.share-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.share-btn {
    display: block;
    padding: 12px 20px;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    transition: all 0.3s ease;
}

.share-btn.facebook {
    background: #1877f2;
    color: white;
}

.share-btn.twitter {
    background: #1da1f2;
    color: white;
}

.share-btn.linkedin {
    background: #0a66c2;
    color: white;
}

.share-btn:hover {
    opacity: 0.9;
    transform: translateX(5px);
}

@media (max-width: 1024px) {
    .event-detail-grid {
        grid-template-columns: 1fr;
    }
    
    .event-sidebar {
        order: -1;
    }
    
    .event-sidebar-card {
        position: static;
    }
}
</style>

<?php get_footer(); ?>
