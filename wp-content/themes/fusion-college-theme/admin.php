<?php
/**
 * Admin Dashboard Customizations
 */

// Add custom dashboard widgets
function fusion_college_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'fusion_college_stats',
        'College Statistics',
        'fusion_college_dashboard_stats_widget'
    );

    wp_add_dashboard_widget(
        'fusion_college_recent_applications',
        'Recent Applications',
        'fusion_college_recent_applications_widget'
    );

    wp_add_dashboard_widget(
        'fusion_college_upcoming_events',
        'Upcoming Events',
        'fusion_college_upcoming_events_widget'
    );
}
add_action('wp_dashboard_setup', 'fusion_college_add_dashboard_widgets');

// Statistics dashboard widget
function fusion_college_dashboard_stats_widget() {
    // Get statistics
    $total_courses = wp_count_posts('course')->publish;
    $total_events = wp_count_posts('event')->publish;
    $total_applications = wp_count_posts('application')->publish;
    $total_announcements = wp_count_posts('announcement')->publish;

    // Get recent applications (last 30 days)
    $recent_applications = get_posts(array(
        'post_type' => 'application',
        'posts_per_page' => -1,
        'date_query' => array(
            array(
                'after' => '30 days ago',
                'inclusive' => true,
            ),
        ),
    ));

    // Get page views (if using custom tracking)
    $total_page_views = get_option('fusion_college_total_page_views', 0);

    echo '<div class="fusion-stats-grid">';
    echo '<div class="stat-item">';
    echo '<h3>' . $total_courses . '</h3>';
    echo '<p>Courses</p>';
    echo '<a href="' . admin_url('edit.php?post_type=course') . '" class="button">Manage Courses</a>';
    echo '</div>';

    echo '<div class="stat-item">';
    echo '<h3>' . $total_events . '</h3>';
    echo '<p>Events</p>';
    echo '<a href="' . admin_url('edit.php?post_type=event') . '" class="button">Manage Events</a>';
    echo '</div>';

    echo '<div class="stat-item">';
    echo '<h3>' . $total_applications . '</h3>';
    echo '<p>Applications</p>';
    echo '<a href="' . admin_url('edit.php?post_type=application') . '" class="button">View Applications</a>';
    echo '</div>';

    echo '<div class="stat-item">';
    echo '<h3>' . count($recent_applications) . '</h3>';
    echo '<p>Recent Applications</p>';
    echo '<span class="description">Last 30 days</span>';
    echo '</div>';

    echo '<div class="stat-item">';
    echo '<h3>' . $total_announcements . '</h3>';
    echo '<p>Announcements</p>';
    echo '<a href="' . admin_url('edit.php?post_type=announcement') . '" class="button">Manage Announcements</a>';
    echo '</div>';

    echo '<div class="stat-item">';
    echo '<h3>' . $total_page_views . '</h3>';
    echo '<p>Page Views</p>';
    echo '<span class="description">Total visits</span>';
    echo '</div>';

    echo '</div>';

    echo '<style>
        .fusion-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .stat-item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        .stat-item h3 {
            font-size: 2rem;
            color: #077E86;
            margin: 0 0 5px;
        }
        .stat-item p {
            margin: 0 0 15px;
            color: #666;
            font-weight: 600;
        }
        .stat-item .button {
            background: #077E86;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
        }
        .stat-item .description {
            font-size: 12px;
            color: #888;
        }
    </style>';
}

// Recent applications dashboard widget
function fusion_college_recent_applications_widget() {
    $recent_applications = get_posts(array(
        'post_type' => 'application',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    if ($recent_applications) {
        echo '<div class="recent-applications-list">';
        foreach ($recent_applications as $application) {
            $first_name = get_post_meta($application->ID, '_first_name', true);
            $last_name = get_post_meta($application->ID, '_last_name', true);
            $email = get_post_meta($application->ID, '_email', true);
            $course_id = get_post_meta($application->ID, '_course_id', true);
            $course_title = $course_id ? get_the_title($course_id) : 'N/A';

            echo '<div class="application-item">';
            echo '<div class="application-info">';
            echo '<h4>' . esc_html($first_name . ' ' . $last_name) . '</h4>';
            echo '<p><strong>Course:</strong> ' . esc_html($course_title) . '</p>';
            echo '<p><strong>Email:</strong> ' . esc_html($email) . '</p>';
            echo '<p><strong>Date:</strong> ' . get_the_date('M j, Y', $application->ID) . '</p>';
            echo '</div>';
            echo '<div class="application-actions">';
            echo '<a href="' . get_edit_post_link($application->ID) . '" class="button button-small">View</a>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '<p><a href="' . admin_url('edit.php?post_type=application') . '">View all applications</a></p>';
    } else {
        echo '<p>No recent applications.</p>';
    }

    echo '<style>
        .recent-applications-list {
            margin-bottom: 15px;
        }
        .application-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .application-item:last-child {
            border-bottom: none;
        }
        .application-info h4 {
            margin: 0 0 5px;
            color: #077E86;
        }
        .application-info p {
            margin: 2px 0;
            font-size: 13px;
            color: #666;
        }
        .application-actions {
            flex-shrink: 0;
        }
    </style>';
}

// Upcoming events dashboard widget
function fusion_college_upcoming_events_widget() {
    $upcoming_events = get_posts(array(
        'post_type' => 'event',
        'posts_per_page' => 5,
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

    if ($upcoming_events) {
        echo '<div class="upcoming-events-list">';
        foreach ($upcoming_events as $event) {
            $event_date = get_post_meta($event->ID, '_event_date', true);
            $event_time = get_post_meta($event->ID, '_event_time', true);
            $location = get_post_meta($event->ID, '_event_location', true);

            echo '<div class="event-item">';
            echo '<div class="event-info">';
            echo '<h4><a href="' . get_edit_post_link($event->ID) . '">' . get_the_title($event->ID) . '</a></h4>';
            echo '<p><strong>Date:</strong> ' . date('M j, Y', strtotime($event_date)) . '</p>';
            if ($event_time) echo '<p><strong>Time:</strong> ' . esc_html($event_time) . '</p>';
            if ($location) echo '<p><strong>Location:</strong> ' . esc_html($location) . '</p>';
            echo '</div>';
            echo '<div class="event-actions">';
            echo '<a href="' . get_edit_post_link($event->ID) . '" class="button button-small">Edit</a>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '<p><a href="' . admin_url('edit.php?post_type=event') . '">View all events</a></p>';
    } else {
        echo '<p>No upcoming events.</p>';
    }

    echo '<style>
        .upcoming-events-list {
            margin-bottom: 15px;
        }
        .event-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .event-item:last-child {
            border-bottom: none;
        }
        .event-info h4 {
            margin: 0 0 5px;
        }
        .event-info h4 a {
            color: #FF6B35;
            text-decoration: none;
        }
        .event-info p {
            margin: 2px 0;
            font-size: 13px;
            color: #666;
        }
        .event-actions {
            flex-shrink: 0;
        }
    </style>';
}

// Add custom admin menu
function fusion_college_admin_menu() {
    add_menu_page(
        'College Settings',
        'College Settings',
        'manage_options',
        'fusion-college-settings',
        'fusion_college_settings_page',
        'dashicons-welcome-learn-more',
        30
    );

    add_submenu_page(
        'fusion-college-settings',
        'General Settings',
        'General Settings',
        'manage_options',
        'fusion-college-settings',
        'fusion_college_settings_page'
    );

    add_submenu_page(
        'fusion-college-settings',
        'Contact Messages',
        'Contact Messages',
        'manage_options',
        'edit.php?post_type=contact_message'
    );

    add_submenu_page(
        'fusion-college-settings',
        'Applications',
        'Applications',
        'manage_options',
        'edit.php?post_type=application'
    );

    add_submenu_page(
        'fusion-college-settings',
        'Event Registrations',
        'Event Registrations',
        'manage_options',
        'edit.php?post_type=event_registration'
    );
}
add_action('admin_menu', 'fusion_college_admin_menu');

// Settings page
function fusion_college_settings_page() {
    if (isset($_POST['submit'])) {
        // Save settings
        update_option('fusion_college_contact_email', sanitize_email($_POST['contact_email']));
        update_option('fusion_college_contact_phone', sanitize_text_field($_POST['contact_phone']));
        update_option('fusion_college_address', sanitize_textarea_field($_POST['address']));
        update_option('fusion_college_facebook', esc_url_raw($_POST['facebook']));
        update_option('fusion_college_twitter', esc_url_raw($_POST['twitter']));
        update_option('fusion_college_instagram', esc_url_raw($_POST['instagram']));
        update_option('fusion_college_linkedin', esc_url_raw($_POST['linkedin']));

        echo '<div class="notice notice-success"><p>Settings saved successfully!</p></div>';
    }

    $contact_email = get_option('fusion_college_contact_email', '');
    $contact_phone = get_option('fusion_college_contact_phone', '');
    $address = get_option('fusion_college_address', '');
    $facebook = get_option('fusion_college_facebook', '');
    $twitter = get_option('fusion_college_twitter', '');
    $instagram = get_option('fusion_college_instagram', '');
    $linkedin = get_option('fusion_college_linkedin', '');

    ?>
    <div class="wrap">
        <h1>College Settings</h1>

        <form method="post" action="">
            <?php wp_nonce_field('fusion_college_settings'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">Contact Email</th>
                    <td>
                        <input type="email" name="contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text">
                        <p class="description">Primary contact email for the college</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Contact Phone</th>
                    <td>
                        <input type="text" name="contact_phone" value="<?php echo esc_attr($contact_phone); ?>" class="regular-text">
                        <p class="description">Primary contact phone number</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Address</th>
                    <td>
                        <textarea name="address" rows="3" class="large-text"><?php echo esc_textarea($address); ?></textarea>
                        <p class="description">College address</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">Social Media</th>
                    <td>
                        <p><label>Facebook URL<br>
                        <input type="url" name="facebook" value="<?php echo esc_attr($facebook); ?>" class="regular-text"></label></p>

                        <p><label>Twitter URL<br>
                        <input type="url" name="twitter" value="<?php echo esc_attr($twitter); ?>" class="regular-text"></label></p>

                        <p><label>Instagram URL<br>
                        <input type="url" name="instagram" value="<?php echo esc_attr($instagram); ?>" class="regular-text"></label></p>

                        <p><label>LinkedIn URL<br>
                        <input type="url" name="linkedin" value="<?php echo esc_attr($linkedin); ?>" class="regular-text"></label></p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Add custom columns to admin lists
function fusion_college_add_custom_columns($columns) {
    return array_merge($columns, array(
        'featured_image' => 'Image',
        'status' => 'Status'
    ));
}
add_filter('manage_course_posts_columns', 'fusion_college_add_custom_columns');
add_filter('manage_event_posts_columns', 'fusion_college_add_custom_columns');

// Populate custom columns
function fusion_college_custom_column_content($column, $post_id) {
    switch ($column) {
        case 'featured_image':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 50));
            } else {
                echo '—';
            }
            break;

        case 'status':
            $status = get_post_status($post_id);
            $status_labels = array(
                'publish' => 'Published',
                'draft' => 'Draft',
                'pending' => 'Pending',
                'private' => 'Private'
            );
            echo isset($status_labels[$status]) ? $status_labels[$status] : ucfirst($status);
            break;
    }
}
add_action('manage_course_posts_custom_column', 'fusion_college_custom_column_content', 10, 2);
add_action('manage_event_posts_custom_column', 'fusion_college_custom_column_content', 10, 2);

// Add quick edit for courses
function fusion_college_quick_edit_fields($column_name, $post_type) {
    if ($post_type === 'course' && $column_name === 'status') {
        ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label class="inline-edit-group">
                    <span class="title">Course Fee</span>
                    <input type="text" name="course_fee" value="">
                </label>
            </div>
        </fieldset>
        <?php
    }
}
add_action('quick_edit_custom_box', 'fusion_college_quick_edit_fields', 10, 2);

// Add admin notices for form submissions
function fusion_college_admin_notices() {
    if (isset($_GET['application_submitted']) && $_GET['application_submitted'] == '1') {
        echo '<div class="notice notice-success is-dismissible"><p>New application submitted successfully!</p></div>';
    }

    if (isset($_GET['contact_submitted']) && $_GET['contact_submitted'] == '1') {
        echo '<div class="notice notice-success is-dismissible"><p>New contact message received!</p></div>';
    }

    if (isset($_GET['event_registered']) && $_GET['event_registered'] == '1') {
        echo '<div class="notice notice-success is-dismissible"><p>New event registration received!</p></div>';
    }
}
add_action('admin_notices', 'fusion_college_admin_notices');

// Add export functionality for applications
function fusion_college_export_applications() {
    if (isset($_GET['export']) && $_GET['export'] === 'applications' && current_user_can('manage_options')) {
        $applications = get_posts(array(
            'post_type' => 'application',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="applications-' . date('Y-m-d') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Course', 'Date Submitted'));

        foreach ($applications as $application) {
            $first_name = get_post_meta($application->ID, '_first_name', true);
            $last_name = get_post_meta($application->ID, '_last_name', true);
            $email = get_post_meta($application->ID, '_email', true);
            $phone = get_post_meta($application->ID, '_phone', true);
            $course_id = get_post_meta($application->ID, '_course_id', true);
            $course_title = $course_id ? get_the_title($course_id) : '';

            fputcsv($output, array(
                $application->ID,
                $first_name,
                $last_name,
                $email,
                $phone,
                $course_title,
                get_the_date('Y-m-d', $application->ID)
            ));
        }

        fclose($output);
        exit;
    }
}
add_action('admin_init', 'fusion_college_export_applications');

// Add export button to applications page
function fusion_college_add_export_button() {
    $screen = get_current_screen();
    if ($screen->post_type === 'application') {
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.wrap .page-title-action').after('<a href="<?php echo admin_url('edit.php?post_type=application&export=applications'); ?>" class="page-title-action">Export CSV</a>');
        });
        </script>
        <?php
    }
}
add_action('admin_head', 'fusion_college_add_export_button');

// Custom admin CSS
function fusion_college_admin_styles() {
    ?>
    <style>
        .wp-admin .fusion-stats-grid {
            margin: 0 -10px;
        }

        .wp-admin .stat-item {
            margin: 0 10px 20px;
        }

        .wp-admin .stat-item .button {
            margin-top: 10px;
        }

        /* Custom post type icons */
        .wp-admin #menu-posts-course .wp-menu-image:before {
            content: "🎓";
        }

        .wp-admin #menu-posts-event .wp-menu-image:before {
            content: "📅";
        }

        .wp-admin #menu-posts-announcement .wp-menu-image:before {
            content: "📢";
        }

        .wp-admin #menu-posts-application .wp-menu-image:before {
            content: "📝";
        }

        /* Dashboard widget improvements */
        .wp-admin .recent-applications-list,
        .wp-admin .upcoming-events-list {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
    <?php
}
add_action('admin_head', 'fusion_college_admin_styles');

// Add meta boxes for better content organization
function fusion_college_add_meta_boxes() {
    // Course meta boxes
    add_meta_box(
        'course_details',
        'Course Details',
        'fusion_college_course_details_meta_box',
        'course',
        'normal',
        'high'
    );

    // Event meta boxes
    add_meta_box(
        'event_details',
        'Event Details',
        'fusion_college_event_details_meta_box',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'fusion_college_add_meta_boxes');

// Course details meta box
function fusion_college_course_details_meta_box($post) {
    wp_nonce_field('fusion_college_course_meta_box', 'fusion_college_course_meta_box_nonce');

    $duration = get_post_meta($post->ID, '_course_duration', true);
    $fee = get_post_meta($post->ID, '_course_fee', true);
    $study_mode = get_post_meta($post->ID, '_course_study_mode', true);
    $location = get_post_meta($post->ID, '_course_location', true);
    $cricos_code = get_post_meta($post->ID, '_course_cricos_code', true);

    ?>
    <table class="form-table">
        <tr>
            <th><label for="course_duration">Duration</label></th>
            <td><input type="text" id="course_duration" name="course_duration" value="<?php echo esc_attr($duration); ?>" class="regular-text" placeholder="e.g., 2 years full-time"></td>
        </tr>
        <tr>
            <th><label for="course_fee">Fee</label></th>
            <td><input type="number" id="course_fee" name="course_fee" value="<?php echo esc_attr($fee); ?>" step="0.01" class="regular-text" placeholder="e.g., 25000.00"></td>
        </tr>
        <tr>
            <th><label for="course_study_mode">Study Mode</label></th>
            <td>
                <select id="course_study_mode" name="course_study_mode" class="regular-text">
                    <option value="">Select mode</option>
                    <option value="Full-time" <?php selected($study_mode, 'Full-time'); ?>>Full-time</option>
                    <option value="Part-time" <?php selected($study_mode, 'Part-time'); ?>>Part-time</option>
                    <option value="Online" <?php selected($study_mode, 'Online'); ?>>Online</option>
                    <option value="Blended" <?php selected($study_mode, 'Blended'); ?>>Blended</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="course_location">Location</label></th>
            <td><input type="text" id="course_location" name="course_location" value="<?php echo esc_attr($location); ?>" class="regular-text" placeholder="e.g., Main Campus"></td>
        </tr>
        <tr>
            <th><label for="course_cricos_code">CRICOS Code</label></th>
            <td><input type="text" id="course_cricos_code" name="course_cricos_code" value="<?php echo esc_attr($cricos_code); ?>" class="regular-text" placeholder="e.g., 012345C"></td>
        </tr>
    </table>
    <?php
}

// Event details meta box
function fusion_college_event_details_meta_box($post) {
    wp_nonce_field('fusion_college_event_meta_box', 'fusion_college_event_meta_box_nonce');

    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $location = get_post_meta($post->ID, '_event_location', true);
    $organizer = get_post_meta($post->ID, '_event_organizer', true);
    $contact_email = get_post_meta($post->ID, '_event_contact_email', true);
    $contact_phone = get_post_meta($post->ID, '_event_contact_phone', true);
    $max_attendees = get_post_meta($post->ID, '_event_max_attendees', true);
    $registration_deadline = get_post_meta($post->ID, '_event_registration_deadline', true);

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
            <td><input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($location); ?>" class="regular-text" placeholder="Venue address"></td>
        </tr>
        <tr>
            <th><label for="event_organizer">Organizer</label></th>
            <td><input type="text" id="event_organizer" name="event_organizer" value="<?php echo esc_attr($organizer); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_contact_email">Contact Email</label></th>
            <td><input type="email" id="event_contact_email" name="event_contact_email" value="<?php echo esc_attr($contact_email); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_contact_phone">Contact Phone</label></th>
            <td><input type="tel" id="event_contact_phone" name="event_contact_phone" value="<?php echo esc_attr($contact_phone); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="event_max_attendees">Max Attendees</label></th>
            <td><input type="number" id="event_max_attendees" name="event_max_attendees" value="<?php echo esc_attr($max_attendees); ?>" class="regular-text" min="1"></td>
        </tr>
        <tr>
            <th><label for="event_registration_deadline">Registration Deadline</label></th>
            <td><input type="date" id="event_registration_deadline" name="event_registration_deadline" value="<?php echo esc_attr($registration_deadline); ?>" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

// Save meta box data
function fusion_college_save_meta_boxes($post_id) {
    // Course meta box
    if (isset($_POST['fusion_college_course_meta_box_nonce']) && wp_verify_nonce($_POST['fusion_college_course_meta_box_nonce'], 'fusion_college_course_meta_box')) {
        update_post_meta($post_id, '_course_duration', sanitize_text_field($_POST['course_duration']));
        update_post_meta($post_id, '_course_fee', floatval($_POST['course_fee']));
        update_post_meta($post_id, '_course_study_mode', sanitize_text_field($_POST['course_study_mode']));
        update_post_meta($post_id, '_course_location', sanitize_text_field($_POST['course_location']));
        update_post_meta($post_id, '_course_cricos_code', sanitize_text_field($_POST['course_cricos_code']));
    }

    // Event meta box
    if (isset($_POST['fusion_college_event_meta_box_nonce']) && wp_verify_nonce($_POST['fusion_college_event_meta_box_nonce'], 'fusion_college_event_meta_box')) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
        update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
        update_post_meta($post_id, '_event_organizer', sanitize_text_field($_POST['event_organizer']));
        update_post_meta($post_id, '_event_contact_email', sanitize_email($_POST['event_contact_email']));
        update_post_meta($post_id, '_event_contact_phone', sanitize_text_field($_POST['event_contact_phone']));
        update_post_meta($post_id, '_event_max_attendees', intval($_POST['event_max_attendees']));
        update_post_meta($post_id, '_event_registration_deadline', sanitize_text_field($_POST['event_registration_deadline']));
    }
}
add_action('save_post', 'fusion_college_save_meta_boxes');

// Add help tabs to custom post types
function fusion_college_add_help_tabs() {
    $screen = get_current_screen();

    if ($screen->post_type === 'course') {
        $screen->add_help_tab(array(
            'id' => 'course_help',
            'title' => 'Course Information',
            'content' => '<p><strong>Course Details:</strong> Fill in the course information in the "Course Details" meta box. This includes duration, fees, study mode, location, and CRICOS code.</p><p><strong>Content:</strong> Use the main content editor to add course description, curriculum, and other details.</p><p><strong>Categories:</strong> Assign course categories and study modes using the taxonomies on the right.</p>'
        ));
    }

    if ($screen->post_type === 'event') {
        $screen->add_help_tab(array(
            'id' => 'event_help',
            'title' => 'Event Information',
            'content' => '<p><strong>Event Details:</strong> Fill in the event information in the "Event Details" meta box. This includes date, time, location, organizer, and contact information.</p><p><strong>Content:</strong> Use the main content editor to add event description, agenda, and other details.</p><p><strong>Categories:</strong> Assign event categories using the taxonomy on the right.</p>'
        ));
    }
}
add_action('admin_head', 'fusion_college_add_help_tabs');