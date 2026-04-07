<?php

/**
 * Elementor Compatibility
 * Makes the theme fully compatible with Elementor Page Builder
 */
if (! defined('ABSPATH')) {
    exit;
}

// Check if Elementor is installed
function fusion_college_elementor_is_active()
{
    return defined('ELEMENTOR_VERSION');
}

// Declare support for Elementor
function fusion_college_elementor_support()
{
    if (fusion_college_elementor_is_active()) {
        add_theme_support('elementor');

        // Disable default header/footer for Elementor templates
        add_theme_support('elementor-canvas');
    }
}
add_action('after_setup_theme', 'fusion_college_elementor_support');

// Elementor Location Rules
function fusion_college_elementor_theme_support()
{
    if (fusion_college_elementor_is_active()) {
        add_theme_support('elementor-hf');
    }
}
add_action('init', 'fusion_college_elementor_theme_support', 20);

// Elementor Preview
function fusion_college_elementor_preview_scripts()
{
    if (isset($_GET['elementor-preview'])) {
        wp_enqueue_style('fusion-elementor-preview', get_template_directory_uri().'/css/elementor-preview.css', [], '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'fusion_college_elementor_preview_scripts', 20);

// Elementor Canvas Template
function fusion_college_elementor_canvas_template($template)
{
    global $post;

    if (! is_singular()) {
        return $template;
    }

    if (has_shortcode($post->post_content, 'elementor-template')) {
        return get_template_directory().'/templates/elementor-canvas.php';
    }

    return $template;
}
add_filter('template_include', 'fusion_college_elementor_canvas_template');

// Register Elementor Locations
function fusion_college_elementor_locations($elementor_theme)
{
    $elementor_theme->register_location('header');
    $elementor_theme->register_location('footer');
    $elementor_theme->register_location('single');
    $elementor_theme->register_location('archive');
}
add_action('elementor/theme/register_locations', 'fusion_college_elementor_locations');

// Elementor Widgets
function fusion_college_register_elementor_widgets($widgets_manager)
{
    if (fusion_college_elementor_is_active()) {
        require_once get_template_directory().'/inc/elementor-widgets.php';
    }
}
add_action('elementor/widgets/register', 'fusion_college_register_elementor_widgets');

// Elementor Content Width
function fusion_college_elementor_content_width()
{
    add_theme_support('elementor-content-width', 1200);
}
add_action('after_setup_theme', 'fusion_college_elementor_content_width');

// Elementor Responsive
function fusion_college_elementor_responsive()
{
    add_theme_support('elementor-default-variation');
}
add_action('after_setup_theme', 'fusion_college_elementor_responsive');

// Hide Default Template Parts when using Elementor
function fusion_college_hide_default_header_footer($settings)
{
    if (isset($settings['elementor_hf']) && $settings['elementor_hf']) {
        remove_action('fusion_header', 'fusion_do_header');
        remove_action('fusion_footer', 'fusion_do_footer');
    }

    return $settings;
}

// Elementor Template Shortcode
function fusion_elementor_template_shortcode($atts)
{
    $atts = shortcode_atts([
        'id' => 0,
    ], $atts);

    if (empty($atts['id'])) {
        return '';
    }

    return \Elementor\Plugin::$instance->frontend->get_builder_content($atts['id'], true);
}
add_shortcode('elementor-template', 'fusion_elementor_template_shortcode');

// Disable Google Fonts in Elementor
function fusion_disable_elementor_google_fonts($load_default_fonts)
{
    return false;
}
add_filter('elementor/frontend/print_google_fonts', 'fusion_disable_elementor_google_fonts');

// Custom CSS for Elementor
function fusion_elementor_inline_styles()
{
    if (fusion_college_elementor_is_active()) {
        echo '<style>
            .elementor-section-wrap {
                width: 100%;
            }
            .elementor-container {
                max-width: 1200px;
            }
        </style>';
    }
}
add_action('wp_head', 'fusion_elementor_inline_styles', 100);

// Elementor Pro Support
function fusion_college_elementor_pro_support()
{
    if (defined('ELEMENTOR_PRO_VERSION')) {
        add_theme_support('elementor-pro');
    }
}
add_action('init', 'fusion_college_elementor_pro_support', 30);
