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
        'default'           => 'LEARNING EXCELLENCE IN VOCATIONAL EDUCATION TRAINING',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('college_tagline', array(
        'label'   => esc_html__('Tagline (appears below college name)', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Phone
    $wp_customize->add_setting('college_phone', array(
        'default'           => '+61 2 7806 8110',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('college_phone', array(
        'label'   => esc_html__('Phone Number', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Email
    $wp_customize->add_setting('college_email', array(
        'default'           => 'admissions@fusioncollege.edu.au',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('college_email', array(
        'label'   => esc_html__('Email Address', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'email',
    ));

    // Address
    $wp_customize->add_setting('college_address', array(
        'default'           => 'Level 5, 16-18 Wentworth Street, Parramatta NSW 2150',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('college_address', array(
        'label'   => esc_html__('Address', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'textarea',
    ));

    // RTO Number
    $wp_customize->add_setting('rto_number', array(
        'default'           => '46086',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('rto_number', array(
        'label'   => esc_html__('RTO Number', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // CRICOS Code
    $wp_customize->add_setting('cricos_code', array(
        'default'           => '04189E',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cricos_code', array(
        'label'   => esc_html__('CRICOS Code', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Hero Badge Text
    $wp_customize->add_setting('hero_badge', array(
        'default'           => 'Our Experts / Instruction for Your Bright Future',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_badge', array(
        'label'   => esc_html__('Hero Badge Text', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Quality Education and Training in a Favourable Environment',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_title', array(
        'label'   => esc_html__('Hero Title', 'fusion-college'),
        'section' => 'fusion_college_settings',
        'type'    => 'text',
    ));

    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Located in Your Dream City Sydney',
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

// Get tagline
function fusion_college_tagline() {
    return fusion_college_get_option('college_tagline', 'LEARNING EXCELLENCE IN VOCATIONAL EDUCATION TRAINING');
}

// Get phone
function fusion_college_phone() {
    return fusion_college_get_option('college_phone', '+61 2 7806 8110');
}

// Get email
function fusion_college_email() {
    return fusion_college_get_option('college_email', 'admissions@fusioncollege.edu.au');
}

// Get address
function fusion_college_address() {
    return fusion_college_get_option('college_address', 'Level 5, 16-18 Wentworth Street, Parramatta NSW 2150');
}

// Get RTO
function fusion_college_rto() {
    return fusion_college_get_option('rto_number', '46086');
}

// Get CRICOS
function fusion_college_cricos() {
    return fusion_college_get_option('cricos_code', '04189E');
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

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
        return;
    }

    // Save to database as contact_message CPT
    $post_id = wp_insert_post(array(
        'post_title' => $name . ' - ' . $subject,
        'post_type' => 'contact_message',
        'post_status' => 'publish',
        'post_content' => $message,
    ));

    // Store meta data
    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, '_contact_name', $name);
        update_post_meta($post_id, '_contact_email', $email);
        update_post_meta($post_id, '_contact_phone', $phone);
        update_post_meta($post_id, '_contact_subject', $subject);
        update_post_meta($post_id, '_contact_message', $message);
        update_post_meta($post_id, '_is_read', '0');
    }

    // Send email notification
    $notification_email = get_option('fusion_notification_email', fusion_college_email());
    $college_name = fusion_college_college_name();
    $college_tagline = fusion_college_tagline();
    $college_address = fusion_college_address();
    
    // Generate reference number
    $ref_number = 'ENQ-' . date('Y') . '-' . str_pad($post_id, 4, '0', STR_PAD_LEFT);
    
    // Format date
    $received_date = date('d F Y, h:i A');
    
    // Build HTML email body
    $email_body = '<!DOCTYPE html>
                    <html lang="en">
                        <head>
                        <meta charset="UTF-8"/>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                        <title>Enquiry Notification</title>
                        <style>
                            * { box-sizing: border-box; margin: 0; padding: 0; }
                            body { background: #f4f5f7; font-family: Arial, sans-serif; padding: 40px 16px; }
                            .email { max-width: 580px; margin: 0 auto; background: #fff; border: 1px solid #e2e5ea; border-radius: 10px; overflow: hidden; }
                            .header { padding: 22px 28px; border-bottom: 1px solid #e2e5ea; display: flex; align-items: center; gap: 14px; }
                            .logo { width: 40px; height: 40px; background: #1a3c6e; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
                            .college-name { font-size: 15px; font-weight: 600; color: #111; }
                            .college-sub  { font-size: 12px; color: #888; margin-top: 2px; }
                            .meta { padding: 14px 28px; border-bottom: 1px solid #e2e5ea; }
                            .meta p { font-size: 13px; color: #666; margin-bottom: 4px; }
                            .meta p:last-child { margin-bottom: 0; }
                            .meta span { color: #111; }
                            .meta .subject { font-weight: 600; }
                            .body { padding: 24px 28px; }
                            .body .greeting { font-size: 14px; color: #111; margin-bottom: 6px; }
                            .body .intro { font-size: 13.5px; color: #666; line-height: 1.7; margin-bottom: 20px; }
                            .details { border: 1px solid #e2e5ea; border-radius: 8px; overflow: hidden; margin-bottom: 18px; }
                            .details table { width: 100%; border-collapse: collapse; font-size: 13px; }
                            .details tr { border-bottom: 1px solid #e2e5ea; }
                            .details tr:last-child { border-bottom: none; }
                            .details td { padding: 10px 14px; }
                            .details .label { color: #888; width: 38%; }
                            .details .value { color: #111; font-weight: 500; }
                            .details .link  { color: #185fa5; font-weight: normal; }
                            .details .msg   { color: #333; font-style: italic; line-height: 1.6; font-weight: normal; }
                            .notice { background: #fffbeb; border-left: 3px solid #f0c040; padding: 10px 14px; margin-bottom: 22px; font-size: 13px; color: #7a5c00; line-height: 1.6; }
                            .actions { display: flex; gap: 10px; margin-bottom: 22px; }
                            .btn-primary { background: #1a3c6e; color: #fff; text-decoration: none; padding: 9px 18px; border-radius: 6px; font-size: 13px; }
                            .btn-secondary { color: #555; text-decoration: none; padding: 9px 18px; border: 1px solid #d0d4da; border-radius: 6px; font-size: 13px; }
                            .sign { font-size: 12.5px; color: #888; line-height: 1.7; }
                            .sign small { font-size: 11.5px; color: #aaa; }
                            .footer { padding: 14px 28px; border-top: 1px solid #e2e5ea; text-align: center; font-size: 11.5px; color: #aaa; }
                        </style>
                        </head>
                        <body>
                        <div class="email">

                        <!-- Header -->
                        <div class="header">
                            <div class="logo">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="4" y="11" width="16" height="10" rx="1" fill="white"/>
                                <rect x="9" y="15" width="6" height="6" rx="1" fill="#1a3c6e"/>
                                <rect x="8" y="8" width="8" height="5" rx="1" fill="white"/>
                                <polygon points="12,2 15,8 9,8" fill="#f0c040"/>
                            </svg>
                            </div>
                            <div>
                            <p class="college-name">' . esc_html($college_name) . '</p>
                            <p class="college-sub">' . esc_html($college_tagline) . '</p>
                            </div>
                        </div>

                        <!-- Meta -->
                        <div class="meta">
                            <p>To: <span>' . esc_html($notification_email) . '</span></p>
                            <p>Subject: <span class="subject">New enquiry received — Ref #' . esc_html($ref_number) . '</span></p>
                        </div>

                        <!-- Body -->
                        <div class="body">
                            <p class="greeting">Dear Admin,</p>
                            <p class="intro">A new enquiry was submitted via the college website. Details are below.</p>

                            <div class="details">
                            <table>
                                <tr><td class="label">Name</td><td class="value">' . esc_html($name) . '</td></tr>
                                <tr><td class="label">Email</td><td class="value link">' . esc_html($email) . '</td></tr>
                                <tr><td class="label">Phone</td><td class="value">' . esc_html($phone) . '</td></tr>
                                <tr><td class="label">Subject</td><td class="value">' . esc_html($subject) . '</td></tr>
                                <tr><td class="label">Received</td><td class="value">' . esc_html($received_date) . '</td></tr>
                                <tr>
                                <td class="label" style="vertical-align:top;">Message</td>
                                <td class="value msg">"' . esc_html($message) . '"</td>
                                </tr>
                            </table>
                            </div>

                            <div class="actions">
                            <a href="mailto:' . esc_attr($email) . '" class="btn-primary">Reply to enquiry</a>
                            <a href="' . esc_url(home_url('/wp-admin')) . '" class="btn-secondary">View dashboard</a>
                            </div>

                            <p class="sign">
                            ' . esc_html($college_name) . ' Website System<br>
                            <small>This is an automated message — please do not reply directly.</small>
                            </p>
                        </div>

                        <!-- Footer -->
                        <div class="footer">
                            ' . esc_html($college_name) . ' · ' . esc_html($college_address) . ' · ' . esc_html(fusion_college_email()) . '
                        </div>

                        </div>
                        </body>
                    </html>';

    // Set recipient
    $to = $notification_email;
    $email_subject = 'Contact Form: ' . $subject;
    
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'Reply-To: ' . $email,
    );

    // Send email (will use SMTP if configured)
    $email_sent = wp_mail($to, $email_subject, $email_body, $headers);
    
    // Log email status for debugging
    if ($email_sent) {
        error_log('Contact form email sent successfully to: ' . $notification_email . ' from: ' . $name);
    } else {
        error_log('ERROR: Contact form email FAILED. To: ' . $notification_email . ' | From: ' . $name . ' | Subject: ' . $email_subject);
        // Check if SMTP is configured
        $smtp_enabled = get_option('fusion_smtp_enabled', '0');
        if ($smtp_enabled !== '1') {
            error_log('WARNING: SMTP is not enabled. Using PHP mail() which may fail. Enable SMTP in: Contact Messages > Email Settings');
        }
    }
    
    // Return success even if email fails (message is saved)
    $response_message = 'Message sent successfully!';
    if (!$email_sent) {
        $response_message = 'Message saved! We will contact you soon.';
    }
    
    wp_send_json_success(array('message' => $response_message, 'email_sent' => $email_sent));
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

// Include SMTP configuration
require get_template_directory() . '/inc/smtp-config.php';

// Include custom admin pages
require get_template_directory() . '/inc/custom-admin.php';

// ========================================
// APPLICATION FORM - CUSTOM POST TYPE
// ========================================

function fusion_college_register_application_cpt() {
    register_post_type('application', array(
        'labels' => array(
            'name' => 'Applications',
            'singular_name' => 'Application',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Application',
            'edit_item' => 'Edit Application',
            'new_item' => 'New Application',
            'view_item' => 'View Application',
            'search_items' => 'Search Applications',
            'not_found' => 'No applications found',
            'not_found_in_trash' => 'No applications found in trash',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 50,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => array('title', 'editor', 'custom-fields'),
        'capability_type' => 'post',
        'capabilities' => array('create_posts' => 'do_not_allow'),
        'map_meta_cap' => true,
        'register_meta_box_cb' => 'fusion_college_application_meta_boxes',
    ));
}
add_action('init', 'fusion_college_register_application_cpt');

function fusion_college_application_meta_boxes() {
    add_meta_box('application_details', 'Application Details', 'fusion_college_application_meta_cb', 'application', 'normal', 'high');
}

function fusion_college_application_meta_cb($post) {
    $first_name = get_post_meta($post->ID, 'first_name', true);
    $last_name = get_post_meta($post->ID, 'last_name', true);
    $email = get_post_meta($post->ID, 'email', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $date_of_birth = get_post_meta($post->ID, 'date_of_birth', true);
    $address = get_post_meta($post->ID, 'address', true);
    $city = get_post_meta($post->ID, 'city', true);
    $state = get_post_meta($post->ID, 'state', true);
    $zip_code = get_post_meta($post->ID, 'zip_code', true);
    $country = get_post_meta($post->ID, 'country', true);
    $course_id = get_post_meta($post->ID, 'course_id', true);
    $status = get_post_meta($post->ID, 'status', true);
    $notes = get_post_meta($post->ID, 'notes', true);
    
    $courses = get_posts(array('post_type' => 'course', 'posts_per_page' => -1));
    ?>
    <div class="application-meta">
    <p><strong>Name:</strong> <?php echo esc_html($first_name . ' ' . $last_name); ?></p>
    <p><strong>Email:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
    <p><strong>Phone:</strong> <?php echo esc_html($phone); ?></p>
    <p><strong>Date of Birth:</strong> <?php echo esc_html($date_of_birth); ?></p>
    <p><strong>Address:</strong> <?php echo esc_html($address); ?>, <?php echo esc_html($city); ?>, <?php echo esc_html($state); ?> <?php echo esc_html($zip_code); ?>, <?php echo esc_html($country); ?></p>
    <p><strong>Course:</strong> <?php echo $course_id ? get_the_title($course_id) : 'General Inquiry'; ?></p>
    <p><strong>Status:</strong> 
        <select name="status">
            <option value="pending" <?php selected($status, 'pending'); ?>>Pending</option>
            <option value="reviewed" <?php selected($status, 'reviewed'); ?>>Reviewed</option>
            <option value="approved" <?php selected($status, 'approved'); ?>>Approved</option>
            <option value="rejected" <?php selected($status, 'rejected'); ?>>Rejected</option>
        </select>
    </p>
    <p><strong>Notes:</strong></p>
    <textarea name="notes" rows="4" class="widefat"><?php echo esc_textarea($notes); ?></textarea>
    </div>
    <?php
}

function fusion_college_save_application_meta($post_id) {
    if (array_key_exists('status', $_POST)) {
        update_post_meta($post_id, 'status', sanitize_text_field($_POST['status']));
    }
    if (array_key_exists('notes', $_POST)) {
        update_post_meta($post_id, 'notes', sanitize_textarea_field($_POST['notes']));
    }
}
add_action('save_post_application', 'fusion_college_save_application_meta');

// ========================================
// APPLICATION FORM SUBMISSION HANDLER
// ========================================

function fusion_college_handle_apply_form() {
    check_ajax_referer('fusion-college-nonce', 'nonce');
    
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $date_of_birth = sanitize_text_field($_POST['date_of_birth']);
    $address = sanitize_text_field($_POST['address']);
    $city = sanitize_text_field($_POST['city']);
    $state = sanitize_text_field($_POST['state']);
    $zip_code = sanitize_text_field($_POST['zip_code']);
    $country = sanitize_text_field($_POST['country']);
    $course_id = intval($_POST['course_id']);
    $message = sanitize_textarea_field($_POST['message']);
    
    $post_id = wp_insert_post(array(
        'post_type' => 'application',
        'post_title' => $first_name . ' ' . $last_name . ' - ' . date('Y-m-d'),
        'post_status' => 'publish',
        'post_content' => $message,
    ));
    
    if ($post_id && !is_wp_error($post_id)) {
        update_post_meta($post_id, 'first_name', $first_name);
        update_post_meta($post_id, 'last_name', $last_name);
        update_post_meta($post_id, 'email', $email);
        update_post_meta($post_id, 'phone', $phone);
        update_post_meta($post_id, 'date_of_birth', $date_of_birth);
        update_post_meta($post_id, 'address', $address);
        update_post_meta($post_id, 'city', $city);
        update_post_meta($post_id, 'state', $state);
        update_post_meta($post_id, 'zip_code', $zip_code);
        update_post_meta($post_id, 'country', $country);
        update_post_meta($post_id, 'course_id', $course_id);
        update_post_meta($post_id, 'status', 'pending');
        
        $notification_email = get_option('fusion_notification_email', fusion_college_email());
        $to = $notification_email;
        $email_subject = 'New Application: ' . $first_name . ' ' . $last_name;
        $email_body = "New Application Submitted\n\n";
        $email_body .= "Name: {$first_name} {$last_name}\n";
        $email_body .= "Email: {$email}\n";
        $email_body .= "Phone: {$phone}\n";
        $email_body .= "Date of Birth: {$date_of_birth}\n";
        $email_body .= "Address: {$address}, {$city}, {$state} {$zip_code}, {$country}\n";
        $email_body .= "Course: " . ($course_id ? get_the_title($course_id) : 'General Inquiry') . "\n";
        $email_body .= "\nMessage:\n{$message}";
        $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email);
        
        wp_mail($to, $email_subject, $email_body, $headers);
        
        wp_send_json_success(array('message' => 'Application submitted successfully! We will contact you soon.'));
    } else {
        wp_send_json_error(array('message' => 'Failed to submit application. Please try again.'));
    }
}
add_action('wp_ajax_fusion_college_apply_form', 'fusion_college_handle_apply_form');
add_action('wp_ajax_nopriv_fusion_college_apply_form', 'fusion_college_handle_apply_form');

// ========================================
// ADD CUSTOM COLUMNS TO APPLICATIONS LIST
// ========================================

function fusion_college_application_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Name',
        'email' => 'Email',
        'course' => 'Course',
        'status' => 'Status',
        'date' => 'Date',
    );
    return $columns;
}
add_filter('manage_application_posts_columns', 'fusion_college_application_columns');

function fusion_college_application_column_content($column, $post_id) {
    switch ($column) {
        case 'email':
            echo esc_html(get_post_meta($post_id, 'email', true));
            break;
        case 'course':
            $course_id = get_post_meta($post_id, 'course_id', true);
            echo $course_id ? get_the_title($course_id) : 'General';
            break;
        case 'status':
            $status = get_post_meta($post_id, 'status', true);
            $colors = array('pending' => '#f59e0b', 'reviewed' => '#3b82f6', 'approved' => '#10b981', 'rejected' => '#ef4444');
            echo '<span style="color: ' . esc_attr($colors[$status] ?? '#666') . '; font-weight: bold;">' . ucfirst($status) . '</span>';
            break;
    }
}
add_action('manage_application_posts_custom_column', 'fusion_college_application_column_content', 10, 2);
