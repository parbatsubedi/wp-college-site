<?php
/**
 * ACF Field Groups Configuration
 * This file registers ACF field groups programmatically.
 * If ACF is installed, these will be available immediately.
 * You can also use the ACF UI to modify these fields.
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register ACF field groups when ACF is active
function fusion_college_acf_field_groups() {
    // Check if ACF is active
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // ========================================
    // HOME PAGE - FLEXIBLE CONTENT
    // ========================================
    acf_add_local_field_group(array(
        'key' => 'group_home_page_sections',
        'title' => 'Home Page Sections',
        'fields' => array(
            array(
                'key' => 'field_home_page_sections',
                'label' => 'Page Sections',
                'name' => 'home_page_sections',
                'type' => 'flexible_content',
                'instructions' => 'Add, remove, and reorder sections to build your home page.',
                'button_label' => 'Add Section',
                'layouts' => array(
                    // Hero Section
                    'layout_hero' => array(
                        'key' => 'layout_hero',
                        'name' => 'hero_section',
                        'label' => 'Hero Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_hero_badge',
                                'label' => 'Badge Text',
                                'name' => 'hero_badge',
                                'type' => 'text',
                                'default_value' => 'Welcome to Fusion College',
                            ),
                            array(
                                'key' => 'field_hero_title',
                                'label' => 'Title',
                                'name' => 'hero_title',
                                'type' => 'text',
                                'default_value' => 'Empowering Future Professionals',
                            ),
                            array(
                                'key' => 'field_hero_subtitle',
                                'label' => 'Subtitle',
                                'name' => 'hero_subtitle',
                                'type' => 'textarea',
                            ),
                            array(
                                'key' => 'field_hero_button_1_text',
                                'label' => 'Button 1 Text',
                                'name' => 'hero_button_1_text',
                                'type' => 'text',
                                'default_value' => 'Explore Courses',
                            ),
                            array(
                                'key' => 'field_hero_button_1_url',
                                'label' => 'Button 1 URL',
                                'name' => 'hero_button_1_url',
                                'type' => 'url',
                            ),
                            array(
                                'key' => 'field_hero_button_2_text',
                                'label' => 'Button 2 Text',
                                'name' => 'hero_button_2_text',
                                'type' => 'text',
                                'default_value' => 'Enquire Now',
                            ),
                            array(
                                'key' => 'field_hero_button_2_url',
                                'label' => 'Button 2 URL',
                                'name' => 'hero_button_2_url',
                                'type' => 'url',
                            ),
                        ),
                    ),
                    // Stats Section
                    'layout_stats' => array(
                        'key' => 'layout_stats',
                        'name' => 'stats_section',
                        'label' => 'Stats Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_stat_1_icon',
                                'label' => 'Stat 1 Icon (Emoji)',
                                'name' => 'stat_1_icon',
                                'type' => 'text',
                                'default_value' => '🎓',
                            ),
                            array(
                                'key' => 'field_stat_1_number',
                                'label' => 'Stat 1 Number',
                                'name' => 'stat_1_number',
                                'type' => 'number',
                                'default_value' => 5000,
                            ),
                            array(
                                'key' => 'field_stat_1_label',
                                'label' => 'Stat 1 Label',
                                'name' => 'stat_1_label',
                                'type' => 'text',
                                'default_value' => 'Students Enrolled',
                            ),
                            array(
                                'key' => 'field_stat_2_icon',
                                'label' => 'Stat 2 Icon (Emoji)',
                                'name' => 'stat_2_icon',
                                'type' => 'text',
                                'default_value' => '🏆',
                            ),
                            array(
                                'key' => 'field_stat_2_number',
                                'label' => 'Stat 2 Number',
                                'name' => 'stat_2_number',
                                'type' => 'number',
                                'default_value' => 95,
                            ),
                            array(
                                'key' => 'field_stat_2_label',
                                'label' => 'Stat 2 Label',
                                'name' => 'stat_2_label',
                                'type' => 'text',
                                'default_value' => '% Employment Rate',
                            ),
                            array(
                                'key' => 'field_stat_3_icon',
                                'label' => 'Stat 3 Icon (Emoji)',
                                'name' => 'stat_3_icon',
                                'type' => 'text',
                                'default_value' => '👨‍🏫',
                            ),
                            array(
                                'key' => 'field_stat_3_number',
                                'label' => 'Stat 3 Number',
                                'name' => 'stat_3_number',
                                'type' => 'number',
                                'default_value' => 150,
                            ),
                            array(
                                'key' => 'field_stat_3_label',
                                'label' => 'Stat 3 Label',
                                'name' => 'stat_3_label',
                                'type' => 'text',
                                'default_value' => 'Industry Trainers',
                            ),
                            array(
                                'key' => 'field_stat_4_icon',
                                'label' => 'Stat 4 Icon (Emoji)',
                                'name' => 'stat_4_icon',
                                'type' => 'text',
                                'default_value' => '🌍',
                            ),
                            array(
                                'key' => 'field_stat_4_number',
                                'label' => 'Stat 4 Number',
                                'name' => 'stat_4_number',
                                'type' => 'number',
                                'default_value' => 50,
                            ),
                            array(
                                'key' => 'field_stat_4_label',
                                'label' => 'Stat 4 Label',
                                'name' => 'stat_4_label',
                                'type' => 'text',
                                'default_value' => 'Countries Represented',
                            ),
                        ),
                    ),
                    // About Section
                    'layout_about' => array(
                        'key' => 'layout_about',
                        'name' => 'about_section',
                        'label' => 'About Section',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_about_title',
                                'label' => 'Title',
                                'name' => 'about_title',
                                'type' => 'text',
                                'default_value' => 'About Our College',
                            ),
                            array(
                                'key' => 'field_about_content',
                                'label' => 'Content',
                                'name' => 'about_content',
                                'type' => 'wysiwyg',
                            ),
                            array(
                                'key' => 'field_about_features',
                                'label' => 'Features',
                                'name' => 'about_features',
                                'type' => 'repeater',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_feature_icon',
                                        'label' => 'Icon (Emoji)',
                                        'name' => 'feature_icon',
                                        'type' => 'text',
                                        'default_value' => '✓',
                                    ),
                                    array(
                                        'key' => 'field_feature_text',
                                        'label' => 'Feature Text',
                                        'name' => 'feature_text',
                                        'type' => 'text',
                                    ),
                                ),
                            ),
                            array(
                                'key' => 'field_about_button_text',
                                'label' => 'Button Text',
                                'name' => 'about_button_text',
                                'type' => 'text',
                                'default_value' => 'Learn More',
                            ),
                            array(
                                'key' => 'field_about_button_url',
                                'label' => 'Button URL',
                                'name' => 'about_button_url',
                                'type' => 'url',
                            ),
                        ),
                    ),
                    // Featured Courses
                    'layout_courses' => array(
                        'key' => 'layout_courses',
                        'name' => 'courses_section',
                        'label' => 'Featured Courses',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_courses_section_title',
                                'label' => 'Section Title',
                                'name' => 'courses_section_title',
                                'type' => 'text',
                                'default_value' => 'Popular Programs',
                            ),
                            array(
                                'key' => 'field_courses_section_subtitle',
                                'label' => 'Section Subtitle',
                                'name' => 'courses_section_subtitle',
                                'type' => 'textarea',
                            ),
                            array(
                                'key' => 'field_courses_count',
                                'label' => 'Number of Courses to Show',
                                'name' => 'courses_count',
                                'type' => 'number',
                                'default_value' => 3,
                                'min' => 1,
                                'max' => 12,
                            ),
                            array(
                                'key' => 'field_courses_category',
                                'label' => 'Filter by Category (optional)',
                                'name' => 'courses_category',
                                'type' => 'taxonomy',
                                'taxonomy' => 'course_category',
                                'field_type' => 'select',
                                'allow_null' => 1,
                            ),
                        ),
                    ),
                    // Why Choose Us
                    'layout_why_choose_us' => array(
                        'key' => 'layout_why_choose_us',
                        'name' => 'why_choose_us_section',
                        'label' => 'Why Choose Us',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_why_title',
                                'label' => 'Title',
                                'name' => 'why_title',
                                'type' => 'text',
                                'default_value' => 'The College Advantage',
                            ),
                            array(
                                'key' => 'field_why_items',
                                'label' => 'Why Choose Us Items',
                                'name' => 'why_items',
                                'type' => 'repeater',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_why_item_icon',
                                        'label' => 'Icon (Emoji)',
                                        'name' => 'why_item_icon',
                                        'type' => 'text',
                                        'default_value' => '🎯',
                                    ),
                                    array(
                                        'key' => 'field_why_item_title',
                                        'label' => 'Title',
                                        'name' => 'why_item_title',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_why_item_description',
                                        'label' => 'Description',
                                        'name' => 'why_item_description',
                                        'type' => 'textarea',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    // Events
                    'layout_events' => array(
                        'key' => 'layout_events',
                        'name' => 'events_section',
                        'label' => 'Upcoming Events',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_events_section_title',
                                'label' => 'Section Title',
                                'name' => 'events_section_title',
                                'type' => 'text',
                                'default_value' => 'Upcoming Events',
                            ),
                            array(
                                'key' => 'field_events_count',
                                'label' => 'Number of Events',
                                'name' => 'events_count',
                                'type' => 'number',
                                'default_value' => 3,
                            ),
                        ),
                    ),
                    // Testimonials
                    'layout_testimonials' => array(
                        'key' => 'layout_testimonials',
                        'name' => 'testimonials_section',
                        'label' => 'Testimonials',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_testimonials_title',
                                'label' => 'Section Title',
                                'name' => 'testimonials_title',
                                'type' => 'text',
                                'default_value' => 'What Our Students Say',
                            ),
                            array(
                                'key' => 'field_testimonials',
                                'label' => 'Testimonials',
                                'name' => 'testimonials',
                                'type' => 'repeater',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_testimonial_quote',
                                        'label' => 'Quote',
                                        'name' => 'testimonial_quote',
                                        'type' => 'textarea',
                                    ),
                                    array(
                                        'key' => 'field_testimonial_name',
                                        'label' => 'Name',
                                        'name' => 'testimonial_name',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_testimonial_role',
                                        'label' => 'Role/Title',
                                        'name' => 'testimonial_role',
                                        'type' => 'text',
                                    ),
                                    array(
                                        'key' => 'field_testimonial_image',
                                        'label' => 'Avatar Image',
                                        'name' => 'testimonial_image',
                                        'type' => 'image',
                                        'return_format' => 'url',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    // CTA Section
                    'layout_cta' => array(
                        'key' => 'layout_cta',
                        'name' => 'cta_section',
                        'label' => 'Call to Action',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_cta_title',
                                'label' => 'Title',
                                'name' => 'cta_title',
                                'type' => 'text',
                                'default_value' => 'Ready to Start Your Journey?',
                            ),
                            array(
                                'key' => 'field_cta_subtitle',
                                'label' => 'Subtitle',
                                'name' => 'cta_subtitle',
                                'type' => 'textarea',
                            ),
                            array(
                                'key' => 'field_cta_button_1_text',
                                'label' => 'Button 1 Text',
                                'name' => 'cta_button_1_text',
                                'type' => 'text',
                                'default_value' => 'Apply Now',
                            ),
                            array(
                                'key' => 'field_cta_button_1_url',
                                'label' => 'Button 1 URL',
                                'name' => 'cta_button_1_url',
                                'type' => 'url',
                            ),
                            array(
                                'key' => 'field_cta_button_2_text',
                                'label' => 'Button 2 Text',
                                'name' => 'cta_button_2_text',
                                'type' => 'text',
                                'default_value' => 'Contact Us',
                            ),
                            array(
                                'key' => 'field_cta_button_2_url',
                                'label' => 'Button 2 URL',
                                'name' => 'cta_button_2_url',
                                'type' => 'url',
                            ),
                        ),
                    ),
                    // Custom Content Block
                    'layout_content' => array(
                        'key' => 'layout_content',
                        'name' => 'custom_content',
                        'label' => 'Custom Content',
                        'display' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_content_block_title',
                                'label' => 'Title',
                                'name' => 'content_block_title',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_content_block',
                                'label' => 'Content',
                                'name' => 'content_block',
                                'type' => 'wysiwyg',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'front-page.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Flexible content sections for the home page.',
    ));

    // ========================================
    // COURSE EXTRA FIELDS
    // ========================================
    acf_add_local_field_group(array(
        'key' => 'group_course_extra',
        'title' => 'Course Additional Information',
        'fields' => array(
            array(
                'key' => 'field_course_curriculum',
                'label' => 'Curriculum',
                'name' => 'course_curriculum',
                'type' => 'wysiwyg',
                'instructions' => 'Detailed curriculum and course content.',
            ),
            array(
                'key' => 'field_course_career_outcomes',
                'label' => 'Career Outcomes',
                'name' => 'course_career_outcomes',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_career_outcome',
                        'label' => 'Career Outcome',
                        'name' => 'career_outcome',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_course_entry_requirements',
                'label' => 'Entry Requirements',
                'name' => 'course_entry_requirements',
                'type' => 'wysiwyg',
            ),
            array(
                'key' => 'field_course_how_to_apply',
                'label' => 'How to Apply',
                'name' => 'course_how_to_apply',
                'type' => 'wysiwyg',
            ),
            array(
                'key' => 'field_course_international_requirements',
                'label' => 'International Student Requirements',
                'name' => 'course_international_requirements',
                'type' => 'wysiwyg',
            ),
            array(
                'key' => 'field_course_fees_payment',
                'label' => 'Fees & Payment Info',
                'name' => 'course_fees_payment',
                'type' => 'wysiwyg',
            ),
            array(
                'key' => 'field_course_policies_forms',
                'label' => 'Policies & Forms',
                'name' => 'course_policies_forms',
                'type' => 'wysiwyg',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'course',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));

    // ========================================
    // EVENT EXTRA FIELDS
    // ========================================
    acf_add_local_field_group(array(
        'key' => 'group_event_extra',
        'title' => 'Event Additional Information',
        'fields' => array(
            array(
                'key' => 'field_event_organizer',
                'label' => 'Organizer',
                'name' => 'event_organizer',
                'type' => 'text',
            ),
            array(
                'key' => 'field_event_registration_url',
                'label' => 'Registration URL',
                'name' => 'event_registration_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_event_capacity',
                'label' => 'Capacity',
                'name' => 'event_capacity',
                'type' => 'number',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
}
add_action('acf/include_fields', 'fusion_college_acf_field_groups');
add_action('acf/init', 'fusion_college_acf_field_groups');
