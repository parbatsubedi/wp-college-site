<?php

/**
 * Dynamic Settings API
 * Manages all dynamic settings for the theme
 */
if (! defined('ABSPATH')) {
    exit;
}

// Save setting via AJAX
function fusion_save_setting_ajax()
{
    check_ajax_referer('fusion_college_nonce', 'nonce');

    $key = sanitize_text_field($_POST['key'] ?? '');
    $value = sanitize_text_field($_POST['value'] ?? '');

    if ($key) {
        update_option('college_'.$key, $value);
        wp_send_json_success();
    }

    wp_send_json_error();
}
add_action('wp_ajax_fusion_save_setting', 'fusion_save_setting_ajax');

// Get dynamic setting
function fusion_get_setting($key, $default = '')
{
    $value = get_theme_mod($key, $default);
    if (empty($value)) {
        $value = get_option('college_'.$key, $default);
    }

    return $value;
}

// Get all hero slides from banners CPT
function fusion_get_hero_slides()
{
    $banners = new WP_Query([
        'post_type' => 'banner',
        'posts_per_page' => 5,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);

    if ($banners->have_posts()) {
        return $banners;
    }

    return null;
}

// Get dynamic stats
function fusion_get_stats()
{
    return [
        [
            'icon' => '🎓',
            'number' => fusion_get_setting('stats_students', '5000'),
            'label' => 'Students Enrolled',
        ],
        [
            'icon' => '🏆',
            'number' => fusion_get_setting('stats_employment', '95'),
            'label' => '% Employment Rate',
        ],
        [
            'icon' => '👨‍🏫',
            'number' => fusion_get_setting('stats_trainers', '150'),
            'label' => 'Industry Trainers',
        ],
        [
            'icon' => '🌍',
            'number' => fusion_get_setting('stats_countries', '50'),
            'label' => 'Countries Represented',
        ],
    ];
}

// Get testimonials
function fusion_get_testimonials($limit = 3)
{
    return new WP_Query([
        'post_type' => 'testimonial',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
    ]);
}

// Get featured courses
function fusion_get_featured_courses($limit = 3)
{
    return new WP_Query([
        'post_type' => 'course',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'rand',
    ]);
}

// Get upcoming events
function fusion_get_upcoming_events($limit = 3)
{
    return new WP_Query([
        'post_type' => 'event',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_event_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE',
            ],
        ],
        'orderby' => 'meta_value',
        'meta_key' => '_event_date',
        'order' => 'ASC',
    ]);
}

// Get announcements
function fusion_get_announcements($limit = 5)
{
    return new WP_Query([
        'post_type' => 'announcement',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
    ]);
}

// Get gallery images
function fusion_get_gallery_images($limit = 8)
{
    return new WP_Query([
        'post_type' => 'gallery',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
    ]);
}

// Why Choose Us features
function fusion_get_why_features()
{
    $features = get_option('college_why_features', []);

    if (empty($features)) {
        return [
            [
                'icon' => '🎯',
                'title' => 'Industry-Relevant Training',
                'description' => 'Our courses are designed with industry input to ensure you learn the skills employers are looking for.',
                'color' => 'primary',
            ],
            [
                'icon' => '🤝',
                'title' => 'Personal Support',
                'description' => 'Our dedicated student support team is here to help you throughout your studies.',
                'color' => 'secondary',
            ],
            [
                'icon' => '💼',
                'title' => 'Career Opportunities',
                'description' => 'We provide career guidance and connections to help you kickstart your career.',
                'color' => 'midnight',
            ],
            [
                'icon' => '🌏',
                'title' => 'Diverse Community',
                'description' => 'Study alongside students from over 50 countries in a welcoming environment.',
                'color' => 'primary',
            ],
        ];
    }

    return $features;
}

// Social links
function fusion_get_social_links()
{
    return [
        'facebook' => fusion_get_setting('facebook_url', '#'),
        'twitter' => fusion_get_setting('twitter_url', '#'),
        'instagram' => fusion_get_setting('instagram_url', '#'),
        'linkedin' => fusion_get_setting('linkedin_url', '#'),
    ];
}

// Contact info
function fusion_get_contact_info()
{
    return [
        'phone' => fusion_get_setting('college_phone', '1300 123 456'),
        'email' => fusion_get_setting('college_email', 'info@fusioncollege.edu.au'),
        'address' => fusion_get_setting('college_address', 'Sydney, Australia'),
    ];
}
