<?php
/*
Template Name: Events Page
*/
get_header();
?>

<main>
    <!-- Hero Section -->
    <section class="events-hero">
        <div class="container">
            <div class="hero-content">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_the_excerpt(); ?></p>
            </div>
        </div>
    </section>

    <!-- Events Content -->
    <section class="events-content">
        <div class="container">
            <div class="content-wrapper">
                <!-- Main Content -->
                <div class="main-content">
                    <?php if (have_posts()): while (have_posts()): the_post(); ?>
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endwhile; endif; ?>

                    <!-- Upcoming Events -->
                    <div class="upcoming-events-section">
                        <h2>Upcoming Events</h2>

                        <div class="events-grid">
                            <?php
                            $upcoming_events = new WP_Query(array(
                                'post_type' => 'event',
                                'posts_per_page' => 6,
                                'meta_query' => array(
                                    array(
                                        'key' => '_event_date',
                                        'value' => date('Y-m-d'),
                                        'compare' => '>=',
                                        'type' => 'DATE'
                                    )
                                ),
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'meta_key' => '_event_date'
                            ));

                            if ($upcoming_events->have_posts()):
                                while ($upcoming_events->have_posts()): $upcoming_events->the_post();
                                    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                                    $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                                    $location = get_post_meta(get_the_ID(), '_event_location', true);
                                    $organizer = get_post_meta(get_the_ID(), '_event_organizer', true);
                                    ?>
                                    <div class="event-card">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="event-image">
                                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="event-content">
                                            <div class="event-date">
                                                <span class="date"><?php echo date('M j', strtotime($event_date)); ?></span>
                                                <span class="year"><?php echo date('Y', strtotime($event_date)); ?></span>
                                            </div>

                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                            <div class="event-meta">
                                                <?php if ($event_time): ?>
                                                    <span class="meta-item">⏰ <?php echo esc_html($event_time); ?></span>
                                                <?php endif; ?>

                                                <?php if ($location): ?>
                                                    <span class="meta-item">📍 <?php echo esc_html($location); ?></span>
                                                <?php endif; ?>

                                                <?php if ($organizer): ?>
                                                    <span class="meta-item">👤 <?php echo esc_html($organizer); ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="event-excerpt">
                                                <?php echo get_the_excerpt(); ?>
                                            </div>

                                            <div class="event-actions">
                                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Learn More</a>
                                                <a href="<?php the_permalink(); ?>#register" class="btn btn-secondary">Register</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>

                                <div class="view-all-events">
                                    <a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn-primary">View All Events</a>
                                </div>

                            <?php else: ?>
                                <div class="no-events">
                                    <h3>No upcoming events</h3>
                                    <p>Check back soon for new events and announcements.</p>
                                </div>
                            <?php endif; ?>

                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <!-- Past Events -->
                    <div class="past-events-section">
                        <h2>Recent Events</h2>

                        <div class="events-grid">
                            <?php
                            $past_events = new WP_Query(array(
                                'post_type' => 'event',
                                'posts_per_page' => 3,
                                'meta_query' => array(
                                    array(
                                        'key' => '_event_date',
                                        'value' => date('Y-m-d'),
                                        'compare' => '<',
                                        'type' => 'DATE'
                                    )
                                ),
                                'orderby' => 'meta_value',
                                'order' => 'DESC',
                                'meta_key' => '_event_date'
                            ));

                            if ($past_events->have_posts()):
                                while ($past_events->have_posts()): $past_events->the_post();
                                    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                                    $location = get_post_meta(get_the_ID(), '_event_location', true);
                                    ?>
                                    <div class="event-card past-event">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="event-image">
                                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="event-content">
                                            <div class="event-date past">
                                                <span class="date"><?php echo date('M j', strtotime($event_date)); ?></span>
                                                <span class="year"><?php echo date('Y', strtotime($event_date)); ?></span>
                                            </div>

                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                            <div class="event-meta">
                                                <span class="meta-item">📍 <?php echo esc_html($location); ?></span>
                                                <span class="meta-item past-label">Past Event</span>
                                            </div>

                                            <div class="event-excerpt">
                                                <?php echo get_the_excerpt(); ?>
                                            </div>

                                            <div class="event-actions">
                                                <a href="<?php the_permalink(); ?>" class="btn btn-secondary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                            <?php else: ?>
                                <div class="no-events">
                                    <p>No past events to display.</p>
                                </div>
                            <?php endif; ?>

                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="events-sidebar">
                    <!-- Event Categories -->
                    <div class="sidebar-widget">
                        <h3>Event Categories</h3>
                        <ul class="category-list">
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'event_category',
                                'hide_empty' => false,
                            ));
                            foreach ($categories as $category) {
                                $count = $category->count;
                                echo '<li><a href="' . get_term_link($category) . '">' . esc_html($category->name) . ' <span>(' . $count . ')</span></a></li>';
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div class="sidebar-widget">
                        <h3>Quick Links</h3>
                        <ul class="quick-links">
                            <li><a href="<?php echo get_post_type_archive_link('event'); ?>">All Events</a></li>
                            <li><a href="<?php echo get_post_type_archive_link('event'); ?>?date_range=upcoming">Upcoming Events</a></li>
                            <li><a href="<?php echo get_post_type_archive_link('event'); ?>?date_range=this_month">This Month</a></li>
                            <li><a href="<?php echo get_post_type_archive_link('event'); ?>?date_range=next_month">Next Month</a></li>
                        </ul>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="sidebar-widget newsletter-widget">
                        <h3>Stay Updated</h3>
                        <p>Get notified about upcoming events and important announcements.</p>
                        <form class="newsletter-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                            <input type="hidden" name="action" value="newsletter_signup">
                            <?php wp_nonce_field('newsletter_signup_nonce', 'newsletter_nonce'); ?>

                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your email address" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.events-hero {
    background: linear-gradient(135deg, #FF6B35, #F7931E);
    color: white;
    padding: 100px 0;
    text-align: center;
}

.events-hero h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

.events-hero p {
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto;
}

.events-content {
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

.upcoming-events-section h2,
.past-events-section h2 {
    color: #FF6B35;
    margin-bottom: 30px;
    border-bottom: 2px solid #FF6B35;
    padding-bottom: 10px;
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.event-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 25px rgba(0,0,0,0.15);
}

.event-card.past-event {
    opacity: 0.8;
}

.event-date {
    position: absolute;
    top: 20px;
    right: 20px;
    background: #FF6B35;
    color: white;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    z-index: 2;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.event-date.past {
    background: #6c757d;
}

.event-date .date {
    display: block;
    font-size: 18px;
    font-weight: bold;
    line-height: 1;
}

.event-date .year {
    display: block;
    font-size: 12px;
    opacity: 0.9;
}

.event-image {
    height: 200px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.event-card:hover .event-image img {
    transform: scale(1.05);
}

.event-content {
    padding: 25px;
    padding-top: 35px;
}

.event-content h3 {
    margin: 0 0 15px;
    font-size: 1.3rem;
}

.event-content h3 a {
    color: #FF6B35;
    text-decoration: none;
}

.event-content h3 a:hover {
    color: #e55a2b;
}

.event-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.meta-item {
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    color: #666;
}

.meta-item.past-label {
    background: #6c757d;
    color: white;
}

.event-excerpt {
    color: #666;
    margin-bottom: 20px;
    line-height: 1.5;
}

.event-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.view-all-events {
    grid-column: 1 / -1;
    text-align: center;
    margin-top: 20px;
}

.no-events {
    grid-column: 1 / -1;
    text-align: center;
    padding: 40px 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.no-events h3 {
    color: #FF6B35;
    margin-bottom: 15px;
}

.events-sidebar {
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
    color: #FF6B35;
    margin-bottom: 20px;
    border-bottom: 2px solid #FF6B35;
    padding-bottom: 10px;
}

.category-list,
.quick-links {
    list-style: none;
    padding: 0;
}

.category-list li,
.quick-links li {
    margin-bottom: 10px;
}

.category-list a,
.quick-links a {
    color: #666;
    text-decoration: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #eee;
    transition: color 0.3s ease;
}

.category-list a:hover,
.quick-links a:hover {
    color: #FF6B35;
}

.category-list span {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 12px;
    color: #666;
}

.newsletter-widget p {
    color: #666;
    margin-bottom: 20px;
    line-height: 1.5;
}

.newsletter-form .form-group {
    margin-bottom: 15px;
}

.newsletter-form input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

@media (max-width: 768px) {
    .content-wrapper {
        grid-template-columns: 1fr;
    }

    .events-hero h1 {
        font-size: 2.5rem;
    }

    .events-grid {
        grid-template-columns: 1fr;
    }

    .event-actions {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>