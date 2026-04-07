<?php

/**
 * Dynamic Shortcodes
 * All shortcodes pull content from CPTs and settings
 */
if (! defined('ABSPATH')) {
    exit;
}

$category_gradients = [
    'it' => 'linear-gradient(135deg, #077E86 0%, #2A7970 100%)',
    'business' => 'linear-gradient(135deg, #172566 0%, #1e3170 100%)',
    'leadership' => 'linear-gradient(135deg, #CF5E1C 0%, #FD6406 100%)',
    'health' => 'linear-gradient(135deg, #2A7970 0%, #077E86 100%)',
    'english' => 'linear-gradient(135deg, #172566 0%, #077E86 100%)',
    'community' => 'linear-gradient(135deg, #2A7970 0%, #077E86 100%)',
];
$default_gradient = 'linear-gradient(135deg, #077E86 0%, #172566 100%)';

$category_icons = [
    'it' => '<path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4M3 9h18M3 15h18"/><path d="M3 9h18M3 15h18"/>',
    'business' => '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>',
    'leadership' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
    'health' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>',
    'english' => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>',
    'community' => '<path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>',
];

// [fusion_courses limit="3" category=""]
function fusion_courses_shortcode($atts)
{
    global $category_gradients, $default_gradient, $category_icons;

    $atts = shortcode_atts([
        'limit' => 3,
        'category' => '',
        'columns' => 3,
        'show_pagination' => 'false',
    ], $atts);

    $args = [
        'post_type' => 'course',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish',
    ];

    if (! empty($atts['category'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'course_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ],
        ];
    }

    $courses = new WP_Query($args);

    $output = '<div class="courses-grid">';

    if ($courses->have_posts()) {
        while ($courses->have_posts()) {
            $courses->the_post();

            $terms = get_the_terms(get_the_ID(), 'course_category');
            $category = $terms ? $terms[0]->name : 'Course';
            $category_slug = $terms ? $terms[0]->slug : '';
            $duration = get_post_meta(get_the_ID(), '_course_duration', true);
            $fee = get_post_meta(get_the_ID(), '_course_fee', true);
            $study_mode = get_post_meta(get_the_ID(), '_course_study_mode', true);

            $gradient = isset($category_gradients[$category_slug]) ? $category_gradients[$category_slug] : $default_gradient;
            $icon = isset($category_icons[$category_slug]) ? $category_icons[$category_slug] : $category_icons['leadership'];

            $output .= '<div class="course-card fade-in">';
            $output .= '<div class="course-image">';

            if (has_post_thumbnail()) {
                $output .= '<div class="course-image-bg" style="background-image: url(\''.get_the_post_thumbnail_url(get_the_ID(), 'medium').'\'); background-size: cover; background-position: center;"></div>';
            } else {
                $output .= '<div class="course-image-bg" style="background: '.$gradient.'; display: flex; align-items: center; justify-content: center;">';
                $output .= '<svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">'.$icon.'</svg>';
                $output .= '</div>';
            }

            $output .= '<span class="course-category">'.esc_html(ucfirst($category)).'</span>';
            $output .= '</div>';
            $output .= '<div class="course-content">';
            $output .= '<h3 class="course-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
            $output .= '<p class="course-description">'.wp_trim_words(get_the_excerpt(), 20).'</p>';
            $output .= '<div class="course-meta">';

            if ($duration) {
                $output .= '<span class="course-duration">📅 '.esc_html($duration).' Weeks</span>';
            }

            $output .= '<a href="'.get_permalink().'" class="btn btn-primary btn-small">View Details</a>';
            $output .= '</div></div></div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: var(--text-muted);">No courses available at the moment. Please check back later.</p>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('fusion_courses', 'fusion_courses_shortcode');

// [fusion_events limit="3"]
function fusion_events_shortcode($atts)
{
    $atts = shortcode_atts([
        'limit' => 3,
        'show_past' => 'false',
    ], $atts);

    $args = [
        'post_type' => 'event',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish',
    ];

    if ($atts['show_past'] !== 'true') {
        $args['meta_query'] = [
            [
                'key' => '_event_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE',
            ],
        ];
        $args['orderby'] = 'meta_value';
        $args['meta_key'] = '_event_date';
        $args['order'] = 'ASC';
    }

    $events = new WP_Query($args);

    $output = '<div class="events-grid">';

    if ($events->have_posts()) {
        while ($events->have_posts()) {
            $events->the_post();

            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_time = get_post_meta(get_the_ID(), '_event_time', true);
            $location = get_post_meta(get_the_ID(), '_event_location', true);

            $day = $event_date ? date('d', strtotime($event_date)) : date('d');
            $month = $event_date ? date('M', strtotime($event_date)) : date('M');
            $date_formatted = $event_date ? date('F d, Y', strtotime($event_date)) : '';

            $output .= '<div class="event-card fade-in">';
            $output .= '<div class="event-image">';

            if (has_post_thumbnail()) {
                $output .= '<div style="width: 100%; height: 100%; background-image: url(\''.get_the_post_thumbnail_url(get_the_ID(), 'medium').'\'); background-size: cover; background-position: center;"></div>';
            } else {
                $output .= '<div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary) 0%, var(--midnight) 100%); display: flex; align-items: center; justify-content: center;">';
                $output .= '<svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>';
                $output .= '</div>';
            }

            $output .= '<div class="event-date">';
            $output .= '<span class="event-day">'.$day.'</span>';
            $output .= '<span class="event-month">'.$month.'</span>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="event-content">';
            $output .= '<span class="event-category">'.esc_html($location ?? 'Online').'</span>';
            $output .= '<h3 class="event-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
            $output .= '<div class="event-location">';

            if ($date_formatted) {
                $output .= '<span>📅 '.$date_formatted.'</span>';
            }

            $output .= '</div></div></div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--text-muted);">No events scheduled at the moment.</p>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('fusion_events', 'fusion_events_shortcode');

// [fusion_testimonials limit="3"]
function fusion_testimonials_shortcode($atts)
{
    $atts = shortcode_atts([
        'limit' => 3,
    ], $atts);

    $testimonials = new WP_Query([
        'post_type' => 'testimonial',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish',
    ]);

    $output = '<div class="testimonials-slider">';

    if ($testimonials->have_posts()) {
        $count = 0;
        while ($testimonials->have_posts()) {
            $testimonials->the_post();

            $name = get_post_meta(get_the_ID(), '_testimonial_name', true);
            $role = get_post_meta(get_the_ID(), '_testimonial_role', true);
            $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);

            $output .= '<div class="testimonial-card'.($count === 0 ? ' active' : '').'">';
            $output .= '<p class="testimonial-quote">"'.get_the_content().'"</p>';
            $output .= '<div class="testimonial-author">';
            $output .= '<div class="testimonial-avatar">';
            if (has_post_thumbnail()) {
                $output .= get_the_post_thumbnail(get_the_ID(), [70, 70]);
            } else {
                $output .= '<svg viewBox="0 0 70 70" fill="none">
                    <circle cx="35" cy="25" r="12" fill="rgba(255,255,255,0.3)"/>
                    <path d="M10 65c0-15 10-25 25-25s25 10 25 25" fill="rgba(255,255,255,0.3)"/>
                </svg>';
            }
            $output .= '</div>';
            $output .= '<div class="testimonial-info">';
            $output .= '<h4>'.esc_html($name ?: get_the_title()).'</h4>';
            $output .= '<span>'.esc_html($role).'</span>';
            $output .= '</div></div></div>';
            $count++;
        }
        wp_reset_postdata();
    }

    $output .= '<div class="testimonial-dots">';
    for ($i = 0; $i < $count; $i++) {
        $output .= '<span class="testimonial-dot'.($i === 0 ? ' active' : '').'" data-index="'.$i.'"></span>';
    }
    $output .= '</div></div>';

    return $output;
}
add_shortcode('fusion_testimonials', 'fusion_testimonials_shortcode');

// [fusion_stats]
function fusion_stats_shortcode($atts)
{
    $stats = fusion_get_stats();

    $output = '<div class="fusion-stats-grid">';

    foreach ($stats as $stat) {
        $output .= '<div class="fusion-stat-card">';
        $output .= '<div class="fusion-stat-icon">'.$stat['icon'].'</div>';
        $output .= '<div class="fusion-stat-number" data-target="'.esc_attr($stat['number']).'">0</div>';
        $output .= '<div class="fusion-stat-label">'.esc_html($stat['label']).'</div>';
        $output .= '</div>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('fusion_stats', 'fusion_stats_shortcode');

// [fusion_announcements limit="5"]
function fusion_announcements_shortcode($atts)
{
    $atts = shortcode_atts([
        'limit' => 5,
    ], $atts);

    $announcements = new WP_Query([
        'post_type' => 'announcement',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish',
    ]);

    $output = '<div class="fusion-announcements-list">';

    if ($announcements->have_posts()) {
        while ($announcements->have_posts()) {
            $announcements->the_post();

            $date = get_post_meta(get_the_ID(), '_announcement_date', true) ?: get_the_date('Y-m-d');

            $output .= '<div class="fusion-announcement-item">';
            $output .= '<span class="fusion-announcement-date">'.date('M d, Y', strtotime($date)).'</span>';
            $output .= '<h4 class="fusion-announcement-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
            $output .= '<p class="fusion-announcement-excerpt">'.get_the_excerpt().'</p>';
            $output .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p class="fusion-no-announcements">No announcements.</p>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('fusion_announcements', 'fusion_announcements_shortcode');

// [fusion_contact_info]
function fusion_contact_info_shortcode($atts)
{
    $contact = fusion_get_contact_info();

    $output = '';

    $output .= '<div class="contact-info-card fade-in">';
    $output .= '<div class="contact-info-icon">📍</div>';
    $output .= '<div class="contact-info-content">';
    $output .= '<h4>Address</h4>';
    $output .= '<p>'.nl2br(esc_html($contact['address'])).'</p>';
    $output .= '</div></div>';

    $output .= '<div class="contact-info-card fade-in">';
    $output .= '<div class="contact-info-icon">📞</div>';
    $output .= '<div class="contact-info-content">';
    $output .= '<h4>Phone</h4>';
    $output .= '<p>'.esc_html($contact['phone']).'</p>';
    $output .= '</div></div>';

    $output .= '<div class="contact-info-card fade-in">';
    $output .= '<div class="contact-info-icon">✉️</div>';
    $output .= '<div class="contact-info-content">';
    $output .= '<h4>Email</h4>';
    $output .= '<p>'.esc_html($contact['email']).'</p>';
    $output .= '</div></div>';

    $output .= '<div class="contact-info-card fade-in">';
    $output .= '<div class="contact-info-icon">🕐</div>';
    $output .= '<div class="contact-info-content">';
    $output .= '<h4>Office Hours</h4>';
    $output .= '<p>Monday - Friday: 9:00 AM - 5:00 PM<br>Saturday: By appointment</p>';
    $output .= '</div></div>';

    return $output;
}
add_shortcode('fusion_contact_info', 'fusion_contact_info_shortcode');

// [fusion_social_links]
function fusion_social_links_shortcode($atts)
{
    $social = fusion_get_social_links();

    $output = '<div class="fusion-social-links">';
    if ($social['facebook'] && $social['facebook'] !== '#') {
        $output .= '<a href="'.esc_url($social['facebook']).'" class="fusion-social-link fusion-social-facebook" target="_blank">📘</a>';
    }
    if ($social['twitter'] && $social['twitter'] !== '#') {
        $output .= '<a href="'.esc_url($social['twitter']).'" class="fusion-social-link fusion-social-twitter" target="_blank">🐦</a>';
    }
    if ($social['instagram'] && $social['instagram'] !== '#') {
        $output .= '<a href="'.esc_url($social['instagram']).'" class="fusion-social-link fusion-social-instagram" target="_blank">📷</a>';
    }
    if ($social['linkedin'] && $social['linkedin'] !== '#') {
        $output .= '<a href="'.esc_url($social['linkedin']).'" class="fusion-social-link fusion-social-linkedin" target="_blank">💼</a>';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode('fusion_social_links', 'fusion_social_links_shortcode');

// [fusion_gallery limit="8"]
function fusion_gallery_shortcode($atts)
{
    $atts = shortcode_atts([
        'limit' => 8,
        'columns' => 4,
    ], $atts);

    $gallery = new WP_Query([
        'post_type' => 'gallery',
        'posts_per_page' => intval($atts['limit']),
        'post_status' => 'publish',
    ]);

    $output = '<div class="fusion-gallery-grid fusion-gallery-cols-'.esc_attr($atts['columns']).'">';

    if ($gallery->have_posts()) {
        while ($gallery->have_posts()) {
            $gallery->the_post();

            $output .= '<div class="fusion-gallery-item">';
            if (has_post_thumbnail()) {
                $output .= '<a href="'.get_the_post_thumbnail_url(get_the_ID(), 'large').'" class="fusion-gallery-link">';
                $output .= get_the_post_thumbnail(get_the_ID(), 'medium', ['class' => 'fusion-gallery-img']);
                $output .= '</a>';
            }
            $output .= '<h4 class="fusion-gallery-title">'.get_the_title().'</h4>';
            $output .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p class="fusion-no-gallery">No gallery items.</p>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('fusion_gallery', 'fusion_gallery_shortcode');

// [fusion_why_choose_us]
function fusion_why_choose_us_shortcode($atts)
{
    $features = fusion_get_why_features();

    $output = '<div class="fusion-why-grid">';

    foreach ($features as $feature) {
        $color_class = 'fusion-feature-'.($feature['color'] ?? 'primary');

        $output .= '<div class="fusion-why-card">';
        $output .= '<div class="fusion-why-icon '.esc_attr($color_class).'">';
        $output .= $feature['icon'];
        $output .= '</div>';
        $output .= '<h4>'.esc_html($feature['title']).'</h4>';
        $output .= '<p>'.esc_html($feature['description']).'</p>';
        $output .= '</div>';
    }

    $output .= '</div>';

    return $output;
}
add_shortcode('fusion_why_choose_us', 'fusion_why_choose_us_shortcode');
