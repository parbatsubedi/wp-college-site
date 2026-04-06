<?php
/**
 * Fusion College Theme functions and definitions
 */

// Settings function
function get_college_setting($key, $default = null)
{
    $option_key = 'college_'.$key;
    $value = get_option($option_key);
    if ($value === false) {
        $defaults = [
            'college_name' => 'Fusion College of Technology',
            'tagline' => 'Empowering Future Leaders',
            'rto_number' => '45123',
            'cricos_code' => '03456J',
            'phone' => '1300 123 456',
            'email' => 'info@fusioncollege.edu.au',
            'address' => 'Sydney, Australia',
            'hero_title' => 'Empowering Future Professionals Through Quality Education',
            'hero_subtitle' => "Join Australia's leading vocational education provider",
            'about_description' => 'We are a leading registered training organisation committed to delivering high-quality vocational education and training.',
        ];
        if (isset($defaults[$key])) {
            $value = $defaults[$key];
            update_option($option_key, $value);
        } else {
            $value = $default;
        }
    }

    return $value;
}

// Theme setup
function fusion_college_theme_setup()
{
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('menus');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list']);
    add_theme_support('custom-background');
    add_theme_support('custom-header');

    // Register menus
    register_nav_menus([
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ]);

    // Add image sizes
    add_image_size('course-thumbnail', 400, 250, true);
    add_image_size('event-thumbnail', 400, 250, true);
    add_image_size('gallery-image', 600, 400, true);
}
add_action('after_setup_theme', 'fusion_college_theme_setup');

// Enqueue scripts and styles
function fusion_college_scripts()
{
    wp_enqueue_style('fusion-college-style', get_stylesheet_uri(), [], '1.0.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    wp_enqueue_script('fusion-college-js', get_template_directory_uri().'/js/script.js', ['jquery'], '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('fusion-college-js', 'fusion_college_ajax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fusion_college_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'fusion_college_scripts');

// Include admin functionality
require_once get_template_directory().'/admin.php';

// Custom post types
function create_custom_post_types()
{
    // Courses
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
            'not_found_in_trash' => 'No courses found in trash',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon' => 'dashicons-book',
        'rewrite' => ['slug' => 'courses', 'with_front' => false],
        'show_in_rest' => true,
    ]);

    // Events
    register_post_type('event', [
        'labels' => [
            'name' => 'Events',
            'singular_name' => 'Event',
            'add_new' => 'Add New Event',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'new_item' => 'New Event',
            'view_item' => 'View Event',
            'search_items' => 'Search Events',
            'not_found' => 'No events found',
            'not_found_in_trash' => 'No events found in trash',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon' => 'dashicons-calendar',
        'rewrite' => ['slug' => 'events', 'with_front' => false],
        'show_in_rest' => true,
    ]);

    // Announcements
    register_post_type('announcement', [
        'labels' => [
            'name' => 'Announcements',
            'singular_name' => 'Announcement',
            'add_new' => 'Add New Announcement',
            'add_new_item' => 'Add New Announcement',
            'edit_item' => 'Edit Announcement',
            'new_item' => 'New Announcement',
            'view_item' => 'View Announcement',
            'search_items' => 'Search Announcements',
            'not_found' => 'No announcements found',
            'not_found_in_trash' => 'No announcements found in trash',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon' => 'dashicons-megaphone',
        'rewrite' => ['slug' => 'announcements'],
        'show_in_rest' => true,
    ]);

    // Applications
    register_post_type('application', [
        'labels' => [
            'name' => 'Applications',
            'singular_name' => 'Application',
            'add_new' => 'Add New Application',
            'add_new_item' => 'Add New Application',
            'edit_item' => 'Edit Application',
            'new_item' => 'New Application',
            'view_item' => 'View Application',
            'search_items' => 'Search Applications',
            'not_found' => 'No applications found',
            'not_found_in_trash' => 'No applications found in trash',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-clipboard',
        'capability_type' => 'post',
        'show_in_rest' => true,
    ]);

    // Event Registrations
    register_post_type('event_registration', [
        'labels' => [
            'name' => 'Event Registrations',
            'singular_name' => 'Event Registration',
            'add_new' => 'Add New Registration',
            'add_new_item' => 'Add New Registration',
            'edit_item' => 'Edit Registration',
            'new_item' => 'New Registration',
            'view_item' => 'View Registration',
            'search_items' => 'Search Event Registrations',
            'not_found' => 'No registrations found',
            'not_found_in_trash' => 'No registrations found in trash',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-clipboard',
        'capability_type' => 'post',
        'show_in_rest' => true,
    ]);

    // Galleries
    register_post_type('gallery', [
        'labels' => [
            'name' => 'Galleries',
            'singular_name' => 'Gallery',
            'add_new' => 'Add New Gallery',
            'add_new_item' => 'Add New Gallery',
            'edit_item' => 'Edit Gallery',
            'new_item' => 'New Gallery',
            'view_item' => 'View Gallery',
            'search_items' => 'Search Galleries',
            'not_found' => 'No galleries found',
            'not_found_in_trash' => 'No galleries found in trash',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'menu_icon' => 'dashicons-images-alt',
        'rewrite' => ['slug' => 'galleries'],
        'show_in_rest' => true,
    ]);

    // Banners
    register_post_type('banner', [
        'labels' => [
            'name' => 'Banners',
            'singular_name' => 'Banner',
            'add_new' => 'Add New Banner',
            'add_new_item' => 'Add New Banner',
            'edit_item' => 'Edit Banner',
            'new_item' => 'New Banner',
            'view_item' => 'View Banner',
            'search_items' => 'Search Banners',
            'not_found' => 'No banners found',
            'not_found_in_trash' => 'No banners found in trash',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'thumbnail', 'custom-fields'],
        'menu_icon' => 'dashicons-images-alt2',
        'capability_type' => 'post',
        'show_in_rest' => true,
    ]);

    // Contact Messages
    register_post_type('contact_message', [
        'labels' => [
            'name' => 'Contact Messages',
            'singular_name' => 'Contact Message',
            'add_new' => 'Add New Message',
            'add_new_item' => 'Add New Contact Message',
            'edit_item' => 'Edit Contact Message',
            'new_item' => 'New Contact Message',
            'view_item' => 'View Contact Message',
            'search_items' => 'Search Contact Messages',
            'not_found' => 'No contact messages found',
            'not_found_in_trash' => 'No contact messages found in trash',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-email',
        'capability_type' => 'post',
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_custom_post_types');
add_action('init', 'flush_rewrite_rules');

// Custom taxonomies
function create_custom_taxonomies()
{
    // Course Categories
    register_taxonomy('course_category', 'course', [
        'labels' => [
            'name' => 'Course Categories',
            'singular_name' => 'Course Category',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);

    // Event Categories
    register_taxonomy('event_category', 'event', [
        'labels' => [
            'name' => 'Event Categories',
            'singular_name' => 'Event Category',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);

    // Study Modes
    register_taxonomy('study_mode', 'course', [
        'labels' => [
            'name' => 'Study Modes',
            'singular_name' => 'Study Mode',
        ],
        'hierarchical' => false,
        'show_in_rest' => true,
    ]);
}
add_action('init', 'create_custom_taxonomies');

// Custom meta boxes for courses
function add_course_meta_boxes()
{
    add_meta_box(
        'course_details',
        'Course Details',
        'course_details_meta_box_callback',
        'course',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_course_meta_boxes');

function course_details_meta_box_callback($post)
{
    wp_nonce_field('course_details_nonce', 'course_details_nonce');

    $duration = get_post_meta($post->ID, '_course_duration', true);
    $fee = get_post_meta($post->ID, '_course_fee', true);
    $study_mode = get_post_meta($post->ID, '_course_study_mode', true);
    $location = get_post_meta($post->ID, '_course_location', true);
    $cricos_code = get_post_meta($post->ID, '_course_cricos_code', true);
    $instructor = get_post_meta($post->ID, '_course_instructor', true);
    $curriculum = get_post_meta($post->ID, '_course_curriculum', true);
    $core_units = get_post_meta($post->ID, '_course_core_units', true);
    $elective_units = get_post_meta($post->ID, '_course_elective_units', true);
    $career_outcomes = get_post_meta($post->ID, '_course_career_outcomes', true);
    $entry_requirements = get_post_meta($post->ID, '_course_entry_requirements', true);
    $how_to_apply = get_post_meta($post->ID, '_course_how_to_apply', true);
    $international_requirements = get_post_meta($post->ID, '_course_international_requirements', true);
    $fees_payment_info = get_post_meta($post->ID, '_course_fees_payment_info', true);
    $policies_forms = get_post_meta($post->ID, '_course_policies_forms', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="course_duration">Duration</label></th>
            <td><input type="text" id="course_duration" name="course_duration" value="<?php echo esc_attr($duration); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="course_fee">Fee ($)</label></th>
            <td><input type="number" step="0.01" id="course_fee" name="course_fee" value="<?php echo esc_attr($fee); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="course_study_mode">Study Mode</label></th>
            <td><input type="text" id="course_study_mode" name="course_study_mode" value="<?php echo esc_attr($study_mode); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="course_location">Location</label></th>
            <td><input type="text" id="course_location" name="course_location" value="<?php echo esc_attr($location); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="course_cricos_code">CRICOS Code</label></th>
            <td><input type="text" id="course_cricos_code" name="course_cricos_code" value="<?php echo esc_attr($cricos_code); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="course_instructor">Instructor</label></th>
            <td><input type="text" id="course_instructor" name="course_instructor" value="<?php echo esc_attr($instructor); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="course_curriculum">Curriculum</label></th>
            <td><textarea id="course_curriculum" name="course_curriculum" rows="4" class="large-text"><?php echo esc_textarea($curriculum); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_core_units">Core Units (JSON)</label></th>
            <td><textarea id="course_core_units" name="course_core_units" rows="4" class="large-text"><?php echo esc_textarea($core_units); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_elective_units">Elective Units (JSON)</label></th>
            <td><textarea id="course_elective_units" name="course_elective_units" rows="4" class="large-text"><?php echo esc_textarea($elective_units); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_career_outcomes">Career Outcomes (JSON)</label></th>
            <td><textarea id="course_career_outcomes" name="course_career_outcomes" rows="4" class="large-text"><?php echo esc_textarea($career_outcomes); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_entry_requirements">Entry Requirements</label></th>
            <td><textarea id="course_entry_requirements" name="course_entry_requirements" rows="4" class="large-text"><?php echo esc_textarea($entry_requirements); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_how_to_apply">How to Apply</label></th>
            <td><textarea id="course_how_to_apply" name="course_how_to_apply" rows="4" class="large-text"><?php echo esc_textarea($how_to_apply); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_international_requirements">International Requirements</label></th>
            <td><textarea id="course_international_requirements" name="course_international_requirements" rows="4" class="large-text"><?php echo esc_textarea($international_requirements); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_fees_payment_info">Fees & Payment Info</label></th>
            <td><textarea id="course_fees_payment_info" name="course_fees_payment_info" rows="4" class="large-text"><?php echo esc_textarea($fees_payment_info); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="course_policies_forms">Policies & Forms</label></th>
            <td><textarea id="course_policies_forms" name="course_policies_forms" rows="4" class="large-text"><?php echo esc_textarea($policies_forms); ?></textarea></td>
        </tr>
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

    $fields = [
        'course_duration', 'course_fee', 'course_study_mode', 'course_location',
        'course_cricos_code', 'course_instructor', 'course_curriculum',
        'course_core_units', 'course_elective_units', 'course_career_outcomes',
        'course_entry_requirements', 'course_how_to_apply', 'course_international_requirements',
        'course_fees_payment_info', 'course_policies_forms',
    ];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_'.$field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'save_course_meta');

// Event meta boxes
function add_event_meta_boxes()
{
    add_meta_box(
        'event_details',
        'Event Details',
        'event_details_meta_box_callback',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_event_meta_boxes');

function event_details_meta_box_callback($post)
{
    wp_nonce_field('event_details_nonce', 'event_details_nonce');

    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $location = get_post_meta($post->ID, '_event_location', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="event_date">Event Date</label></th>
            <td><input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_time">Event Time</label></th>
            <td><input type="text" id="event_time" name="event_time" value="<?php echo esc_attr($event_time); ?>" class="regular-text" placeholder="e.g., 9:00 AM - 5:00 PM"></td>
        </tr>
        <tr>
            <th><label for="event_location">Location</label></th>
            <td><input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($location); ?>" class="regular-text"></td>
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

    $fields = ['event_date', 'event_time', 'event_location'];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_'.$field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'save_event_meta');

// Contact and form handling
function handle_contact_form()
{
    if (! wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_die('Security check failed');
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    // Create contact message post
    $post_data = [
        'post_title' => $name.' - '.$subject,
        'post_type' => 'contact_message',
        'post_status' => 'publish',
    ];

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        update_post_meta($post_id, '_contact_name', $name);
        update_post_meta($post_id, '_contact_email', $email);
        update_post_meta($post_id, '_contact_phone', $phone);
        update_post_meta($post_id, '_contact_subject', $subject);
        update_post_meta($post_id, '_contact_message', $message);

        // Send email notification
        $to = get_option('admin_email');
        $email_subject = 'New Contact Form Submission: '.$subject;
        $email_message = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

        wp_mail($to, $email_subject, $email_message);

        wp_redirect(add_query_arg('success', '1', wp_get_referer()));
        exit;
    }
}
add_action('admin_post_nopriv_contact_form', 'handle_contact_form');
add_action('admin_post_contact_form', 'handle_contact_form');

// Application form handling
function handle_application_form()
{
    if (! wp_verify_nonce($_POST['application_nonce'], 'application_form_nonce')) {
        wp_die('Security check failed');
    }

    $course_id = intval($_POST['course_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $address = sanitize_textarea_field($_POST['address']);
    $date_of_birth = sanitize_text_field($_POST['date_of_birth']);
    $education = sanitize_textarea_field($_POST['education']);
    $english_proficiency = sanitize_text_field($_POST['english_proficiency']);

    // Create application post
    $post_data = [
        'post_title' => $first_name.' '.$last_name.' - Application for '.get_the_title($course_id),
        'post_type' => 'application',
        'post_status' => 'publish',
    ];

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        update_post_meta($post_id, '_course_id', $course_id);
        update_post_meta($post_id, '_first_name', $first_name);
        update_post_meta($post_id, '_last_name', $last_name);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_address', $address);
        update_post_meta($post_id, '_date_of_birth', $date_of_birth);
        update_post_meta($post_id, '_education', $education);
        update_post_meta($post_id, '_english_proficiency', $english_proficiency);

        wp_redirect(add_query_arg('applied', '1', wp_get_referer()));
        exit;
    }
}
add_action('admin_post_nopriv_application_form', 'handle_application_form');
add_action('admin_post_application_form', 'handle_application_form');

function handle_event_registration_form()
{
    if (! wp_verify_nonce($_POST['event_registration_nonce'], 'event_registration_form_nonce')) {
        wp_die('Security check failed');
    }

    $event_id = intval($_POST['event_id']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $organization = sanitize_text_field($_POST['organization']);
    $position = sanitize_text_field($_POST['position']);
    $special_requirements = sanitize_textarea_field($_POST['special_requirements']);
    $additional_attendees = intval($_POST['additional_attendees']);

    $post_data = [
        'post_title' => $first_name.' '.$last_name.' - Registration for '.get_the_title($event_id),
        'post_type' => 'event_registration',
        'post_status' => 'publish',
    ];

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        update_post_meta($post_id, '_event_id', $event_id);
        update_post_meta($post_id, '_first_name', $first_name);
        update_post_meta($post_id, '_last_name', $last_name);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_organization', $organization);
        update_post_meta($post_id, '_position', $position);
        update_post_meta($post_id, '_special_requirements', $special_requirements);
        update_post_meta($post_id, '_additional_attendees', $additional_attendees);
        update_post_meta($post_id, '_registered_at', current_time('mysql'));

        wp_redirect(add_query_arg('registered', '1', wp_get_referer()));
        exit;
    }
}
add_action('admin_post_nopriv_event_registration_form', 'handle_event_registration_form');
add_action('admin_post_event_registration_form', 'handle_event_registration_form');

function handle_admission_application_form()
{
    if (! wp_verify_nonce($_POST['admission_application_nonce'], 'admission_application_form_nonce')) {
        wp_die('Security check failed');
    }

    $course_id = intval($_POST['preferred_course']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $date_of_birth = sanitize_text_field($_POST['date_of_birth']);
    $nationality = sanitize_text_field($_POST['nationality']);
    $study_mode = sanitize_text_field($_POST['study_mode']);
    $start_date = sanitize_text_field($_POST['start_date']);
    $highest_qualification = sanitize_text_field($_POST['highest_qualification']);
    $institution = sanitize_text_field($_POST['institution']);
    $graduation_year = intval($_POST['graduation_year']);
    $english_proficiency = sanitize_text_field($_POST['english_proficiency']);
    $address = sanitize_textarea_field($_POST['address']);
    $emergency_contact = sanitize_text_field($_POST['emergency_contact']);
    $emergency_phone = sanitize_text_field($_POST['emergency_phone']);
    $special_needs = sanitize_textarea_field($_POST['special_needs']);
    $how_did_you_hear = sanitize_text_field($_POST['how_did_you_hear']);

    $post_data = [
        'post_title' => $first_name.' '.$last_name.' - Admission Application',
        'post_type' => 'application',
        'post_status' => 'publish',
    ];

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        update_post_meta($post_id, '_application_type', 'admission');
        update_post_meta($post_id, '_course_id', $course_id);
        update_post_meta($post_id, '_first_name', $first_name);
        update_post_meta($post_id, '_last_name', $last_name);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_date_of_birth', $date_of_birth);
        update_post_meta($post_id, '_nationality', $nationality);
        update_post_meta($post_id, '_study_mode', $study_mode);
        update_post_meta($post_id, '_start_date', $start_date);
        update_post_meta($post_id, '_highest_qualification', $highest_qualification);
        update_post_meta($post_id, '_institution', $institution);
        update_post_meta($post_id, '_graduation_year', $graduation_year);
        update_post_meta($post_id, '_english_proficiency', $english_proficiency);
        update_post_meta($post_id, '_address', $address);
        update_post_meta($post_id, '_emergency_contact', $emergency_contact);
        update_post_meta($post_id, '_emergency_phone', $emergency_phone);
        update_post_meta($post_id, '_special_needs', $special_needs);
        update_post_meta($post_id, '_how_did_you_hear', $how_did_you_hear);
        update_post_meta($post_id, '_application_date', current_time('mysql'));

        wp_redirect(add_query_arg('applied', '1', wp_get_referer()));
        exit;
    }
}
add_action('admin_post_nopriv_admission_application_form', 'handle_admission_application_form');
add_action('admin_post_admission_application_form', 'handle_admission_application_form');

function handle_newsletter_signup()
{
    $email = sanitize_email($_POST['email']);

    if (is_email($email)) {
        $existing_emails = get_option('fusion_college_newsletter_emails', []);
        if (! in_array($email, $existing_emails)) {
            $existing_emails[] = $email;
            update_option('fusion_college_newsletter_emails', $existing_emails);
        }
    }

    wp_redirect(wp_get_referer());
    exit;
}
add_action('admin_post_nopriv_newsletter_signup', 'handle_newsletter_signup');
add_action('admin_post_newsletter_signup', 'handle_newsletter_signup');

// Theme customizer
function fusion_college_customize_register($wp_customize)
{
    // Hero Section
    $wp_customize->add_section('hero_section', [
        'title' => 'Hero Section',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('hero_title', [
        'default' => 'Welcome to Fusion College of Technology',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('hero_title', [
        'label' => 'Hero Title',
        'section' => 'hero_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('hero_subtitle', [
        'default' => 'Quality Education for Future Professionals',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('hero_subtitle', [
        'label' => 'Hero Subtitle',
        'section' => 'hero_section',
        'type' => 'textarea',
    ]);

    // Contact Information
    $wp_customize->add_section('contact_info', [
        'title' => 'Contact Information',
        'priority' => 31,
    ]);

    $wp_customize->add_setting('contact_phone', [
        'default' => '1300 123 456',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('contact_phone', [
        'label' => 'Phone Number',
        'section' => 'contact_info',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('contact_email', [
        'default' => 'info@pacificinstitute.edu.au',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('contact_email', [
        'label' => 'Email Address',
        'section' => 'contact_info',
        'type' => 'email',
    ]);

    $wp_customize->add_setting('contact_address', [
        'default' => 'Sydney, Australia',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('contact_address', [
        'label' => 'Address',
        'section' => 'contact_info',
        'type' => 'text',
    ]);
}
add_action('customize_register', 'fusion_college_customize_register');

// Shortcodes
function courses_shortcode($atts)
{
    $atts = shortcode_atts([
        'limit' => 6,
        'category' => '',
    ], $atts);

    $args = [
        'post_type' => 'course',
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish',
    ];

    if ($atts['category']) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'course_category',
                'field' => 'slug',
                'terms' => $atts['category'],
            ],
        ];
    }

    $courses = new WP_Query($args);
    $output = '<div class="courses-grid grid grid-3">';

    if ($courses->have_posts()) {
        while ($courses->have_posts()) {
            $courses->the_post();
            $output .= '<div class="card course-card">';
            if (has_post_thumbnail()) {
                $output .= '<img src="'.get_the_post_thumbnail_url(get_the_ID(), 'course-thumbnail').'" alt="'.get_the_title().'">';
            }
            $output .= '<div class="card-content">';
            $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
            $output .= '<p>'.get_the_excerpt().'</p>';
            $output .= '<a href="'.get_permalink().'" class="btn btn-secondary">Learn More</a>';
            $output .= '</div></div>';
        }
    }

    $output .= '</div>';
    wp_reset_postdata();

    return $output;
}
add_shortcode('courses', 'courses_shortcode');

function events_shortcode($atts)
{
    $atts = shortcode_atts([
        'limit' => 3,
    ], $atts);

    $args = [
        'post_type' => 'event',
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish',
        'meta_key' => '_event_start_date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => [
            [
                'key' => '_event_start_date',
                'value' => date('Y-m-d H:i:s'),
                'compare' => '>=',
                'type' => 'DATETIME',
            ],
        ],
    ];

    $events = new WP_Query($args);
    $output = '<div class="events-list grid grid-3">';

    if ($events->have_posts()) {
        while ($events->have_posts()) {
            $events->the_post();
            $start_date = get_post_meta(get_the_ID(), '_event_start_date', true);
            $location = get_post_meta(get_the_ID(), '_event_location', true);

            $output .= '<div class="card event-card">';
            if (has_post_thumbnail()) {
                $output .= '<img src="'.get_the_post_thumbnail_url(get_the_ID(), 'event-thumbnail').'" alt="'.get_the_title().'">';
            }
            $output .= '<div class="card-content">';
            $output .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
            if ($start_date) {
                $output .= '<p class="event-date">📅 '.date('M j, Y', strtotime($start_date)).'</p>';
            }
            if ($location) {
                $output .= '<p class="event-location">📍 '.$location.'</p>';
            }
            $output .= '<p>'.get_the_excerpt().'</p>';
            $output .= '<a href="'.get_permalink().'" class="btn btn-secondary">View Details</a>';
            $output .= '</div></div>';
        }
    }

    $output .= '</div>';
    wp_reset_postdata();

    return $output;
}
add_shortcode('events', 'events_shortcode');

// Page templates
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

// Create default pages on theme activation
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
add_action('after_switch_theme', 'flush_rewrite_rules');
?>