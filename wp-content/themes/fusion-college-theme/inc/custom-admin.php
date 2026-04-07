<?php
/**
 * Custom Admin Pages - Laravel-style Table Forms
 * Provides clean table-based admin interface for managing content
 */

if (! defined('ABSPATH')) {
    exit;
}

// Add custom admin menu for table-based management
function fusion_custom_admin_menu()
{
    add_menu_page(
        'College Data',
        'College Data',
        'manage_options',
        'fusion-data',
        'fusion_data_dashboard',
        'dashicons-database',
        25
    );

    add_submenu_page(
        'fusion-data',
        'All Courses',
        'Courses',
        'manage_options',
        'fusion-courses',
        'fusion_courses_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Add Course',
        'Add Course',
        'manage_options',
        'fusion-add-course',
        'fusion_add_course_page'
    );

    add_submenu_page(
        'fusion-data',
        'All Events',
        'Events',
        'manage_options',
        'fusion-events',
        'fusion_events_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Add Event',
        'Add Event',
        'manage_options',
        'fusion-add-event',
        'fusion_add_event_page'
    );

    add_submenu_page(
        'fusion-data',
        'Applications',
        'Applications',
        'manage_options',
        'fusion-applications',
        'fusion_applications_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Testimonials',
        'Testimonials',
        'manage_options',
        'fusion-testimonials',
        'fusion_testimonials_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Banners',
        'Banners',
        'manage_options',
        'fusion-banners',
        'fusion_banners_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Announcements',
        'Announcements',
        'manage_options',
        'fusion-announcements',
        'fusion_announcements_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Gallery',
        'Gallery',
        'manage_options',
        'fusion-gallery',
        'fusion_gallery_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Contact Messages',
        'Contact Messages',
        'manage_options',
        'fusion-contacts',
        'fusion_contacts_admin_page'
    );

    add_submenu_page(
        'fusion-data',
        'Settings',
        'Settings',
        'manage_options',
        'fusion-settings',
        'fusion_settings_page'
    );
}
add_action('admin_menu', 'fusion_custom_admin_menu');

// Dashboard
function fusion_data_dashboard()
{
    $courses_count = wp_count_posts('course')->publish;
    $events_count = wp_count_posts('event')->publish;
    $applications_count = wp_count_posts('application')->publish;
    $testimonials_count = wp_count_posts('testimonial')->publish;
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1>College Data Dashboard</h1>
        
        <div class="fusion-dashboard-cards">
            <div class="fusion-card">
                <div class="fusion-card-icon" style="background: linear-gradient(135deg, #077E86, #2A7970);">
                    <span>📚</span>
                </div>
                <div class="fusion-card-content">
                    <h3><?php echo $courses_count; ?></h3>
                    <p>Courses</p>
                    <a href="?page=fusion-courses" class="fusion-card-link">Manage →</a>
                </div>
            </div>
            
            <div class="fusion-card">
                <div class="fusion-card-icon" style="background: linear-gradient(135deg, #CF5E1C, #FD6406);">
                    <span>📅</span>
                </div>
                <div class="fusion-card-content">
                    <h3><?php echo $events_count; ?></h3>
                    <p>Events</p>
                    <a href="?page=fusion-events" class="fusion-card-link">Manage →</a>
                </div>
            </div>
            
            <div class="fusion-card">
                <div class="fusion-card-icon" style="background: linear-gradient(135deg, #172566, #1e3170);">
                    <span>📝</span>
                </div>
                <div class="fusion-card-content">
                    <h3><?php echo $applications_count; ?></h3>
                    <p>Applications</p>
                    <a href="?page=fusion-applications" class="fusion-card-link">View →</a>
                </div>
            </div>
            
            <div class="fusion-card">
                <div class="fusion-card-icon" style="background: linear-gradient(135deg, #077E86, #172566);">
                    <span>💬</span>
                </div>
                <div class="fusion-card-content">
                    <h3><?php echo $testimonials_count; ?></h3>
                    <p>Testimonials</p>
                    <a href="?page=fusion-testimonials" class="fusion-card-link">Manage →</a>
                </div>
            </div>
        </div>

        <style>
        .fusion-admin-wrap { padding: 20px; }
        .fusion-dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .fusion-card {
            background: white;
            border-radius: 12px;
            padding: 0;
            display: flex;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .fusion-card-icon {
            width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }
        .fusion-card-content {
            padding: 20px;
            flex: 1;
        }
        .fusion-card-content h3 {
            margin: 0;
            font-size: 32px;
            color: #1a1a1a;
        }
        .fusion-card-content p {
            margin: 5px 0 15px;
            color: #666;
        }
        .fusion-card-link {
            color: #077E86;
            font-weight: 600;
            text-decoration: none;
        }
        </style>
    </div>
    <?php
}

// Courses Admin Page
function fusion_courses_admin_page()
{
    $courses = get_posts([
        'post_type' => 'course',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ]);
    ?>
    <div class="wrap fusion-admin-wrap">
        <div class="fusion-header-row">
            <h1>All Courses</h1>
            <a href="?page=fusion-add-course" class="button button-primary">+ Add New Course</a>
        </div>

        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Fee</th>
                    <th>Study Mode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($courses): foreach ($courses as $course): 
                    $category = get_the_terms($course->ID, 'course_category');
                    $duration = get_post_meta($course->ID, '_course_duration', true);
                    $fee = get_post_meta($course->ID, '_course_fee', true);
                    $study_mode = get_post_meta($course->ID, '_course_study_mode', true);
                ?>
                <tr>
                    <td><?php echo $course->ID; ?></td>
                    <td><strong><?php echo esc_html($course->post_title); ?></strong></td>
                    <td><?php echo $category ? $category[0]->name : '-'; ?></td>
                    <td><?php echo esc_html($duration ?: '-'); ?></td>
                    <td><?php echo $fee ? '$' . number_format($fee) : '-'; ?></td>
                    <td><?php echo esc_html($study_mode ?: '-'); ?></td>
                    <td>
                        <a href="<?php echo get_edit_post_link($course->ID); ?>" class="button button-small">Edit</a>
                        <a href="<?php echo get_permalink($course->ID); ?>" class="button button-small" target="_blank">View</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="7">No courses found. <a href="?page=fusion-add-course">Add one now</a></td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <style>
        .fusion-header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .fusion-table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .fusion-table th, .fusion-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        .fusion-table th { background: #f8f9fa; font-weight: 600; color: #333; }
        .fusion-table tr:hover { background: #f8f9fa; }
        </style>
    </div>
    <?php
}

// Add/Edit Course Page
function fusion_add_course_page()
{
    $course_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
    $is_edit = $course_id > 0;
    
    if ($is_edit) {
        $course = get_post($course_id);
        $duration = get_post_meta($course_id, '_course_duration', true);
        $fee = get_post_meta($course_id, '_course_fee', true);
        $study_mode = get_post_meta($course_id, '_course_study_mode', true);
        $location = get_post_meta($course_id, '_course_location', true);
        $cricos = get_post_meta($course_id, '_course_cricos_code', true);
        $curriculum = get_post_meta($course_id, '_course_curriculum', true);
        $career = get_post_meta($course_id, '_course_career_outcomes', true);
        $requirements = get_post_meta($course_id, '_course_entry_requirements', true);
    }

    // Save course
    if (isset($_POST['save_course'])) {
        $title = sanitize_text_field($_POST['title']);
        $content = wp_kses_post($_POST['description']);
        
        $post_data = [
            'post_title' => $title,
            'post_content' => $content,
            'post_type' => 'course',
            'post_status' => 'publish',
        ];
        
        if ($is_edit) {
            $post_data['ID'] = $course_id;
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_course_duration', sanitize_text_field($_POST['duration']));
            update_post_meta($post_id, '_course_fee', floatval($_POST['fee']));
            update_post_meta($post_id, '_course_study_mode', sanitize_text_field($_POST['study_mode']));
            update_post_meta($post_id, '_course_location', sanitize_text_field($_POST['location']));
            update_post_meta($post_id, '_course_cricos_code', sanitize_text_field($_POST['cricos']));
            update_post_meta($post_id, '_course_curriculum', sanitize_textarea_field($_POST['curriculum']));
            update_post_meta($post_id, '_course_career_outcomes', sanitize_textarea_field($_POST['career']));
            update_post_meta($post_id, '_course_entry_requirements', sanitize_textarea_field($_POST['requirements']));
            
            if (!$is_edit && isset($_POST['category'])) {
                wp_set_object_terms($post_id, intval($_POST['category']), 'course_category');
            }
            
            echo '<div class="notice notice-success"><p>Course saved successfully!</p></div>';
            if (!$is_edit) {
                $is_edit = true;
                $course_id = $post_id;
            }
        }
    }
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1><?php echo $is_edit ? 'Edit Course' : 'Add New Course'; ?></h1>
        
        <form method="post" class="fusion-form">
            <div class="fusion-form-section">
                <h3>Basic Information</h3>
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Course Title *</label></th>
                        <td><input type="text" name="title" value="<?php echo $is_edit ? esc_attr($course->post_title) : ''; ?>" required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Description</label></th>
                        <td><textarea name="description" rows="5" class="large-text"><?php echo $is_edit ? $course->post_content : ''; ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label>Category</label></th>
                        <td>
                            <select name="category">
                                <option value="">Select Category</option>
                                <?php 
                                $categories = get_terms(['taxonomy' => 'course_category', 'hide_empty' => false]);
                                foreach ($categories as $cat): 
                                    $selected = $is_edit && has_term($cat->term_id, 'course_category', $course_id);
                                ?>
                                <option value="<?php echo $cat->term_id; ?>" <?php selected($selected); ?>><?php echo $cat->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="fusion-form-section">
                <h3>Course Details</h3>
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Duration</label></th>
                        <td><input type="text" name="duration" value="<?php echo esc_attr($duration ?? ''); ?>" placeholder="e.g., 52 weeks" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Fee ($)</label></th>
                        <td><input type="number" name="fee" value="<?php echo esc_attr($fee ?? ''); ?>" step="0.01" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Study Mode</label></th>
                        <td>
                            <select name="study_mode">
                                <option value="">Select Mode</option>
                                <option value="Full-time" <?php selected($study_mode ?? '', 'Full-time'); ?>>Full-time</option>
                                <option value="Part-time" <?php selected($study_mode ?? '', 'Part-time'); ?>>Part-time</option>
                                <option value="Online" <?php selected($study_mode ?? '', 'Online'); ?>>Online</option>
                                <option value="Blended" <?php selected($study_mode ?? '', 'Blended'); ?>>Blended</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label>Location</label></th>
                        <td><input type="text" name="location" value="<?php echo esc_attr($location ?? ''); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>CRICOS Code</label></th>
                        <td><input type="text" name="cricos" value="<?php echo esc_attr($cricos ?? ''); ?>" class="regular-text"></td>
                    </tr>
                </table>
            </div>

            <div class="fusion-form-section">
                <h3>Additional Information</h3>
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Curriculum Description</label></th>
                        <td><textarea name="curriculum" rows="4" class="large-text"><?php echo esc_textarea($curriculum ?? ''); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label>Career Outcomes</label></th>
                        <td><textarea name="career" rows="4" class="large-text" placeholder="One outcome per line"><?php echo esc_textarea($career ?? ''); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label>Entry Requirements</label></th>
                        <td><textarea name="requirements" rows="4" class="large-text"><?php echo esc_textarea($requirements ?? ''); ?></textarea></td>
                    </tr>
                </table>
            </div>

            <p class="submit">
                <button type="submit" name="save_course" class="button button-primary">Save Course</button>
                <a href="?page=fusion-courses" class="button">Cancel</a>
            </p>
        </form>

        <style>
        .fusion-form-section { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .fusion-form-section h3 { margin: 0 0 20px; padding-bottom: 10px; border-bottom: 2px solid #077E86; color: #077E86; }
        .fusion-form-table { width: 100%; }
        .fusion-form-table th { width: 200px; text-align: left; padding: 15px 0; vertical-align: top; }
        .fusion-form-table td { padding: 15px 0; }
        .fusion-form-table input, .fusion-form-table select, .fusion-form-table textarea { width: 100%; max-width: 500px; }
        .submit { margin-top: 20px; }
        </style>
    </div>
    <?php
}

// Events Admin Page
function fusion_events_admin_page()
{
    $events = get_posts([
        'post_type' => 'event',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_key' => '_event_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',
    ]);
    ?>
    <div class="wrap fusion-admin-wrap">
        <div class="fusion-header-row">
            <h1>All Events</h1>
            <a href="?page=fusion-add-event" class="button button-primary">+ Add New Event</a>
        </div>

        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($events): foreach ($events as $event): 
                    $event_date = get_post_meta($event->ID, '_event_date', true);
                    $event_time = get_post_meta($event->ID, '_event_time', true);
                    $location = get_post_meta($event->ID, '_event_location', true);
                ?>
                <tr>
                    <td><?php echo $event->ID; ?></td>
                    <td><strong><?php echo esc_html($event->post_title); ?></strong></td>
                    <td><?php echo $event_date ? date('M d, Y', strtotime($event_date)) : '-'; ?></td>
                    <td><?php echo esc_html($event_time ?: '-'); ?></td>
                    <td><?php echo esc_html($location ?: '-'); ?></td>
                    <td>
                        <a href="?page=fusion-add-event&edit=<?php echo $event->ID; ?>" class="button button-small">Edit</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6">No events found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Add/Edit Event Page
function fusion_add_event_page()
{
    $event_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
    $is_edit = $event_id > 0;
    
    if ($is_edit) {
        $event = get_post($event_id);
        $event_date = get_post_meta($event_id, '_event_date', true);
        $event_time = get_post_meta($event_id, '_event_time', true);
        $location = get_post_meta($event_id, '_event_location', true);
        $organizer = get_post_meta($event_id, '_event_organizer', true);
        $contact_email = get_post_meta($event_id, '_event_contact_email', true);
        $contact_phone = get_post_meta($event_id, '_event_contact_phone', true);
    }

    if (isset($_POST['save_event'])) {
        $title = sanitize_text_field($_POST['title']);
        $content = wp_kses_post($_POST['description']);
        
        $post_data = [
            'post_title' => $title,
            'post_content' => $content,
            'post_type' => 'event',
            'post_status' => 'publish',
        ];
        
        if ($is_edit) {
            $post_data['ID'] = $event_id;
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
            update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
            update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['location']));
            update_post_meta($post_id, '_event_organizer', sanitize_text_field($_POST['organizer']));
            update_post_meta($post_id, '_event_contact_email', sanitize_email($_POST['contact_email']));
            update_post_meta($post_id, '_event_contact_phone', sanitize_text_field($_POST['contact_phone']));
            
            echo '<div class="notice notice-success"><p>Event saved successfully!</p></div>';
            if (!$is_edit) {
                $is_edit = true;
                $event_id = $post_id;
                $event = get_post($event_id);
            }
        }
    }
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1><?php echo $is_edit ? 'Edit Event' : 'Add New Event'; ?></h1>
        
        <form method="post" class="fusion-form">
            <div class="fusion-form-section">
                <h3>Event Information</h3>
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Event Title *</label></th>
                        <td><input type="text" name="title" value="<?php echo $is_edit ? esc_attr($event->post_title) : ''; ?>" required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Description</label></th>
                        <td><textarea name="description" rows="5" class="large-text"><?php echo $is_edit ? $event->post_content : ''; ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label>Date *</label></th>
                        <td><input type="date" name="event_date" value="<?php echo esc_attr($event_date ?? ''); ?>" required></td>
                    </tr>
                    <tr>
                        <th><label>Time</label></th>
                        <td><input type="text" name="event_time" value="<?php echo esc_attr($event_time ?? ''); ?>" placeholder="e.g., 9:00 AM - 5:00 PM" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Location</label></th>
                        <td><input type="text" name="location" value="<?php echo esc_attr($location ?? ''); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Organizer</label></th>
                        <td><input type="text" name="organizer" value="<?php echo esc_attr($organizer ?? ''); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Contact Email</label></th>
                        <td><input type="email" name="contact_email" value="<?php echo esc_attr($contact_email ?? ''); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Contact Phone</label></th>
                        <td><input type="text" name="contact_phone" value="<?php echo esc_attr($contact_phone ?? ''); ?>" class="regular-text"></td>
                    </tr>
                </table>
            </div>

            <p class="submit">
                <button type="submit" name="save_event" class="button button-primary">Save Event</button>
                <a href="?page=fusion-events" class="button">Cancel</a>
            </p>
        </form>
    </div>
    <?php
}

// Applications Admin Page
function fusion_applications_admin_page()
{
    $applications = get_posts([
        'post_type' => 'application',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1>Applications</h1>

        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($applications): foreach ($applications as $app): 
                    $first_name = get_post_meta($app->ID, '_first_name', true);
                    $last_name = get_post_meta($app->ID, '_last_name', true);
                    $email = get_post_meta($app->ID, '_email', true);
                    $phone = get_post_meta($app->ID, '_phone', true);
                    $course_id = get_post_meta($app->ID, '_course_id', true);
                    $course = $course_id ? get_the_title($course_id) : 'General';
                ?>
                <tr>
                    <td><?php echo $app->ID; ?></td>
                    <td><strong><?php echo esc_html($first_name . ' ' . $last_name); ?></strong></td>
                    <td><?php echo esc_html($email); ?></td>
                    <td><?php echo esc_html($phone); ?></td>
                    <td><?php echo esc_html($course); ?></td>
                    <td><?php echo get_the_date('M d, Y', $app->ID); ?></td>
                    <td>
                        <a href="#" class="button button-small" onclick="alert('Name: <?php echo esc_html($first_name . ' ' . $last_name); ?>\nEmail: <?php echo esc_html($email); ?>\nPhone: <?php echo esc_html($phone); ?>\nAddress: <?php echo esc_html(get_post_meta($app->ID, '_address', true)); ?>\nEducation: <?php echo esc_html(get_post_meta($app->ID, '_education', true)); ?>'); return false;">View</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="7">No applications yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Testimonials Admin Page
function fusion_testimonials_admin_page()
{
    $testimonials = get_posts([
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ]);

    // Save testimonial
    if (isset($_POST['save_testimonial'])) {
        $title = sanitize_text_field($_POST['name']);
        $content = wp_kses_post($_POST['content']);
        
        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_content' => $content,
            'post_type' => 'testimonial',
            'post_status' => 'publish',
        ]);
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_testimonial_name', sanitize_text_field($_POST['name']));
            update_post_meta($post_id, '_testimonial_role', sanitize_text_field($_POST['role']));
            update_post_meta($post_id, '_testimonial_rating', intval($_POST['rating']));
            echo '<div class="notice notice-success"><p>Testimonial saved!</p></div>';
        }
    }
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1>Testimonials</h1>
        
        <div class="fusion-form-section">
            <h3>Add New Testimonial</h3>
            <form method="post" class="fusion-form">
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Name *</label></th>
                        <td><input type="text" name="name" required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Role/Title</label></th>
                        <td><input type="text" name="role" placeholder="e.g., Diploma of IT Graduate" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Rating</label></th>
                        <td>
                            <select name="rating">
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label>Testimonial *</label></th>
                        <td><textarea name="content" rows="5" class="large-text" required></textarea></td>
                    </tr>
                </table>
                <p class="submit"><button type="submit" name="save_testimonial" class="button button-primary">Add Testimonial</button></p>
            </form>
        </div>

        <h2>Existing Testimonials</h2>
        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($testimonials): foreach ($testimonials as $t): 
                    $name = get_post_meta($t->ID, '_testimonial_name', true);
                    $role = get_post_meta($t->ID, '_testimonial_role', true);
                    $rating = get_post_meta($t->ID, '_testimonial_rating', true);
                ?>
                <tr>
                    <td><?php echo $t->ID; ?></td>
                    <td><strong><?php echo esc_html($name ?: $t->post_title); ?></strong></td>
                    <td><?php echo esc_html($role); ?></td>
                    <td><?php echo str_repeat('★', $rating ?: 5); ?></td>
                    <td><a href="<?php echo get_edit_post_link($t->ID); ?>" class="button button-small">Edit</a></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="5">No testimonials yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Settings Page
function fusion_settings_page()
{
    if (isset($_POST['save_settings'])) {
        update_option('fusion_college_name', sanitize_text_field($_POST['college_name']));
        update_option('fusion_college_tagline', sanitize_text_field($_POST['tagline']));
        update_option('fusion_college_phone', sanitize_text_field($_POST['phone']));
        update_option('fusion_college_email', sanitize_email($_POST['email']));
        update_option('fusion_college_address', sanitize_textarea_field($_POST['address']));
        update_option('fusion_college_rto', sanitize_text_field($_POST['rto']));
        update_option('fusion_college_cricos', sanitize_text_field($_POST['cricos']));
        
        echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
    }

    $college_name = get_option('fusion_college_name', 'Fusion College of Technology');
    $tagline = get_option('fusion_college_tagline', 'Empowering Future Leaders');
    $phone = get_option('fusion_college_phone', '1300 123 456');
    $email = get_option('fusion_college_email', 'info@fusioncollege.edu.au');
    $address = get_option('fusion_college_address', 'Sydney, Australia');
    $rto = get_option('fusion_college_rto', '45123');
    $cricos = get_option('fusion_college_cricos', '03456J');
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1>College Settings</h1>
        
        <form method="post" class="fusion-form">
            <div class="fusion-form-section">
                <h3>General Information</h3>
                <table class="fusion-form-table">
                    <tr>
                        <th><label>College Name</label></th>
                        <td><input type="text" name="college_name" value="<?php echo esc_attr($college_name); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Tagline</label></th>
                        <td><input type="text" name="tagline" value="<?php echo esc_attr($tagline); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Phone</label></th>
                        <td><input type="text" name="phone" value="<?php echo esc_attr($phone); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Email</label></th>
                        <td><input type="email" name="email" value="<?php echo esc_attr($email); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Address</label></th>
                        <td><textarea name="address" rows="3" class="large-text"><?php echo esc_textarea($address); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label>RTO Number</label></th>
                        <td><input type="text" name="rto" value="<?php echo esc_attr($rto); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>CRICOS Code</label></th>
                        <td><input type="text" name="cricos" value="<?php echo esc_attr($cricos); ?>" class="regular-text"></td>
                    </tr>
                </table>
            </div>
            
            <p class="submit"><button type="submit" name="save_settings" class="button button-primary">Save Settings</button></p>
        </form>
    </div>
    <?php
}

// Banners Admin Page
function fusion_banners_admin_page()
{
    if (isset($_POST['save_banner'])) {
        $title = sanitize_text_field($_POST['title']);
        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_type' => 'banner',
            'post_status' => 'publish',
        ]);
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_banner_subtitle', sanitize_text_field($_POST['subtitle']));
            update_post_meta($post_id, '_banner_button_text', sanitize_text_field($_POST['button_text']));
            update_post_meta($post_id, '_banner_button_url', sanitize_text_field($_POST['button_url']));
            update_post_meta($post_id, '_banner_order', intval($_POST['order']));
            
            if (!empty($_FILES['banner_image']['name'])) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                
                $attachment_id = media_handle_upload('banner_image', 0);
                if (!is_wp_error($attachment_id)) {
                    set_post_thumbnail($post_id, $attachment_id);
                }
            }
            
            echo '<div class="notice notice-success"><p>Banner saved!</p></div>';
        }
    }

    $banners = get_posts([
        'post_type' => 'banner',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ]);
    ?>
    <div class="wrap fusion-admin-wrap">
        <div class="fusion-header-row">
            <h1>Hero Banners</h1>
        </div>

        <div class="fusion-form-section">
            <h3>Add New Banner</h3>
            <form method="post" enctype="multipart/form-data" class="fusion-form">
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Title *</label></th>
                        <td><input type="text" name="title" required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Subtitle</label></th>
                        <td><input type="text" name="subtitle" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Button Text</label></th>
                        <td><input type="text" name="button_text" placeholder="e.g., Explore Courses" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Button URL</label></th>
                        <td><input type="text" name="button_url" placeholder="/courses" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Image</label></th>
                        <td><input type="file" name="banner_image" accept="image/*"></td>
                    </tr>
                    <tr>
                        <th><label>Display Order</label></th>
                        <td><input type="number" name="order" value="0" class="small-text"></td>
                    </tr>
                </table>
                <p class="submit"><button type="submit" name="save_banner" class="button button-primary">Add Banner</button></p>
            </form>
        </div>

        <h2>Existing Banners</h2>
        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Order</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($banners): foreach ($banners as $banner): 
                    $subtitle = get_post_meta($banner->ID, '_banner_subtitle', true);
                    $order = get_post_meta($banner->ID, '_banner_order', true);
                ?>
                <tr>
                    <td><?php echo $banner->ID; ?></td>
                    <td><strong><?php echo esc_html($banner->post_title); ?></strong></td>
                    <td><?php echo esc_html($subtitle ?: '-'); ?></td>
                    <td><?php echo esc_html($order ?: 0); ?></td>
                    <td><?php if (has_post_thumbnail($banner->ID)): ?>
                        <img src="<?php echo get_the_post_thumbnail_url($banner->ID, 'thumbnail'); ?>" style="width: 60px; height: 40px; object-fit: cover;">
                        <?php else: echo '-'; endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo get_edit_post_link($banner->ID); ?>" class="button button-small">Edit</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6">No banners yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Announcements Admin Page
function fusion_announcements_admin_page()
{
    if (isset($_POST['save_announcement'])) {
        $title = sanitize_text_field($_POST['title']);
        $content = wp_kses_post($_POST['content']);
        
        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_content' => $content,
            'post_type' => 'announcement',
            'post_status' => 'publish',
        ]);
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_announcement_date', sanitize_text_field($_POST['announcement_date']));
            update_post_meta($post_id, '_announcement_priority', sanitize_text_field($_POST['priority']));
            echo '<div class="notice notice-success"><p>Announcement saved!</p></div>';
        }
    }

    $announcements = get_posts([
        'post_type' => 'announcement',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1>Announcements</h1>

        <div class="fusion-form-section">
            <h3>Add New Announcement</h3>
            <form method="post" class="fusion-form">
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Title *</label></th>
                        <td><input type="text" name="title" required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Content</label></th>
                        <td><textarea name="content" rows="5" class="large-text"></textarea></td>
                    </tr>
                    <tr>
                        <th><label>Date</label></th>
                        <td><input type="date" name="announcement_date" value="<?php echo date('Y-m-d'); ?>"></td>
                    </tr>
                    <tr>
                        <th><label>Priority</label></th>
                        <td>
                            <select name="priority">
                                <option value="normal">Normal</option>
                                <option value="high">High</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <p class="submit"><button type="submit" name="save_announcement" class="button button-primary">Add Announcement</button></p>
            </form>
        </div>

        <h2>Existing Announcements</h2>
        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Priority</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($announcements): foreach ($announcements as $a): 
                    $ann_date = get_post_meta($a->ID, '_announcement_date', true);
                    $priority = get_post_meta($a->ID, '_announcement_priority', true);
                ?>
                <tr>
                    <td><?php echo $a->ID; ?></td>
                    <td><strong><?php echo esc_html($a->post_title); ?></strong></td>
                    <td><?php echo $ann_date ? date('M d, Y', strtotime($ann_date)) : get_the_date('M d, Y', $a->ID); ?></td>
                    <td><span class="badge badge-<?php echo $priority ?: 'normal'; ?>"><?php echo ucfirst($priority ?: 'normal'); ?></span></td>
                    <td><a href="<?php echo get_edit_post_link($a->ID); ?>" class="button button-small">Edit</a></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="5">No announcements yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <style>
        .badge { padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 600; }
        .badge-normal { background: #e0e7ff; color: #3730a3; }
        .badge-high { background: #fef3c7; color: #92400e; }
        .badge-urgent { background: #fee2e2; color: #991b1b; }
        </style>
    </div>
    <?php
}

// Gallery Admin Page
function fusion_gallery_admin_page()
{
    if (isset($_POST['save_gallery'])) {
        $title = sanitize_text_field($_POST['title']);
        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_type' => 'gallery',
            'post_status' => 'publish',
        ]);
        
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_gallery_category', sanitize_text_field($_POST['category']));
            
            if (!empty($_FILES['gallery_image']['name'])) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/media.php');
                
                $attachment_id = media_handle_upload('gallery_image', 0);
                if (!is_wp_error($attachment_id)) {
                    set_post_thumbnail($post_id, $attachment_id);
                }
            }
            
            echo '<div class="notice notice-success"><p>Gallery item saved!</p></div>';
        }
    }

    $gallery = get_posts([
        'post_type' => 'gallery',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ]);
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1>Gallery</h1>

        <div class="fusion-form-section">
            <h3>Add Gallery Image</h3>
            <form method="post" enctype="multipart/form-data" class="fusion-form">
                <table class="fusion-form-table">
                    <tr>
                        <th><label>Title *</label></th>
                        <td><input type="text" name="title" required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Category</label></th>
                        <td><input type="text" name="category" placeholder="e.g., Campus, Events" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label>Image *</label></th>
                        <td><input type="file" name="gallery_image" accept="image/*" required></td>
                    </tr>
                </table>
                <p class="submit"><button type="submit" name="save_gallery" class="button button-primary">Add to Gallery</button></p>
            </form>
        </div>

        <h2>Gallery Images</h2>
        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($gallery): foreach ($gallery as $g): 
                    $category = get_post_meta($g->ID, '_gallery_category', true);
                ?>
                <tr>
                    <td><?php echo $g->ID; ?></td>
                    <td><?php if (has_post_thumbnail($g->ID)): ?>
                        <img src="<?php echo get_the_post_thumbnail_url($g->ID, 'thumbnail'); ?>" style="width: 60px; height: 40px; object-fit: cover;">
                        <?php else: echo '-'; endif; ?>
                    </td>
                    <td><strong><?php echo esc_html($g->post_title); ?></strong></td>
                    <td><?php echo esc_html($category ?: '-'); ?></td>
                    <td><a href="<?php echo get_edit_post_link($g->ID); ?>" class="button button-small">Edit</a></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="5">No gallery images yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Contact Messages Admin Page
function fusion_contacts_admin_page()
{
    $messages = get_posts([
        'post_type' => 'contact_message',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    ]);

    // Delete message
    if (isset($_GET['delete']) && current_user_can('manage_options')) {
        wp_delete_post(intval($_GET['delete']), true);
        echo '<div class="notice notice-success"><p>Message deleted!</p></div>';
    }
    ?>
    <div class="wrap fusion-admin-wrap">
        <h1>Contact Messages</h1>

        <table class="fusion-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($messages): foreach ($messages as $msg): 
                    $name = get_post_meta($msg->ID, '_contact_name', true);
                    $email = get_post_meta($msg->ID, '_contact_email', true);
                    $phone = get_post_meta($msg->ID, '_contact_phone', true);
                    $subject = get_post_meta($msg->ID, '_contact_subject', true);
                ?>
                <tr>
                    <td><?php echo $msg->ID; ?></td>
                    <td><strong><?php echo esc_html($name); ?></strong></td>
                    <td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></td>
                    <td><?php echo esc_html($phone ?: '-'); ?></td>
                    <td><?php echo esc_html($subject); ?></td>
                    <td><?php echo get_the_date('M d, Y', $msg->ID); ?></td>
                    <td>
                        <a href="#" class="button button-small" onclick="alert('Message:\n<?php echo esc_html($msg->post_content); ?>\n\nFrom: <?php echo esc_html($name); ?>\nEmail: <?php echo esc_html($email); ?>'); return false;">View</a>
                        <a href="?page=fusion-contacts&delete=<?php echo $msg->ID; ?>" class="button button-small" onclick="return confirm('Delete this message?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="7">No messages yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Ensure Elementor pages have header/footer
function fusion_force_header_footer_on_elementor()
{
    if (class_exists('Elementor\Plugin')) {
        add_filter('elementor/theme/should_include_theme_styles', '__return_false');
    }
}
add_action('init', 'fusion_force_header_footer_on_elementor');