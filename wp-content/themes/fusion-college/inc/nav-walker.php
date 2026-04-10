<?php
/**
 * Custom Nav Walker for WordPress menus
 * Outputs menus in the Fusion College format with dropdowns
 */

if (!defined('ABSPATH')) {
    exit;
}

class Fusion_College_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $atts = array();
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['class'] = 'nav-link';

        // Add active class
        if (in_array('current-menu-item', $classes) || in_array('current-menu-parent', $classes)) {
            $atts['class'] .= ' active';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        // Check if item has children
        $item_output = '';
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth === 0 && $has_children) {
            $item_output .= '<li class="nav-item' . $class_names . '">';
            $item_output .= '<a' . $attributes . ' has-dropdown">' . $title . '</a>';

            // Check if it's a mega menu (Courses)
            if (strpos(strtolower($item->title), 'course') !== false) {
                $item_output .= '<div class="mega-menu">';
                $item_output .= '<div class="mega-menu-grid">';
                $item_output .= '<div class="mega-menu-column">';
                $item_output .= '<h4>Information Technology</h4>';
                $item_output .= '<ul><li><a href="' . esc_url(get_post_type_archive_link('course')) . '">View All IT Courses</a></li></ul>';
                $item_output .= '</div>';
                $item_output .= '<div class="mega-menu-column">';
                $item_output .= '<h4>Business & Management</h4>';
                $item_output .= '<ul><li><a href="' . esc_url(get_post_type_archive_link('course')) . '">View All Business Courses</a></li></ul>';
                $item_output .= '</div>';
                $item_output .= '<div class="mega-menu-column">';
                $item_output .= '<h4>All Courses</h4>';
                $item_output .= '<ul>';
                $item_output .= '<li><a href="' . esc_url(get_post_type_archive_link('course')) . '">Browse All Courses</a></li>';
                $item_output .= '<li><a href="' . esc_url(get_permalink(get_page_by_path('admissions'))) . '">How to Apply</a></li>';
                $item_output .= '</ul>';
                $item_output .= '</div>';
                $item_output .= '</div>';
                $item_output .= '</div>';
            } else {
                $item_output .= '<div class="dropdown-menu">';
                // We'll render children in start_lvl
            }
            $output .= $item_output;
        } elseif ($depth > 0) {
            // Child items
            $item_output .= '<a' . str_replace('nav-link', '', $attributes) . '>' . $title . '</a>';
            $output .= $item_output;
        } else {
            $item_output .= '<li class="nav-item' . $class_names . '">';
            $item_output .= '<a' . $attributes . '>' . $title . '</a>';
            $item_output .= '</li>';
            $output .= $item_output;
        }
    }

    public function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            // Check if parent is a mega menu
            $indent = str_repeat("\t", $depth);
            // We handle mega menu in start_el, so this is for regular dropdowns
            $output .= "\n" . $indent . '<div class="dropdown-menu">' . "\n";
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n" . $indent . '</div>' . "\n";
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $has_children = in_array('menu-item-has-children', $item->classes);
        if ($depth === 0 && $has_children) {
            $output .= '</li>';
        } elseif ($depth > 0) {
            // Close child link wrapper if any
        } else {
            // Already closed in start_el for non-children
        }
    }
}
