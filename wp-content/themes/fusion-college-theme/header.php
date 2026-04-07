<?php
/**
 * Header Template
 * Matches Laravel design with pill-shaped resizable nav
 */
if (! defined('ABSPATH')) {
    exit;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Main Header - Transparent initially, pill-shaped on scroll -->
    <header class="main-header" id="mainHeader">
        <!-- Top Bar - Disappears on scroll -->
        <div class="top-bar" id="topBar">
            <div class="nav-container">
                <div class="top-bar-content">
                    <div class="top-bar-left">
                        <span class="top-bar-item">📞 <?php echo esc_html(fusion_get_contact_info()['phone']); ?></span>
                        <span class="top-bar-item">✉️ <?php echo esc_html(fusion_get_contact_info()['email']); ?></span>
                        <span class="top-bar-item">📍 <?php echo esc_html(fusion_get_contact_info()['address']); ?></span>
                    </div>
                    <div class="top-bar-right">
                        <span>RTO: <?php echo esc_html(fusion_get_setting('rto_number', '45123')); ?></span>
                        <span>CRICOS: <?php echo esc_html(fusion_get_setting('cricos_code', '03456J')); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation - Becomes pill-shaped on scroll -->
        <div class="nav-pill-wrapper" id="navPillWrapper">
            <nav class="main-nav" id="mainNav">
                <!-- Logo -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo-icon">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M15 2L3 9v12l12 7 12-7V9L15 2z" fill="white" fill-opacity="0.3"/>
                            <path d="M15 5L6 10v10l9 5 9-5V10l-9-5z" fill="white"/>
                            <circle cx="15" cy="15" r="4" fill="#077E86"/>
                        </svg>
                    </div>
                    <div class="logo-text-wrapper">
                        <span class="logo-text"><?php echo esc_html(fusion_get_setting('college_name', 'Fusion College')); ?></span>
                        <span class="logo-tagline"><?php echo esc_html(fusion_get_setting('tagline', 'of Technology')); ?></span>
                    </div>
                </a>

                <!-- Primary Menu -->
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'nav-menu',
                    'fallback_cb' => false,
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                ]);
?>
                
                <!-- Fallback Menu -->
                <?php if (! has_nav_menu('primary')) { ?>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">Home</a></li>
                    <li class="nav-item"><a href="<?php echo esc_url(home_url('/#about')); ?>" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>" class="nav-link">Courses</a></li>
                    <li class="nav-item"><a href="<?php echo esc_url(home_url('/admissions')); ?>" class="nav-link">Admissions</a></li>
                    <li class="nav-item"><a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>" class="nav-link">Events</a></li>
                    <li class="nav-item"><a href="<?php echo esc_url(home_url('/contact')); ?>" class="nav-link">Contact</a></li>
                </ul>
                <?php } ?>

                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Theme Toggle -->
                    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                        <span class="theme-icon sun-icon">☀️</span>
                        <span class="theme-icon moon-icon">🌙</span>
                    </button>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Open menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </nav>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay" id="mobileOverlay"></div>
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <span class="mobile-menu-close" id="mobileMenuClose">×</span>
        </div>
        <nav class="mobile-menu-nav">
            <?php
            wp_nav_menu([
'theme_location' => 'primary',
'container' => false,
'menu_class' => 'mobile-nav-menu',
'fallback_cb' => false,
            ]);
?>
            <?php if (! has_nav_menu('primary')) { ?>
            <ul class="mobile-nav-menu">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/#about')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Courses</a></li>
                <li><a href="<?php echo esc_url(home_url('/admissions')); ?>">Admissions</a></li>
                <li><a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>">Events</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
            </ul>
            <?php } ?>
        </nav>
    </div>

    <!-- Page Content Wrapper -->
    <div class="site-content" id="siteContent">
