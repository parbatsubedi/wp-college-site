<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Header -->
    <header class="main-header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="nav-container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; gap: 25px; flex-wrap: wrap;">
                        <span>📞 <span><?php echo get_theme_mod('contact_phone', '1300 123 456'); ?></span></span>
                        <span>✉️ <span><?php echo get_theme_mod('contact_email', 'info@pacificinstitute.edu.au'); ?></span></span>
                        <span>📍 <?php echo get_theme_mod('contact_address', 'Level 5, 123 George Street, Sydney NSW 2000'); ?></span>
                    </div>
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <span>RTO: <?php echo get_option('college_rto_code', '45123'); ?></span>
                        <span>CRICOS: <?php echo get_option('college_cricos_code', '03456J'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <div class="nav-container nav-pill-wrapper">
            <nav class="main-nav">
                <a href="<?php echo home_url(); ?>" class="logo">
                    <?php if (has_custom_logo()) : ?>
                        <div class="logo-icon" style="background: transparent; padding: 0;">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <div class="logo-icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M15 2L3 9v12l12 7 12-7V9L15 2z" fill="white" fill-opacity="0.3" />
                                <path d="M15 5L6 10v10l9 5 9-5V10l-9-5z" fill="white" />
                                <circle cx="15" cy="15" r="4" fill="#077E86" />
                            </svg>
                        </div>
                    <?php endif; ?>
                    <div>
                        <div class="logo-text"><?php bloginfo('name'); ?></div>
                        <div class="logo-tagline">of Technology</div>
                    </div>
                </a>

                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?php echo home_url(); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo home_url(); ?>#about" class="nav-link has-dropdown">About Us</a>
                        <div class="dropdown-menu">
                            <a href="<?php echo home_url(); ?>#about">Our Story</a>
                            <a href="<?php echo home_url(); ?>#about">Mission & Vision</a>
                            <a href="<?php echo home_url(); ?>#about">Leadership</a>
                            <a href="<?php echo home_url(); ?>#about">Campus & Facilities</a>
                            <a href="<?php echo home_url(); ?>#about">Accreditations</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo get_post_type_archive_link('course'); ?>" class="nav-link <?php echo is_post_type_archive('course') || is_singular('course') ? 'active' : ''; ?> has-dropdown">Courses</a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <div class="mega-menu-column">
                                    <h4>Information Technology</h4>
                                    <ul>
                                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">View All IT Courses</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-column">
                                    <h4>Business & Management</h4>
                                    <ul>
                                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">View All Business Courses</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-column">
                                    <h4>All Courses</h4>
                                    <ul>
                                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Browse All Courses</a></li>
                                        <li><a href="<?php echo home_url('/admissions'); ?>">How to Apply</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo home_url('/admissions'); ?>" class="nav-link <?php echo is_page('admissions') ? 'active' : ''; ?> has-dropdown">Admissions</a>
                        <div class="dropdown-menu">
                            <a href="<?php echo home_url('/admissions'); ?>">How to Apply</a>
                            <a href="<?php echo home_url('/admissions'); ?>">Entry Requirements</a>
                            <a href="<?php echo home_url('/admissions'); ?>">International Students</a>
                            <a href="<?php echo home_url('/admissions'); ?>">Fees & Payment Plans</a>
                            <a href="<?php echo home_url('/admissions'); ?>">Policies & Forms</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo get_post_type_archive_link('event'); ?>" class="nav-link <?php echo is_post_type_archive('event') || is_singular('event') ? 'active' : ''; ?> has-dropdown">Events</a>
                        <div class="dropdown-menu">
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Upcoming Events</a>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Workshops</a>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Graduation Ceremony</a>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Student Activities</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo home_url('/contact'); ?>" class="nav-link <?php echo is_page('contact') ? 'active' : ''; ?>">Contact</a>
                    </li>
                </ul>

                <div style="display: flex; align-items: center; gap: 15px;">
                    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                        <span class="theme-icon" id="sunIcon">☀️</span>
                        <span class="theme-icon" id="moonIcon">🌙</span>
                    </button>
                    <div class="mobile-menu-btn" id="mobileMenuBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <span class="mobile-menu-close" id="mobileMenuClose">×</span>
        </div>
        <nav class="mobile-menu-nav">
            <ul>
                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                <li><a href="<?php echo home_url(); ?>#about">About Us</a></li>
                <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Courses</a></li>
                <li><a href="<?php echo home_url('/admissions'); ?>">Admissions</a></li>
                <li><a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a></li>
                <li><a href="<?php echo home_url('/contact'); ?>">Contact</a></li>
            </ul>
        </nav>
    </div>

    <!-- Page Content Wrapper -->
    <div class="site-content">