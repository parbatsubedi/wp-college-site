<?php
/**
 * Fusion College Theme - functions and definitions
 * Fully dynamic, Elementor-ready theme
 */

// Prevent direct access
if (! defined('ABSPATH')) {
    exit;
}

// Settings function - all dynamic
function get_college_setting($key, $default = null)
{
    $option_key = 'college_'.$key;
    $value = get_option($option_key);
    if ($value === false) {
        $defaults = get_college_defaults();
        $value = isset($defaults[$key]) ? $defaults[$key] : $default;
        if ($value !== null) {
            update_option($option_key, $value);
        }
    }

    return $value;
}

// Default settings
function get_college_defaults()
{
    return [
        'college_name' => 'Fusion College of Technology',
        'tagline' => 'Empowering Future Leaders',
        'rto_number' => '45123',
        'cricos_code' => '03456J',
        'phone' => '1300 123 456',
        'email' => 'info@fusioncollege.edu.au',
        'address' => 'Sydney, Australia',
        'hero_title' => 'Empowering Future Professionals Through Quality Education',
        'hero_subtitle' => "Join Australia's leading vocational education provider",
        'hero_button_text' => 'Explore Courses',
        'hero_button_url' => '#courses',
        'about_title' => 'About Us',
        'about_description' => 'We are a leading registered training organisation committed to delivering high-quality vocational education and training.',
        'about_image' => '',
        'stats_students' => '5000',
        'stats_employment' => '95',
        'stats_trainers' => '150',
        'stats_countries' => '50',
        'courses_title' => 'Popular Programs',
        'courses_subtitle' => 'Explore our range of nationally recognized qualifications designed to help you achieve your career goals.',
        'why_title' => 'Why Choose Us',
        'why_subtitle' => 'We are committed to providing the best possible education and support for our students.',
        'testimonial_title' => 'What Our Students Say',
        'cta_title' => 'Ready to Start Your Journey?',
        'cta_subtitle' => 'Enroll now and take the first step towards your dream career.',
        'cta_button_primary' => 'Apply Now',
        'cta_button_primary_url' => '/admissions',
        'cta_button_secondary' => 'Contact Us',
        'cta_button_secondary_url' => '/contact',
        'facebook_url' => '',
        'twitter_url' => '',
        'instagram_url' => '',
        'linkedin_url' => '',
    ];
}

// Theme Setup
function fusion_college_theme_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('menus');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list']);
    add_theme_support('custom-background');
    add_theme_support('custom-header');

    // Elementor Support
    add_theme_support('elementor');

    // Register Menus
    register_nav_menus([
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
        'footer_quick' => 'Footer Quick Links',
    ]);

    // Image Sizes
    add_image_size('course-thumbnail', 400, 250, true);
    add_image_size('event-thumbnail', 400, 250, true);
    add_image_size('gallery-image', 600, 400, true);
    add_image_size('banner-image', 1920, 800, true);
}
add_action('after_setup_theme', 'fusion_college_theme_setup');

// Enqueue Scripts and Styles
function fusion_college_scripts()
{
    wp_enqueue_style('fusion-college-style', get_stylesheet_uri(), [], '1.0.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', [], null);

    wp_enqueue_script('fusion-college-js', get_template_directory_uri().'/js/script.js', ['jquery'], '1.0.0', true);

    wp_localize_script('fusion-college-js', 'fusion_college_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fusion_college_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'fusion_college_scripts');

// Include Files
require_once get_template_directory().'/admin.php';
require_once get_template_directory().'/inc/db-setup.php';
require_once get_template_directory().'/inc/dynamic-settings.php';
require_once get_template_directory().'/inc/elementor-compat.php';
require_once get_template_directory().'/inc/shortcodes.php';
require_once get_template_directory().'/inc/custom-admin.php';

// ==================== CUSTOM POST TYPES ====================

function create_custom_post_types()
{
    // Courses CPT
    register_post_type('course', [
        'labels' => [
            'name' => 'Courses',
            'singular_name' => 'Course',
            'add_new' => 'Add New Course',
            'add_new_item' => 'Add New Course',
            'edit_item' => 'Edit Course',
            'new_item' => 'New Course',
            'view_item' => 'View Course',
            'search_items' => 'Search Courses',
            'not_found' => 'No courses found',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon' => 'dashicons-book-alt',
        'rewrite' => ['slug' => 'courses'],
        'show_in_rest' => true,
    ]);

    // Events CPT
    register_post_type('event', [
        'labels' => [
            'name' => 'Events',
            'singular_name' => 'Event',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => ['slug' => 'events'],
        'show_in_rest' => true,
    ]);

    // Announcements CPT
    register_post_type('announcement', [
        'labels' => [
            'name' => 'Announcements',
            'singular_name' => 'Announcement',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon' => 'dashicons-megaphone',
        'rewrite' => ['slug' => 'announcements'],
        'show_in_rest' => true,
    ]);

    // Applications CPT (Internal)
    register_post_type('application', [
        'labels' => [
            'name' => 'Applications',
            'singular_name' => 'Application',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-clipboard',
        'show_in_rest' => true,
    ]);

    // Testimonials CPT
    register_post_type('testimonial', [
        'labels' => [
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new' => 'Add New Testimonial',
            'add_new_item' => 'Add New Testimonial',
            'edit_item' => 'Edit Testimonial',
        ],
        'public' => true,
        'has_archive' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'menu_icon' => 'dashicons-testimonial',
        'show_in_rest' => true,
    ]);

    // Gallery CPT
    register_post_type('gallery', [
        'labels' => [
            'name' => 'Gallery',
            'singular_name' => 'Gallery Item',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'thumbnail', 'custom-fields'],
        'menu_icon' => 'dashicons-images-alt',
        'rewrite' => ['slug' => 'galleries'],
        'show_in_rest' => true,
    ]);

    // Banners CPT
    register_post_type('banner', [
        'labels' => [
            'name' => 'Hero Banners',
            'singular_name' => 'Banner',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'thumbnail', 'custom-fields'],
        'menu_icon' => 'dashicons-images-alt2',
        'show_in_rest' => true,
    ]);

    // Contact Messages CPT
    register_post_type('contact_message', [
        'labels' => [
            'name' => 'Contact Messages',
            'singular_name' => 'Contact Message',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-email-alt',
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_custom_post_types');

// ==================== CUSTOM TAXONOMIES ====================

function create_custom_taxonomies()
{
    register_taxonomy('course_category', 'course', [
        'labels' => ['name' => 'Course Categories'],
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);

    register_taxonomy('event_category', 'event', [
        'labels' => ['name' => 'Event Categories'],
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_custom_taxonomies');

// ==================== META BOXES ====================

// Course Meta Box
function add_course_meta_boxes()
{
    add_meta_box('course_details', 'Course Details', 'course_details_meta_box_callback', 'course', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_course_meta_boxes');

function course_details_meta_box_callback($post)
{
    wp_nonce_field('course_details_nonce', 'course_details_nonce');

    $fields = [
        'course_duration' => 'Duration (e.g., 52 weeks)',
        'course_fee' => 'Fee ($)',
        'course_study_mode' => 'Study Mode',
        'course_location' => 'Location',
        'course_cricos_code' => 'CRICOS Code',
        'course_instructor' => 'Instructor',
    ];

    $textarea_fields = [
        'course_curriculum' => 'Curriculum Description',
        'course_core_units' => 'Core Units (one per line)',
        'course_elective_units' => 'Elective Units (one per line)',
        'course_career_outcomes' => 'Career Outcomes (one per line)',
        'course_entry_requirements' => 'Entry Requirements',
        'course_how_to_apply' => 'How to Apply',
        'course_international_requirements' => 'International Requirements',
        'course_fees_payment_info' => 'Fees & Payment Info',
        'course_policies_forms' => 'Policies & Forms',
    ];
    ?>
    <table class="form-table">
        <?php foreach ($fields as $key => $label) {
            $value = get_post_meta($post->ID, '_'.$key, true);
            ?>
        <tr>
            <th><label for="<?php echo $key; ?>"><?php echo $label; ?></label></th>
            <td><input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo esc_attr($value); ?>" class="regular-text"></td>
        </tr>
        <?php } ?>
    </table>
    
    <h3>Additional Information</h3>
    <table class="form-table">
        <?php foreach ($textarea_fields as $key => $label) {
            $value = get_post_meta($post->ID, '_'.$key, true);
            ?>
        <tr>
            <th><label for="<?php echo $key; ?>"><?php echo $label; ?></label></th>
            <td><textarea id="<?php echo $key; ?>" name="<?php echo $key; ?>" rows="4" class="large-text"><?php echo esc_textarea($value); ?></textarea></td>
        </tr>
        <?php } ?>
    </table>
    <?php
}

function save_course_meta($post_id)
{
    if (! isset($_POST['course_details_nonce']) || ! wp_verify_nonce($_POST['course_details_nonce'], 'course_details_nonce')) {
        return;
    }
    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = ['course_duration', 'course_fee', 'course_study_mode', 'course_location', 'course_cricos_code', 'course_instructor'];
    $textarea_fields = ['course_curriculum', 'course_core_units', 'course_elective_units', 'course_career_outcomes', 'course_entry_requirements', 'course_how_to_apply', 'course_international_requirements', 'course_fees_payment_info', 'course_policies_forms'];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_'.$field, sanitize_text_field($_POST[$field]));
        }
    }

    foreach ($textarea_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_'.$field, sanitize_textarea_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'save_course_meta');

// Event Meta Box
function add_event_meta_boxes()
{
    add_meta_box('event_details', 'Event Details', 'event_details_meta_box_callback', 'event', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_event_meta_boxes');

function event_details_meta_box_callback($post)
{
    wp_nonce_field('event_details_nonce', 'event_details_nonce');

    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);
    $event_organizer = get_post_meta($post->ID, '_event_organizer', true);
    $event_contact_email = get_post_meta($post->ID, '_event_contact_email', true);
    $event_contact_phone = get_post_meta($post->ID, '_event_contact_phone', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="event_date">Event Date</label></th>
            <td><input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_time">Event Time</label></th>
            <td><input type="text" id="event_time" name="event_time" value="<?php echo esc_attr($event_time); ?>" class="regular-text" placeholder="9:00 AM - 5:00 PM"></td>
        </tr>
        <tr>
            <th><label for="event_location">Location</label></th>
            <td><input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_organizer">Organizer</label></th>
            <td><input type="text" id="event_organizer" name="event_organizer" value="<?php echo esc_attr($event_organizer); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_contact_email">Contact Email</label></th>
            <td><input type="email" id="event_contact_email" name="event_contact_email" value="<?php echo esc_attr($event_contact_email); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_contact_phone">Contact Phone</label></th>
            <td><input type="tel" id="event_contact_phone" name="event_contact_phone" value="<?php echo esc_attr($event_contact_phone); ?>" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

function save_event_meta($post_id)
{
    if (! isset($_POST['event_details_nonce']) || ! wp_verify_nonce($_POST['event_details_nonce'], 'event_details_nonce')) {
        return;
    }
    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = ['event_date', 'event_time', 'event_location', 'event_organizer', 'event_contact_email', 'event_contact_phone'];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            if ($field == 'event_contact_email') {
                update_post_meta($post_id, '_'.$field, sanitize_email($_POST[$field]));
            } else {
                update_post_meta($post_id, '_'.$field, sanitize_text_field($_POST[$field]));
            }
        }
    }
}
add_action('save_post', 'save_event_meta');

// Testimonial Meta Box
function add_testimonial_meta_boxes()
{
    add_meta_box('testimonial_details', 'Testimonial Details', 'testimonial_details_meta_box_callback', 'testimonial', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

function testimonial_details_meta_box_callback($post)
{
    wp_nonce_field('testimonial_details_nonce', 'testimonial_details_nonce');

    $testimonial_name = get_post_meta($post->ID, '_testimonial_name', true);
    $testimonial_role = get_post_meta($post->ID, '_testimonial_role', true);
    $testimonial_rating = get_post_meta($post->ID, '_testimonial_rating', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="testimonial_name">Name</label></th>
            <td><input type="text" id="testimonial_name" name="testimonial_name" value="<?php echo esc_attr($testimonial_name); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="testimonial_role">Role / Title</label></th>
            <td><input type="text" id="testimonial_role" name="testimonial_role" value="<?php echo esc_attr($testimonial_role); ?>" class="regular-text" placeholder="e.g., Diploma of IT Graduate"></td>
        </tr>
        <tr>
            <th><label for="testimonial_rating">Rating (1-5)</label></th>
            <td><input type="number" id="testimonial_rating" name="testimonial_rating" value="<?php echo esc_attr($testimonial_rating ?: 5); ?>" class="regular-text" min="1" max="5"></td>
        </tr>
    </table>
    <?php
}

function save_testimonial_meta($post_id)
{
    if (! isset($_POST['testimonial_details_nonce']) || ! wp_verify_nonce($_POST['testimonial_details_nonce'], 'testimonial_details_nonce')) {
        return;
    }
    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['testimonial_name'])) {
        update_post_meta($post_id, '_testimonial_name', sanitize_text_field($_POST['testimonial_name']));
    }
    if (isset($_POST['testimonial_role'])) {
        update_post_meta($post_id, '_testimonial_role', sanitize_text_field($_POST['testimonial_role']));
    }
    if (isset($_POST['testimonial_rating'])) {
        update_post_meta($post_id, '_testimonial_rating', intval($_POST['testimonial_rating']));
    }
}
add_action('save_post', 'save_testimonial_meta');

// ==================== FORM HANDLERS ====================

// Contact Form
function handle_contact_form()
{
    if (! wp_verify_nonce($_POST['contact_nonce'] ?? '', 'contact_form_nonce')) {
        wp_die('Security check failed');
    }

    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    $post_id = wp_insert_post([
        'post_title' => $name.' - '.$subject,
        'post_type' => 'contact_message',
        'post_status' => 'publish',
    ]);

    if ($post_id && ! is_wp_error($post_id)) {
        update_post_meta($post_id, '_contact_name', $name);
        update_post_meta($post_id, '_contact_email', $email);
        update_post_meta($post_id, '_contact_phone', $phone);
        update_post_meta($post_id, '_contact_subject', $subject);
        update_post_meta($post_id, '_contact_message', $message);

        // Email notification
        $to = get_option('admin_email');
        $email_subject = 'New Contact: '.$subject;
        $email_message = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        wp_mail($to, $email_subject, $email_message);

        wp_redirect(add_query_arg('success', '1', wp_get_referer()));
        exit;
    }
}
add_action('admin_post_nopriv_contact_form', 'handle_contact_form');
add_action('admin_post_contact_form', 'handle_contact_form');

// Application Form
function handle_application_form()
{
    if (! wp_verify_nonce($_POST['application_nonce'] ?? '', 'application_form_nonce')) {
        wp_die('Security check failed');
    }

    $course_id = intval($_POST['course_id'] ?? 0);
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['last_name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $dob = sanitize_text_field($_POST['date_of_birth'] ?? '');
    $address = sanitize_textarea_field($_POST['address'] ?? '');
    $education = sanitize_textarea_field($_POST['education'] ?? '');
    $english = sanitize_text_field($_POST['english_proficiency'] ?? '');

    $course_title = $course_id ? get_the_title($course_id) : 'General Application';

    $post_id = wp_insert_post([
        'post_title' => "$first_name $last_name - $course_title",
        'post_type' => 'application',
        'post_status' => 'publish',
    ]);

    if ($post_id && ! is_wp_error($post_id)) {
        update_post_meta($post_id, '_course_id', $course_id);
        update_post_meta($post_id, '_first_name', $first_name);
        update_post_meta($post_id, '_last_name', $last_name);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_date_of_birth', $dob);
        update_post_meta($post_id, '_address', $address);
        update_post_meta($post_id, '_education', $education);
        update_post_meta($post_id, '_english_proficiency', $english);

        wp_redirect(add_query_arg('applied', '1', wp_get_referer()));
        exit;
    }
}
add_action('admin_post_nopriv_application_form', 'handle_application_form');
add_action('admin_post_application_form', 'handle_application_form');

// Event Registration Form
function handle_event_registration_form()
{
    if (! wp_verify_nonce($_POST['event_registration_nonce'] ?? '', 'event_registration_form_nonce')) {
        wp_die('Security check failed');
    }

    $event_id = intval($_POST['event_id'] ?? 0);
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['last_name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');

    $event_title = $event_id ? get_the_title($event_id) : 'Event Registration';

    $post_id = wp_insert_post([
        'post_title' => "$first_name $last_name - $event_title",
        'post_type' => 'event_registration',
        'post_status' => 'publish',
    ]);

    if ($post_id && ! is_wp_error($post_id)) {
        update_post_meta($post_id, '_event_id', $event_id);
        update_post_meta($post_id, '_first_name', $first_name);
        update_post_meta($post_id, '_last_name', $last_name);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_registered_at', current_time('mysql'));

        wp_redirect(add_query_arg('registered', '1', wp_get_referer()));
        exit;
    }
}
add_action('admin_post_nopriv_event_registration_form', 'handle_event_registration_form');
add_action('admin_post_event_registration_form', 'handle_event_registration_form');

// Newsletter Signup
function handle_newsletter_signup()
{
    $email = sanitize_email($_POST['email'] ?? '');

    if (is_email($email)) {
        $emails = get_option('fusion_college_newsletter_emails', []);
        if (! in_array($email, $emails)) {
            $emails[] = $email;
            update_option('fusion_college_newsletter_emails', $emails);
        }
    }

    wp_redirect(wp_get_referer());
    exit;
}
add_action('admin_post_nopriv_newsletter_signup', 'handle_newsletter_signup');
add_action('admin_post_newsletter_signup', 'handle_newsletter_signup');

// ==================== THEME CUSTOMIZER ====================

function fusion_college_customize_register($wp_customize)
{
    // Hero Section
    $wp_customize->add_section('hero_section', [
        'title' => 'Hero Section',
        'priority' => 30,
    ]);

    $hero_settings = [
        'hero_title' => 'Hero Title',
        'hero_subtitle' => 'Hero Subtitle',
        'hero_button_text' => 'Hero Button Text',
        'hero_button_url' => 'Hero Button URL',
    ];

    foreach ($hero_settings as $key => $label) {
        $wp_customize->add_setting($key, ['default' => get_college_setting($key), 'transport' => 'refresh']);
        $wp_customize->add_control($key, [
            'label' => $label,
            'section' => 'hero_section',
            'type' => 'text',
        ]);
    }

    // About Section
    $wp_customize->add_section('about_section', [
        'title' => 'About Section',
        'priority' => 31,
    ]);

    $about_settings = [
        'about_title' => 'About Title',
        'about_description' => 'About Description',
    ];

    foreach ($about_settings as $key => $label) {
        $wp_customize->add_setting($key, ['default' => get_college_setting($key), 'transport' => 'refresh']);
        $wp_customize->add_control($key, [
            'label' => $label,
            'section' => 'about_section',
            'type' => 'textarea',
        ]);
    }

    // Stats Section
    $wp_customize->add_section('stats_section', [
        'title' => 'Statistics Section',
        'priority' => 32,
    ]);

    $stats_settings = [
        'stats_students' => 'Students Count',
        'stats_employment' => 'Employment Rate %',
        'stats_trainers' => 'Trainers Count',
        'stats_countries' => 'Countries Count',
    ];

    foreach ($stats_settings as $key => $label) {
        $wp_customize->add_setting($key, ['default' => get_college_setting($key), 'transport' => 'refresh']);
        $wp_customize->add_control($key, [
            'label' => $label,
            'section' => 'stats_section',
            'type' => 'number',
        ]);
    }

    // CTA Section
    $wp_customize->add_section('cta_section', [
        'title' => 'CTA Section',
        'priority' => 33,
    ]);

    $cta_settings = [
        'cta_title' => 'CTA Title',
        'cta_subtitle' => 'CTA Subtitle',
        'cta_button_primary' => 'Primary Button Text',
        'cta_button_primary_url' => 'Primary Button URL',
        'cta_button_secondary' => 'Secondary Button Text',
        'cta_button_secondary_url' => 'Secondary Button URL',
    ];

    foreach ($cta_settings as $key => $label) {
        $wp_customize->add_setting($key, ['default' => get_college_setting($key), 'transport' => 'refresh']);
        $wp_customize->add_control($key, [
            'label' => $label,
            'section' => 'cta_section',
            'type' => 'text',
        ]);
    }

    // Contact Information
    $wp_customize->add_section('contact_info', [
        'title' => 'Contact Information',
        'priority' => 34,
    ]);

    $contact_settings = [
        'college_phone' => 'Phone Number',
        'college_email' => 'Email Address',
        'college_address' => 'Address',
    ];

    foreach ($contact_settings as $key => $label) {
        $wp_customize->add_setting($key, ['default' => get_college_setting(str_replace('college_', '', $key)), 'transport' => 'refresh']);
        $wp_customize->add_control($key, [
            'label' => $label,
            'section' => 'contact_info',
            'type' => 'text',
        ]);
    }

    // Social Media
    $wp_customize->add_section('social_media', [
        'title' => 'Social Media',
        'priority' => 35,
    ]);

    $social_settings = [
        'facebook_url' => 'Facebook URL',
        'twitter_url' => 'Twitter URL',
        'instagram_url' => 'Instagram URL',
        'linkedin_url' => 'LinkedIn URL',
    ];

    foreach ($social_settings as $key => $label) {
        $wp_customize->add_setting($key, ['default' => '', 'transport' => 'refresh']);
        $wp_customize->add_control($key, [
            'label' => $label,
            'section' => 'social_media',
            'type' => 'url',
        ]);
    }
}
add_action('customize_register', 'fusion_college_customize_register');

// ==================== PAGE TEMPLATES ====================

function fusion_college_page_templates($templates)
{
    $templates['page-contact.php'] = 'Contact Page';
    $templates['page-courses.php'] = 'Courses Page';
    $templates['page-events.php'] = 'Events Page';
    $templates['page-admissions.php'] = 'Admissions Page';

    return $templates;
}
add_filter('theme_page_templates', 'fusion_college_page_templates');

function fusion_college_load_page_template($template)
{
    if (is_page()) {
        $page_template = get_page_template_slug();
        if ($page_template) {
            $template_path = get_template_directory().'/'.$page_template;
            if (file_exists($template_path)) {
                return $template_path;
            }
        }
    }

    return $template;
}
add_filter('template_include', 'fusion_college_load_page_template');

// Create Default Pages on Theme Activation
function create_default_pages()
{
    $pages = [
        'Admissions' => 'page-admissions.php',
        'Contact' => 'page-contact.php',
    ];

    foreach ($pages as $title => $template) {
        if (! get_page_by_path(strtolower($title))) {
            $id = wp_insert_post([
                'post_title' => $title,
                'post_name' => strtolower($title),
                'post_type' => 'page',
                'post_status' => 'publish',
            ]);
            if ($template) {
                update_post_meta($id, '_wp_page_template', $template);
            }
        }
    }
}
add_action('after_switch_theme', 'create_default_pages');
