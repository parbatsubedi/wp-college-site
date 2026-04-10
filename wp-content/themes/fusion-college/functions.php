<?php
/**
 * Fusion College Theme Functions
 *
 * @package Fusion_College
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function fusion_college_setup() {
    // Add default posts and feeds RSS link
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Add custom image sizes
    add_image_size('course-thumb', 600, 400, true);
    add_image_size('event-thumb', 600, 400, true);
    add_image_size('gallery-thumb', 400, 400, true);
    add_image_size('hero-slide', 1920, 800, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'fusion-college'),
        'footer' => esc_html__('Footer Menu', 'fusion-college'),
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 90,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for custom spacing
    add_theme_support('custom-spacing');

    // Gutenberg block support
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');
    add_theme_support('editor-gradient-presets');
}
add_action('after_setup_theme', 'fusion_college_setup');

// Enqueue scripts and styles
function fusion_college_scripts() {
    // Main stylesheet
    wp_enqueue_style('fusion-college-style', get_stylesheet_uri(), array(), '1.0.0');

    // Theme JavaScript
    wp_enqueue_script('fusion-college-scripts', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('fusion-college-scripts', 'fusionCollege', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fusion-college-nonce'),
        'homeUrl' => home_url('/'),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'fusion_college_scripts');

// ========================================
// CUSTOM POST TYPES
// ========================================

function fusion_college_register_post_types() {
    // Course Post Type
    register_post_type('course', array(
        'labels' => array(
            'name' => esc_html__('Courses', 'fusion-college'),
            'singular_name' => esc_html__('Course', 'fusion-college'),
            'menu_name' => esc_html__('Courses', 'fusion-college'),
            'add_new' => esc_html__('Add New', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Course', 'fusion-college'),
            'edit_item' => esc_html__('Edit Course', 'fusion-college'),
            'new_item' => esc_html__('New Course', 'fusion-college'),
            'view_item' => esc_html__('View Course', 'fusion-college'),
            'search_items' => esc_html__('Search Courses', 'fusion-college'),
            'not_found' => esc_html__('No courses found', 'fusion-college'),
            'not_found_in_trash' => esc_html__('No courses found in trash', 'fusion-college'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'rewrite' => array('slug' => 'courses', 'with_front' => false),
        'show_in_rest' => true, // Enable Gutenberg editor
        'menu_position' => 5,
        'capability_type' => 'post',
    ));

    // Event Post Type
    register_post_type('event', array(
        'labels' => array(
            'name' => esc_html__('Events', 'fusion-college'),
            'singular_name' => esc_html__('Event', 'fusion-college'),
            'menu_name' => esc_html__('Events', 'fusion-college'),
            'add_new' => esc_html__('Add New', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Event', 'fusion-college'),
            'edit_item' => esc_html__('Edit Event', 'fusion-college'),
            'new_item' => esc_html__('New Event', 'fusion-college'),
            'view_item' => esc_html__('View Event', 'fusion-college'),
            'search_items' => esc_html__('Search Events', 'fusion-college'),
            'not_found' => esc_html__('No events found', 'fusion-college'),
            'not_found_in_trash' => esc_html__('No events found in trash', 'fusion-college'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'rewrite' => array('slug' => 'events', 'with_front' => false),
        'show_in_rest' => true,
        'menu_position' => 6,
    ));

    // Announcement Post Type
    register_post_type('announcement', array(
        'labels' => array(
            'name' => esc_html__('Announcements', 'fusion-college'),
            'singular_name' => esc_html__('Announcement', 'fusion-college'),
            'menu_name' => esc_html__('Announcements', 'fusion-college'),
            'add_new' => esc_html__('Add New', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Announcement', 'fusion-college'),
            'edit_item' => esc_html__('Edit Announcement', 'fusion-college'),
            'new_item' => esc_html__('New Announcement', 'fusion-college'),
            'view_item' => esc_html__('View Announcement', 'fusion-college'),
            'search_items' => esc_html__('Search Announcements', 'fusion-college'),
            'not_found' => esc_html__('No announcements found', 'fusion-college'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite' => array('slug' => 'announcements'),
        'show_in_rest' => true,
        'menu_position' => 7,
    ));

    // Gallery Post Type
    register_post_type('gallery', array(
        'labels' => array(
            'name' => esc_html__('Gallery', 'fusion-college'),
            'singular_name' => esc_html__('Gallery Image', 'fusion-college'),
            'menu_name' => esc_html__('Gallery', 'fusion-college'),
            'add_new' => esc_html__('Add New', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Gallery Image', 'fusion-college'),
            'edit_item' => esc_html__('Edit Gallery Image', 'fusion-college'),
            'new_item' => esc_html__('New Gallery Image', 'fusion-college'),
            'view_item' => esc_html__('View Gallery Image', 'fusion-college'),
            'search_items' => esc_html__('Search Gallery', 'fusion-college'),
            'not_found' => esc_html__('No gallery images found', 'fusion-college'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite' => array('slug' => 'gallery'),
        'show_in_rest' => true,
        'menu_position' => 8,
    ));

    // Banner Post Type (Hero slides)
    register_post_type('banner', array(
        'labels' => array(
            'name' => esc_html__('Hero Banners', 'fusion-college'),
            'singular_name' => esc_html__('Hero Banner', 'fusion-college'),
            'menu_name' => esc_html__('Hero Banners', 'fusion-college'),
            'add_new' => esc_html__('Add New', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Hero Banner', 'fusion-college'),
            'edit_item' => esc_html__('Edit Hero Banner', 'fusion-college'),
            'new_item' => esc_html__('New Hero Banner', 'fusion-college'),
            'view_item' => esc_html__('View Hero Banner', 'fusion-college'),
            'search_items' => esc_html__('Search Hero Banners', 'fusion-college'),
            'not_found' => esc_html__('No hero banners found', 'fusion-college'),
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-slides',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
        'rewrite' => array('slug' => 'banners'),
        'show_in_rest' => true,
        'menu_position' => 9,
    ));
}
add_action('init', 'fusion_college_register_post_types');

// ========================================
// TAXONOMIES
// ========================================

function fusion_college_register_taxonomies() {
    // Course Category
    register_taxonomy('course_category', 'course', array(
        'labels' => array(
            'name' => esc_html__('Course Categories', 'fusion-college'),
            'singular_name' => esc_html__('Course Category', 'fusion-college'),
            'search_items' => esc_html__('Search Course Categories', 'fusion-college'),
            'all_items' => esc_html__('All Course Categories', 'fusion-college'),
            'edit_item' => esc_html__('Edit Course Category', 'fusion-college'),
            'update_item' => esc_html__('Update Course Category', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Course Category', 'fusion-college'),
            'new_item_name' => esc_html__('New Course Category Name', 'fusion-college'),
            'menu_name' => esc_html__('Course Categories', 'fusion-college'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'course-category'),
        'show_in_rest' => true,
    ));

    // Event Category
    register_taxonomy('event_category', 'event', array(
        'labels' => array(
            'name' => esc_html__('Event Categories', 'fusion-college'),
            'singular_name' => esc_html__('Event Category', 'fusion-college'),
            'search_items' => esc_html__('Search Event Categories', 'fusion-college'),
            'all_items' => esc_html__('All Event Categories', 'fusion-college'),
            'edit_item' => esc_html__('Edit Event Category', 'fusion-college'),
            'update_item' => esc_html__('Update Event Category', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Event Category', 'fusion-college'),
            'new_item_name' => esc_html__('New Event Category Name', 'fusion-college'),
            'menu_name' => esc_html__('Event Categories', 'fusion-college'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'event-category'),
        'show_in_rest' => true,
    ));

    // Gallery Category
    register_taxonomy('gallery_category', 'gallery', array(
        'labels' => array(
            'name' => esc_html__('Gallery Categories', 'fusion-college'),
            'singular_name' => esc_html__('Gallery Category', 'fusion-college'),
            'search_items' => esc_html__('Search Gallery Categories', 'fusion-college'),
            'all_items' => esc_html__('All Gallery Categories', 'fusion-college'),
            'edit_item' => esc_html__('Edit Gallery Category', 'fusion-college'),
            'update_item' => esc_html__('Update Gallery Category', 'fusion-college'),
            'add_new_item' => esc_html__('Add New Gallery Category', 'fusion-college'),
            'new_item_name' => esc_html__('New Gallery Category Name', 'fusion-college'),
            'menu_name' => esc_html__('Gallery Categories', 'fusion-college'),
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'gallery-category'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'fusion_college_register_taxonomies');

// ========================================
// META BOXES (Course Details)
// ========================================

function fusion_college_add_meta_boxes() {
    // Course Meta Box
    add_meta_box(
        'course_details',
        esc_html__('Course Details', 'fusion-college'),
        'fusion_college_course_details_callback',
        'course',
        'normal',
        'high'
    );

    // Event Meta Box
    add_meta_box(
        'event_details',
        esc_html__('Event Details', 'fusion-college'),
        'fusion_college_event_details_callback',
        'event',
        'normal',
        'high'
    );

    // Banner Meta Box
    add_meta_box(
        'banner_details',
        esc_html__('Banner Details', 'fusion-college'),
        'fusion_college_banner_details_callback',
        'banner',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'fusion_college_add_meta_boxes');

// Course Details Meta Box Callback
function fusion_college_course_details_callback($post) {
    wp_nonce_field('fusion_college_save_course_meta', 'fusion_college_course_nonce');

    $duration = get_post_meta($post->ID, '_course_duration', true);
    $fee = get_post_meta($post->ID, '_course_fee', true);
    $cricos_code = get_post_meta($post->ID, '_course_cricos_code', true);
    $study_mode = get_post_meta($post->ID, '_course_study_mode', true);
    $intake_months = get_post_meta($post->ID, '_course_intake_months', true);
    $location = get_post_meta($post->ID, '_course_location', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="course_duration">Duration (Weeks)</label></th>';
    echo '<td><input type="text" id="course_duration" name="course_duration" value="' . esc_attr($duration) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="course_fee">Tuition Fee ($)</label></th>';
    echo '<td><input type="number" id="course_fee" name="course_fee" value="' . esc_attr($fee) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="course_cricos_code">CRICOS Code</label></th>';
    echo '<td><input type="text" id="course_cricos_code" name="course_cricos_code" value="' . esc_attr($cricos_code) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="course_study_mode">Study Mode</label></th>';
    echo '<td><input type="text" id="course_study_mode" name="course_study_mode" value="' . esc_attr($study_mode) . '" class="regular-text" placeholder="e.g., Full-time, Part-time"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="course_intake_months">Intake Months</label></th>';
    echo '<td><input type="text" id="course_intake_months" name="course_intake_months" value="' . esc_attr($intake_months) . '" class="regular-text" placeholder="e.g., January, March, June"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="course_location">Location</label></th>';
    echo '<td><input type="text" id="course_location" name="course_location" value="' . esc_attr($location) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '</table>';
}

// Event Details Meta Box Callback
function fusion_college_event_details_callback($post) {
    wp_nonce_field('fusion_college_save_event_meta', 'fusion_college_event_nonce');

    $start_date = get_post_meta($post->ID, '_event_start_date', true);
    $end_date = get_post_meta($post->ID, '_event_end_date', true);
    $location = get_post_meta($post->ID, '_event_location', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="event_start_date">Start Date</label></th>';
    echo '<td><input type="date" id="event_start_date" name="event_start_date" value="' . esc_attr($start_date) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="event_end_date">End Date</label></th>';
    echo '<td><input type="date" id="event_end_date" name="event_end_date" value="' . esc_attr($end_date) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="event_location">Location</label></th>';
    echo '<td><input type="text" id="event_location" name="event_location" value="' . esc_attr($location) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '</table>';
}

// Banner Details Meta Box Callback
function fusion_college_banner_details_callback($post) {
    wp_nonce_field('fusion_college_save_banner_meta', 'fusion_college_banner_nonce');

    $subtitle = get_post_meta($post->ID, '_banner_subtitle', true);
    $description = get_post_meta($post->ID, '_banner_description', true);
    $button_text = get_post_meta($post->ID, '_banner_button_text', true);
    $button_link = get_post_meta($post->ID, '_banner_button_link', true);
    $order = get_post_meta($post->ID, '_banner_order', true);

    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="banner_subtitle">Subtitle</label></th>';
    echo '<td><input type="text" id="banner_subtitle" name="banner_subtitle" value="' . esc_attr($subtitle) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="banner_description">Description</label></th>';
    echo '<td><textarea id="banner_description" name="banner_description" rows="3" class="large-text">' . esc_textarea($description) . '</textarea></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="banner_button_text">Button Text</label></th>';
    echo '<td><input type="text" id="banner_button_text" name="banner_button_text" value="' . esc_attr($button_text) . '" class="regular-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="banner_button_link">Button Link</label></th>';
    echo '<td><input type="url" id="banner_button_link" name="banner_button_link" value="' . esc_attr($button_link) . '" class="large-text"></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="banner_order">Order</label></th>';
    echo '<td><input type="number" id="banner_order" name="banner_order" value="' . esc_attr($order ? $order : '0') . '" class="regular-text"></td>';
    echo '</tr>';
    echo '</table>';
}

// Save Meta Box Data
function fusion_college_save_course_meta($post_id) {
    if (!isset($_POST['fusion_college_course_nonce']) || !wp_verify_nonce($_POST['fusion_college_course_nonce'], 'fusion_college_save_course_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('course_duration', 'course_fee', 'course_cricos_code', 'course_study_mode', 'course_intake_months', 'course_location');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_course', 'fusion_college_save_course_meta');

function fusion_college_save_event_meta($post_id) {
    if (!isset($_POST['fusion_college_event_nonce']) || !wp_verify_nonce($_POST['fusion_college_event_nonce'], 'fusion_college_save_event_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('event_start_date', 'event_end_date', 'event_location');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_event', 'fusion_college_save_event_meta');

function fusion_college_save_banner_meta($post_id) {
    if (!isset($_POST['fusion_college_banner_nonce']) || !wp_verify_nonce($_POST['fusion_college_banner_nonce'], 'fusion_college_save_banner_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('banner_subtitle', 'banner_description', 'banner_button_text', 'banner_button_link', 'banner_order');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_banner', 'fusion_college_save_banner_meta');

// ========================================
// THEME CUSTOMIZER (Site Settings)
// ========================================

function fusion_college_customize_register($wp_customize) {
    // College Info Section
    $wp_customize->add_section('fusion_college_settings', array(
        'title'    => esc_html__('College Settings', 'fusion-college'),
        'priority' => 30,
    ));

    // College Name
    $wp_customize->add_setting('college_name', array(
        'default'           => 'Fusion College of Technology',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('college_name', array(
        'label'   => esc_html__('College Name', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Tagline
    $wp_customize->add_setting('college_tagline', array(
        'default'           => 'of Technology',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('college_tagline', array(
        'label'   => esc_html__('Tagline (appears below college name)', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Phone
    $wp_customize->add_setting('college_phone', array(
        'default'           => '1300 123 456',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('college_phone', array(
        'label'   => esc_html__('Phone Number', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Email
    $wp_customize->add_setting('college_email', array(
        'default'           => 'admin@fusioncollege.edu.au',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('college_email', array(
        'label'   => esc_html__('Email Address', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'email',
    ));

    // Address
    $wp_customize->add_setting('college_address', array(
        'default'           => 'Level 5, 123 George Street, Sydney NSW 2000',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('college_address', array(
        'label'   => esc_html__('Address', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'textarea',
    ));

    // RTO Number
    $wp_customize->add_setting('rto_number', array(
        'default'           => '45123',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('rto_number', array(
        'label'   => esc_html__('RTO Number', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // CRICOS Code
    $wp_customize->add_setting('cricos_code', array(
        'default'           => '03456J',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cricos_code', array(
        'label'   => esc_html__('CRICOS Code', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Hero Badge Text
    $wp_customize->add_setting('hero_badge', array(
        'default'           => 'Welcome to Fusion College of Technology',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_badge', array(
        'label'   => esc_html__('Hero Badge Text', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Empowering Future Professionals Through Quality Education',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_title', array(
        'label'   => esc_html__('Hero Title', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Launch your career with nationally recognized qualifications and industry-experienced trainers.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => esc_html__('Hero Subtitle', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'fusion_college_customize_register');

// ========================================
// HELPER FUNCTIONS
// ========================================

// Get theme option from customizer
function fusion_college_get_option($option_name, $default = '') {
    return get_theme_mod($option_name, $default);
}

// Get college name
function fusion_college_college_name() {
    return fusion_college_get_option('college_name', 'Fusion College of Technology');
}

// Get phone
function fusion_college_phone() {
    return fusion_college_get_option('college_phone', '1300 123 456');
}

// Get email
function fusion_college_email() {
    return fusion_college_get_option('college_email', 'admin@fusioncollege.edu.au');
}

// Get address
function fusion_college_address() {
    return fusion_college_get_option('college_address', 'Level 5, 123 George Street, Sydney NSW 2000');
}

// ========================================
// AJAX CONTACT FORM HANDLER
// ========================================

function fusion_college_handle_contact_form() {
    check_ajax_referer('fusion-college-nonce', 'nonce');

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    // Send email
    $to = fusion_college_email();
    $email_subject = 'Contact Form: ' . $subject;
    $email_body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nSubject: {$subject}\n\nMessage:\n{$message}";
    $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email);

    wp_mail($to, $email_subject, $email_body, $headers);

    wp_send_json_success(array('message' => 'Message sent successfully!'));
}
add_action('wp_ajax_fusion_college_contact_form', 'fusion_college_handle_contact_form');
add_action('wp_ajax_nopriv_fusion_college_contact_form', 'fusion_college_handle_contact_form');

// ========================================
// INCLUDE TEMPLATE PARTS
// ========================================

// Include nav walker
require get_template_directory() . '/inc/nav-walker.php';

// Include additional files
require get_template_directory() . '/inc/template-functions.php';

// Include ACF field groups
require get_template_directory() . '/inc/acf-field-groups.php';

// Include demo data seeder
require get_template_directory() . '/inc/demo-data-seeder.php';
