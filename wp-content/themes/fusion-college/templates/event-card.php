<?php
/**
 * Event Card Template
 * Uses slider-1.jpg for all events (generic campus image from fusioncollege.edu.au)
 */

$start_date = get_post_meta(get_the_ID(), '_event_start_date', true);
$end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
$location = get_post_meta(get_the_ID(), '_event_location', true);
$category = '';
$terms = get_the_terms(get_the_ID(), 'event_category');
if ($terms && !is_wp_error($terms)) {
    $category = strtolower($terms[0]->slug);
}

$day = $start_date ? date('d', strtotime($start_date)) : '';
$month = $start_date ? date('M', strtotime($start_date)) : '';

// Use slider-1 for all events - this is the main campus image from fusioncollege.edu.au
$bg_image = 'https://fusioncollege.edu.au/wp-content/uploads/2023/02/slider-1.jpg';
?>
<div class="event-card fade-in">
    <div class="event-image" style="background-color: #077E86;">
        <div style="width: 100%; height: 100%; background-image: url('<?php echo esc_url($bg_image); ?>'); background-size: cover; background-position: center;"></div>
        <?php if ($day && $month) : ?>
        <div class="event-date">
            <span class="event-day"><?php echo esc_html($day); ?></span>
            <span class="event-month"><?php echo esc_html($month); ?></span>
        </div>
        <?php endif; ?>
    </div>
    <div class="event-content">
        <?php if ($category) : ?>
        <span class="event-category"><?php echo esc_html(ucfirst(str_replace('-', ' ', $category))); ?></span>
        <?php endif; ?>
        <h3 class="event-title"><?php the_title(); ?></h3>
        <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 15px;"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
        <div class="event-location">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span><?php echo esc_html($location ?: 'Sydney Campus'); ?></span>
        </div>
    </div>
</div>