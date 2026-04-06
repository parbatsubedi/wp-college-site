<?php get_header(); ?>

<main>
    <section class="events-archive">
        <div class="container">
            <div class="archive-header">
                <h1>Events</h1>
                <p>Stay updated with our upcoming events, workshops, and special programs.</p>
            </div>

            <!-- Filters -->
            <div class="events-filters">
                <form method="GET" class="filter-form">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="event_category">Category:</label>
                            <select name="event_category" id="event_category">
                                <option value="">All Categories</option>
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'event_category',
                                    'hide_empty' => false,
                                ));
                                foreach ($categories as $category) {
                                    $selected = (isset($_GET['event_category']) && $_GET['event_category'] == $category->slug) ? 'selected' : '';
                                    echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="date_range">Date Range:</label>
                            <select name="date_range" id="date_range">
                                <option value="">All Dates</option>
                                <option value="upcoming" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'upcoming') ? 'selected' : ''; ?>>Upcoming Events</option>
                                <option value="this_month" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'this_month') ? 'selected' : ''; ?>>This Month</option>
                                <option value="next_month" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'next_month') ? 'selected' : ''; ?>>Next Month</option>
                                <option value="this_year" <?php echo (isset($_GET['date_range']) && $_GET['date_range'] == 'this_year') ? 'selected' : ''; ?>>This Year</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="search">Search:</label>
                            <input type="text" name="search" id="search" value="<?php echo isset($_GET['search']) ? esc_attr($_GET['search']) : ''; ?>" placeholder="Search events...">
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn-secondary">Clear</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Events Grid -->
            <div class="events-grid">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'event',
                    'posts_per_page' => 12,
                    'paged' => $paged,
                    'meta_query' => array(),
                    'tax_query' => array('relation' => 'AND'),
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                    'meta_key' => '_event_date',
                );

                // Category filter
                if (isset($_GET['event_category']) && !empty($_GET['event_category'])) {
                    $args['tax_query'][] = array(
                        'taxonomy' => 'event_category',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($_GET['event_category']),
                    );
                }

                // Date range filter
                if (isset($_GET['date_range']) && !empty($_GET['date_range'])) {
                    $today = date('Y-m-d');
                    switch ($_GET['date_range']) {
                        case 'upcoming':
                            $args['meta_query'][] = array(
                                'key' => '_event_date',
                                'value' => $today,
                                'compare' => '>=',
                                'type' => 'DATE'
                            );
                            break;
                        case 'this_month':
                            $start_of_month = date('Y-m-01');
                            $end_of_month = date('Y-m-t');
                            $args['meta_query'][] = array(
                                'key' => '_event_date',
                                'value' => array($start_of_month, $end_of_month),
                                'compare' => 'BETWEEN',
                                'type' => 'DATE'
                            );
                            break;
                        case 'next_month':
                            $next_month = date('Y-m-01', strtotime('+1 month'));
                            $end_next_month = date('Y-m-t', strtotime('+1 month'));
                            $args['meta_query'][] = array(
                                'key' => '_event_date',
                                'value' => array($next_month, $end_next_month),
                                'compare' => 'BETWEEN',
                                'type' => 'DATE'
                            );
                            break;
                        case 'this_year':
                            $start_of_year = date('Y-01-01');
                            $end_of_year = date('Y-12-31');
                            $args['meta_query'][] = array(
                                'key' => '_event_date',
                                'value' => array($start_of_year, $end_of_year),
                                'compare' => 'BETWEEN',
                                'type' => 'DATE'
                            );
                            break;
                    }
                } else {
                    // Default to upcoming events
                    $args['meta_query'][] = array(
                        'key' => '_event_date',
                        'value' => date('Y-m-d'),
                        'compare' => '>=',
                        'type' => 'DATE'
                    );
                }

                // Search filter
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $args['s'] = sanitize_text_field($_GET['search']);
                }

                $events_query = new WP_Query($args);

                if ($events_query->have_posts()):
                    while ($events_query->have_posts()): $events_query->the_post();
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                        $location = get_post_meta(get_the_ID(), '_event_location', true);
                        $organizer = get_post_meta(get_the_ID(), '_event_organizer', true);
                        $max_attendees = get_post_meta(get_the_ID(), '_event_max_attendees', true);
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

                                    <?php if ($max_attendees): ?>
                                        <span class="meta-item">👥 <?php echo esc_html($max_attendees); ?> max</span>
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

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $events_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                        ));
                        ?>
                    </div>

                <?php else: ?>
                    <div class="no-events">
                        <h3>No events found</h3>
                        <p>Try adjusting your filters or check back later for upcoming events.</p>
                        <a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn-primary">View All Events</a>
                    </div>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
</main>

<style>
.events-archive {
    padding: 80px 0;
}

.archive-header {
    text-align: center;
    margin-bottom: 50px;
}

.archive-header h1 {
    font-size: 3rem;
    color: #FF6B35;
    margin-bottom: 20px;
}

.archive-header p {
    font-size: 1.2rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

.events-filters {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 40px;
}

.filter-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    font-weight: 600;
    margin-bottom: 8px;
    color: #FF6B35;
}

.filter-group select,
.filter-group input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.filter-actions {
    display: flex;
    gap: 10px;
}

.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
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

.pagination {
    grid-column: 1 / -1;
    text-align: center;
    margin-top: 40px;
}

.pagination .page-numbers {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 5px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #FF6B35;
    transition: all 0.3s ease;
}

.pagination .page-numbers:hover,
.pagination .page-numbers.current {
    background: #FF6B35;
    color: white;
    border-color: #FF6B35;
}

.no-events {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.no-events h3 {
    color: #FF6B35;
    margin-bottom: 15px;
}

.no-events p {
    color: #666;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .events-grid {
        grid-template-columns: 1fr;
    }

    .filter-row {
        grid-template-columns: 1fr;
    }

    .event-actions {
        flex-direction: column;
    }

    .archive-header h1 {
        font-size: 2.5rem;
    }
}
</style>

<?php get_footer(); ?>