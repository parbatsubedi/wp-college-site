<?php
/**
 * Event Card Template
 */

$start_date = get_post_meta(get_the_ID(), '_event_start_date', true);
$end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
$location = get_post_meta(get_the_ID(), '_event_location', true);
$category = '';
$terms = get_the_terms(get_the_ID(), 'event_category');
if ($terms && !is_wp_error($terms)) {
    $category = $terms[0]->name;
}

$day = $start_date ? date('d', strtotime($start_date)) : '';
$month = $start_date ? date('M', strtotime($start_date)) : '';
$formatted_date = $start_date ? date('F d, Y', strtotime($start_date)) : '';
?>
<div class="event-card fade-in">
    <div class="event-image">
        <?php if (has_post_thumbnail()) : ?>
            <div style="width: 100%; height: 100%; background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'event-thumb')); ?>'); background-size: cover; background-position: center;"></div>
        <?php else : ?>
            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, <?php echo $category === 'workshop' ? '#172566 0%, #1e3170 100%' : ($category === 'graduation' ? '#CF5E1C 0%, #FD6406 100%' : ($category === 'networking' ? '#077E86 0%, #172566 100%' : '#077E86 0%, #2A7970 100%')); ?>); display: flex; align-items: center; justify-content: center;">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
        <?php endif; ?>
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
            <span>📍</span>
            <span><?php echo esc_html($location ?: 'TBA'); ?></span>
        </div>
    </div>
</div>
