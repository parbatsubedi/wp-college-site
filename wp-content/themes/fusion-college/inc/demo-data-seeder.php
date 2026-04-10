<?php
/**
 * Demo Data Seeder
 * Run this once to populate demo content for the college site.
 * Access via: wp-admin/tools.php?page=fusion-college-demo-data
 * Or run via WP-CLI: wp eval-file wp-content/themes/fusion-college/inc/demo-data-seeder.php
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu for demo data
function fusion_college_add_demo_menu() {
    add_management_page(
        'Fusion College Demo Data',
        'Fusion College Demo Data',
        'manage_options',
        'fusion-college-demo-data',
        'fusion_college_demo_data_page'
    );
}
add_action('admin_menu', 'fusion_college_add_demo_menu');

function fusion_college_demo_data_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['import_demo_data']) && wp_verify_nonce($_POST['fusion_college_demo_nonce'], 'fusion_college_import_demo')) {
        fusion_college_import_demo_data();
        echo '<div class="notice notice-success"><p>Demo data has been imported successfully!</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Fusion College Demo Data Importer</h1>
        <p>This will create demo courses, events, and pages for testing the theme.</p>
        <form method="post">
            <?php wp_nonce_field('fusion_college_import_demo', 'fusion_college_demo_nonce'); ?>
            <input type="submit" name="import_demo_data" class="button button-primary" value="Import Demo Data">
        </form>
    </div>
    <?php
}

function fusion_college_import_demo_data() {
    // Create demo pages
    $pages = array(
        array(
            'post_title'   => 'Admissions',
            'post_name'    => 'admissions',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Admissions page - select a course to view details.',
        ),
        array(
            'post_title'   => 'Contact',
            'post_name'    => 'contact',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Contact us page with form.',
        ),
        array(
            'post_title'   => 'Courses',
            'post_name'    => 'courses',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Browse our courses.',
        ),
        array(
            'post_title'   => 'Events',
            'post_name'    => 'events',
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => 'Upcoming events and activities.',
        ),
    );

    foreach ($pages as $page) {
        if (!get_page_by_path($page['post_name'])) {
            wp_insert_post($page);
        }
    }

    // Set front page
    $front_page = get_page_by_path('admissions'); // fallback
    $home_page = get_page_by_title('Home'); // may not exist

    // Create demo courses
    $courses = array(
        array(
            'post_title'   => 'Diploma of Information Technology',
            'post_name'    => 'diploma-information-technology',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<p>The Diploma of Information Technology provides you with the skills and knowledge required to work in the IT industry. This course covers a wide range of IT specialties including networking, web development, database administration, and cybersecurity.</p><h3>Course Overview</h3><p>This nationally recognized qualification is designed for individuals who want to develop their skills in information technology. You will learn to design, develop, test, and maintain software applications, as well as manage IT systems and networks.</p>',
            'post_excerpt' => 'Develop essential IT skills for the modern workplace with hands-on training.',
        ),
        array(
            'post_title'   => 'Diploma of Business',
            'post_name'    => 'diploma-business',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<p>The Diploma of Business provides a foundation in business management, marketing, and leadership skills. This course prepares students for roles in management, administration, and business development.</p><h3>Course Overview</h3><p>Gain practical business skills that are relevant across all industries. Learn about management principles, marketing strategies, financial management, and human resources.</p>',
            'post_excerpt' => 'Master business fundamentals and develop leadership skills for career success.',
        ),
        array(
            'post_title'   => 'Advanced Diploma of Leadership and Management',
            'post_name'    => 'advanced-diploma-leadership-management',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<p>The Advanced Diploma of Leadership and Management is designed for experienced managers who want to enhance their leadership capabilities. This course covers strategic planning, organizational management, and innovation.</p><h3>Course Overview</h3><p>Take your management skills to the next level. Learn how to lead teams, develop strategic plans, manage organizational change, and drive innovation in your workplace.</p>',
            'post_excerpt' => 'Develop advanced leadership skills to drive organizational success.',
        ),
        array(
            'post_title'   => 'Certificate IV in Cyber Security',
            'post_name'    => 'certificate-iv-cyber-security',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<p>The Certificate IV in Cyber Security equips you with the skills to protect organizations from cyber threats. Learn about network security, ethical hacking, incident response, and security governance.</p><h3>Course Overview</h3><p>Enter the fast-growing field of cybersecurity. This course covers fundamental and advanced topics including threat analysis, vulnerability assessment, security architecture, and compliance frameworks.</p>',
            'post_excerpt' => 'Learn to protect organizations from cyber threats with hands-on security training.',
        ),
        array(
            'post_title'   => 'Diploma of Early Childhood Education and Care',
            'post_name'    => 'diploma-early-childhood-education',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<p>The Diploma of Early Childhood Education and Care prepares educators to work with children aged 0-12 years. This course covers child development, curriculum planning, health and safety, and family engagement.</p><h3>Course Overview</h3><p>Make a difference in children\'s lives. Learn how to create nurturing learning environments, implement educational programs, and support children\'s physical, emotional, and cognitive development.</p>',
            'post_excerpt' => 'Prepare for a rewarding career in early childhood education and care.',
        ),
        array(
            'post_title'   => 'ELICOS - English Language Program',
            'post_name'    => 'elicos-english-language',
            'post_type'    => 'course',
            'post_status'  => 'publish',
            'post_content' => '<p>The English Language Intensive Courses for Overseas Students (ELICOS) program helps international students improve their English proficiency. Courses range from beginner to advanced levels.</p><h3>Course Overview</h3><p>Develop your English language skills in a supportive learning environment. Improve your reading, writing, listening, and speaking abilities while preparing for further study or career opportunities.</p>',
            'post_excerpt' => 'Improve your English proficiency with our intensive language program.',
        ),
    );

    foreach ($courses as $course) {
        $existing = get_page_by_path($course['post_name'], OBJECT, 'course');
        if (!$existing) {
            $course_id = wp_insert_post($course);

            // Add course meta
            switch ($course['post_name']) {
                case 'diploma-information-technology':
                    update_post_meta($course_id, '_course_duration', '52');
                    update_post_meta($course_id, '_course_fee', '8500');
                    update_post_meta($course_id, '_course_cricos_code', '03456A');
                    update_post_meta($course_id, '_course_study_mode', 'Full-time');
                    update_post_meta($course_id, '_course_intake_months', 'January, March, June, September');
                    update_post_meta($course_id, '_course_location', 'Sydney');
                    break;
                case 'diploma-business':
                    update_post_meta($course_id, '_course_duration', '48');
                    update_post_meta($course_id, '_course_fee', '7800');
                    update_post_meta($course_id, '_course_study_mode', 'Full-time / Part-time');
                    update_post_meta($course_id, '_course_intake_months', 'January, April, July, October');
                    update_post_meta($course_id, '_course_location', 'Sydney, Melbourne');
                    break;
                case 'advanced-diploma-leadership-management':
                    update_post_meta($course_id, '_course_duration', '36');
                    update_post_meta($course_id, '_course_fee', '6500');
                    update_post_meta($course_id, '_course_study_mode', 'Full-time');
                    update_post_meta($course_id, '_course_intake_months', 'February, May, August, November');
                    update_post_meta($course_id, '_course_location', 'Sydney');
                    break;
                case 'certificate-iv-cyber-security':
                    update_post_meta($course_id, '_course_duration', '26');
                    update_post_meta($course_id, '_course_fee', '5200');
                    update_post_meta($course_id, '_course_study_mode', 'Full-time');
                    update_post_meta($course_id, '_course_intake_months', 'January, July');
                    update_post_meta($course_id, '_course_location', 'Sydney');
                    break;
                case 'diploma-early-childhood-education':
                    update_post_meta($course_id, '_course_duration', '52');
                    update_post_meta($course_id, '_course_fee', '7200');
                    update_post_meta($course_id, '_course_study_mode', 'Full-time / Part-time');
                    update_post_meta($course_id, '_course_intake_months', 'January, March, June, September');
                    update_post_meta($course_id, '_course_location', 'Sydney, Melbourne');
                    break;
                case 'elicos-english-language':
                    update_post_meta($course_id, '_course_duration', '48');
                    update_post_meta($course_id, '_course_fee', '9600');
                    update_post_meta($course_id, '_course_cricos_code', '03456B');
                    update_post_meta($course_id, '_course_study_mode', 'Full-time');
                    update_post_meta($course_id, '_course_intake_months', 'Monthly intake');
                    update_post_meta($course_id, '_course_location', 'Sydney');
                    break;
            }
        }
    }

    // Create course categories
    $categories = array(
        array('name' => 'Information Technology', 'slug' => 'it'),
        array('name' => 'Business', 'slug' => 'business'),
        array('name' => 'Leadership', 'slug' => 'leadership'),
        array('name' => 'Cybersecurity', 'slug' => 'cybersecurity'),
        array('name' => 'Community Services', 'slug' => 'community'),
        array('name' => 'English (ELICOS)', 'slug' => 'english'),
    );

    foreach ($categories as $cat) {
        if (!term_exists($cat['slug'], 'course_category')) {
            wp_insert_term($cat['name'], 'course_category', array('slug' => $cat['slug']));
        }
    }

    // Assign categories to courses
    $course_cat_map = array(
        'diploma-information-technology' => 'it',
        'diploma-business' => 'business',
        'advanced-diploma-leadership-management' => 'leadership',
        'certificate-iv-cyber-security' => 'cybersecurity',
        'diploma-early-childhood-education' => 'community',
        'elicos-english-language' => 'english',
    );

    foreach ($course_cat_map as $course_slug => $cat_slug) {
        $course = get_page_by_path($course_slug, OBJECT, 'course');
        if ($course) {
            $term = term_exists($cat_slug, 'course_category');
            if ($term) {
                wp_set_object_terms($course->ID, (int)$term['term_id'], 'course_category');
            }
        }
    }

    // Create demo events
    $events = array(
        array(
            'post_title'   => 'Open Day 2026',
            'post_name'    => 'open-day-2026',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Join us for our annual Open Day! Tour our campus, meet trainers, and learn about our courses.',
            'post_excerpt' => 'Explore our campus and discover your future.',
        ),
        array(
            'post_title'   => 'Industry Networking Night',
            'post_name'    => 'industry-networking-night',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Connect with industry professionals and fellow students at our networking event.',
            'post_excerpt' => 'Build your professional network.',
        ),
        array(
            'post_title'   => 'Graduation Ceremony - June 2026',
            'post_name'    => 'graduation-ceremony-june-2026',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Celebrate your achievements at our graduation ceremony.',
            'post_excerpt' => 'Celebrate your academic achievements.',
        ),
        array(
            'post_title'   => 'Cyber Security Workshop',
            'post_name'    => 'cyber-security-workshop',
            'post_type'    => 'event',
            'post_status'  => 'publish',
            'post_content' => 'Hands-on workshop covering the latest cybersecurity threats and defense strategies.',
            'post_excerpt' => 'Learn practical cybersecurity skills.',
        ),
    );

    // Create future events
    $future_dates = array(
        date('Y-m-d', strtotime('+30 days')),
        date('Y-m-d', strtotime('+45 days')),
        date('Y-m-d', strtotime('+60 days')),
        date('Y-m-d', strtotime('+90 days')),
    );

    foreach ($events as $index => $event) {
        $existing = get_page_by_path($event['post_name'], OBJECT, 'event');
        if (!$existing) {
            $event_id = wp_insert_post($event);
            update_post_meta($event_id, '_event_start_date', $future_dates[$index]);
            update_post_meta($event_id, '_event_end_date', $future_dates[$index]);
            update_post_meta($event_id, '_event_location', 'Sydney Campus');
        }
    }

    // Create event categories
    $event_categories = array(
        array('name' => 'Open Day', 'slug' => 'open-day'),
        array('name' => 'Networking', 'slug' => 'networking'),
        array('name' => 'Graduation', 'slug' => 'graduation'),
        array('name' => 'Workshop', 'slug' => 'workshop'),
    );

    foreach ($event_categories as $cat) {
        if (!term_exists($cat['slug'], 'event_category')) {
            wp_insert_term($cat['name'], 'event_category', array('slug' => $cat['slug']));
        }
    }

    // Flush rewrite rules
    flush_rewrite_rules();
}

// Auto-run on theme activation (optional)
function fusion_college_auto_import_demo() {
    // Check if demo data has already been imported
    if (!get_option('fusion_college_demo_imported')) {
        fusion_college_import_demo_data();
        update_option('fusion_college_demo_imported', true);
    }
}
// Uncomment the line below to auto-import on theme activation
// add_action('after_switch_theme', 'fusion_college_auto_import_demo');
