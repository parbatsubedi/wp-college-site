<?php get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        <!-- Event Header -->
        <section class="event-header">
            <div class="container">
                <div class="event-header-content">
                    <div class="event-info">
                        <h1><?php the_title(); ?></h1>
                        <div class="event-meta">
                            <?php
                            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                            $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                            $location = get_post_meta(get_the_ID(), '_event_location', true);
                            $organizer = get_post_meta(get_the_ID(), '_event_organizer', true);
                            $contact_email = get_post_meta(get_the_ID(), '_event_contact_email', true);
                            $contact_phone = get_post_meta(get_the_ID(), '_event_contact_phone', true);
                            $max_attendees = get_post_meta(get_the_ID(), '_event_max_attendees', true);
                            $registration_deadline = get_post_meta(get_the_ID(), '_event_registration_deadline', true);
                            ?>

                            <?php if ($event_date): ?>
                                <span class="meta-item">📅 Date: <?php echo date('F j, Y', strtotime($event_date)); ?></span>
                            <?php endif; ?>

                            <?php if ($event_time): ?>
                                <span class="meta-item">⏰ Time: <?php echo esc_html($event_time); ?></span>
                            <?php endif; ?>

                            <?php if ($location): ?>
                                <span class="meta-item">📍 Location: <?php echo esc_html($location); ?></span>
                            <?php endif; ?>

                            <?php if ($organizer): ?>
                                <span class="meta-item">👤 Organizer: <?php echo esc_html($organizer); ?></span>
                            <?php endif; ?>

                            <?php if ($max_attendees): ?>
                                <span class="meta-item">👥 Max Attendees: <?php echo esc_html($max_attendees); ?></span>
                            <?php endif; ?>

                            <?php if ($registration_deadline): ?>
                                <span class="meta-item">⏳ Registration Deadline: <?php echo date('F j, Y', strtotime($registration_deadline)); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="event-actions">
                            <a href="#register" class="btn btn-primary">Register Now</a>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn-secondary">View All Events</a>
                        </div>
                    </div>

                    <?php if (has_post_thumbnail()): ?>
                        <div class="event-image">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Event Content -->
        <section class="event-content">
            <div class="container">
                <div class="content-grid">
                    <div class="main-content">
                        <div class="event-description">
                            <h2>Event Details</h2>
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <?php
                        $agenda = get_post_meta(get_the_ID(), '_event_agenda', true);
                        if ($agenda):
                        ?>
                            <div class="event-section">
                                <h3>Event Agenda</h3>
                                <div class="agenda-content">
                                    <?php echo wpautop(esc_html($agenda)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $speakers = get_post_meta(get_the_ID(), '_event_speakers', true);
                        if ($speakers):
                        ?>
                            <div class="event-section">
                                <h3>Speakers</h3>
                                <div class="speakers-list">
                                    <?php
                                    $speaker_list = json_decode($speakers, true);
                                    if (is_array($speaker_list)) {
                                        echo '<ul>';
                                        foreach ($speaker_list as $speaker) {
                                            echo '<li>' . esc_html($speaker) . '</li>';
                                        }
                                        echo '</ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $requirements = get_post_meta(get_the_ID(), '_event_requirements', true);
                        if ($requirements):
                        ?>
                            <div class="event-section">
                                <h3>Requirements</h3>
                                <div class="requirements-content">
                                    <?php echo wpautop(esc_html($requirements)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $cost = get_post_meta(get_the_ID(), '_event_cost', true);
                        if ($cost):
                        ?>
                            <div class="event-section">
                                <h3>Cost & Registration</h3>
                                <div class="cost-content">
                                    <?php echo wpautop(esc_html($cost)); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php
                        $additional_info = get_post_meta(get_the_ID(), '_event_additional_info', true);
                        if ($additional_info):
                        ?>
                            <div class="event-section">
                                <h3>Additional Information</h3>
                                <div class="additional-content">
                                    <?php echo wpautop(esc_html($additional_info)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar -->
                    <div class="event-sidebar">
                        <!-- Registration Form -->
                        <div class="registration-widget" id="register">
                            <h3>Register for this Event</h3>

                            <?php if (isset($_GET['registered']) && $_GET['registered'] == '1'): ?>
                                <div class="success-message">
                                    <p>Thank you for registering! We'll send you confirmation details soon.</p>
                                </div>
                            <?php endif; ?>

                            <form class="registration-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                                <input type="hidden" name="action" value="event_registration_form">
                                <input type="hidden" name="event_id" value="<?php echo get_the_ID(); ?>">
                                <?php wp_nonce_field('event_registration_form_nonce', 'event_registration_nonce'); ?>

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
                                    <label for="organization">Organization/School</label>
                                    <input type="text" id="organization" name="organization">
                                </div>

                                <div class="form-group">
                                    <label for="position">Position/Year Level</label>
                                    <input type="text" id="position" name="position">
                                </div>

                                <div class="form-group">
                                    <label for="special_requirements">Special Requirements/Dietary Needs</label>
                                    <textarea id="special_requirements" name="special_requirements" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="additional_attendees">Additional Attendees</label>
                                    <input type="number" id="additional_attendees" name="additional_attendees" min="0" value="0">
                                </div>

                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        </div>

                        <!-- Event Info Widget -->
                        <div class="event-info-widget">
                            <h3>Event Information</h3>
                            <ul class="event-info-list">
                                <?php if ($event_date): ?>
                                    <li><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event_date)); ?></li>
                                <?php endif; ?>

                                <?php if ($event_time): ?>
                                    <li><strong>Time:</strong> <?php echo esc_html($event_time); ?></li>
                                <?php endif; ?>

                                <?php if ($location): ?>
                                    <li><strong>Location:</strong> <?php echo esc_html($location); ?></li>
                                <?php endif; ?>

                                <?php if ($organizer): ?>
                                    <li><strong>Organizer:</strong> <?php echo esc_html($organizer); ?></li>
                                <?php endif; ?>

                                <?php if ($contact_email): ?>
                                    <li><strong>Contact Email:</strong> <a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a></li>
                                <?php endif; ?>

                                <?php if ($contact_phone): ?>
                                    <li><strong>Contact Phone:</strong> <a href="tel:<?php echo esc_attr($contact_phone); ?>"><?php echo esc_html($contact_phone); ?></a></li>
                                <?php endif; ?>

                                <?php if ($max_attendees): ?>
                                    <li><strong>Max Attendees:</strong> <?php echo esc_html($max_attendees); ?></li>
                                <?php endif; ?>

                                <?php if ($registration_deadline): ?>
                                    <li><strong>Registration Deadline:</strong> <?php echo date('F j, Y', strtotime($registration_deadline)); ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- Related Events -->
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'event_category');
                        if ($categories) {
                            $category_ids = wp_list_pluck($categories, 'term_id');
                            $related_args = array(
                                'post_type' => 'event',
                                'posts_per_page' => 3,
                                'post__not_in' => array(get_the_ID()),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'event_category',
                                        'field' => 'term_id',
                                        'terms' => $category_ids
                                    )
                                ),
                                'meta_query' => array(
                                    array(
                                        'key' => '_event_date',
                                        'value' => date('Y-m-d'),
                                        'compare' => '>=',
                                        'type' => 'DATE'
                                    )
                                ),
                                'orderby' => 'meta_value',
                                'order' => 'ASC'
                            );

                            $related_events = new WP_Query($related_args);

                            if ($related_events->have_posts()):
                            ?>
                                <div class="related-events-widget">
                                    <h3>Upcoming Events</h3>
                                    <ul class="related-events-list">
                                        <?php while ($related_events->have_posts()): $related_events->the_post(); ?>
                                            <li>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?php the_title(); ?>">
                                                    <?php endif; ?>
                                                    <div class="related-event-info">
                                                        <h4><?php the_title(); ?></h4>
                                                        <p><?php echo date('M j, Y', strtotime(get_post_meta(get_the_ID(), '_event_date', true))); ?></p>
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
.event-header {
    background: linear-gradient(135deg, #FF6B35, #F7931E);
    color: white;
    padding: 80px 0;
}

.event-header-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
    align-items: center;
}

.event-info h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.event-meta {
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

.event-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.event-image img {
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.event-content {
    padding: 80px 0;
}

.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
}

.event-section {
    margin-bottom: 40px;
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.event-section h3 {
    color: #FF6B35;
    margin-bottom: 20px;
    border-bottom: 2px solid #FF6B35;
    padding-bottom: 10px;
}

.speakers-list ul {
    list-style: none;
    padding: 0;
}

.speakers-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
    position: relative;
    padding-left: 20px;
}

.speakers-list li:before {
    content: "🎤";
    position: absolute;
    left: 0;
}

.event-sidebar {
    position: sticky;
    top: 20px;
}

.registration-widget,
.event-info-widget,
.related-events-widget {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.registration-widget h3,
.event-info-widget h3,
.related-events-widget h3 {
    color: #FF6B35;
    margin-bottom: 20px;
}

.event-info-list {
    list-style: none;
    padding: 0;
}

.event-info-list li {
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

.related-events-list {
    list-style: none;
    padding: 0;
}

.related-events-list li {
    margin-bottom: 15px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.related-events-list a {
    display: flex;
    gap: 15px;
    text-decoration: none;
    color: inherit;
}

.related-events-list img {
    width: 60px;
    height: 60px;
    border-radius: 4px;
    object-fit: cover;
}

.related-event-info h4 {
    margin: 0 0 5px;
    color: #FF6B35;
}

.related-event-info p {
    margin: 0;
    font-size: 14px;
    color: #666;
}

@media (max-width: 768px) {
    .event-header-content,
    .content-grid {
        grid-template-columns: 1fr;
    }

    .event-info h1 {
        font-size: 2rem;
    }

    .event-meta {
        flex-direction: column;
        gap: 10px;
    }

    .event-actions {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>