<!-- Header -->
<header class="main-header">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="nav-container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; gap: 25px; flex-wrap: wrap;">
                    <?php $phone = fusion_college_phone(); ?>
                    <?php if ($phone) : ?>
                        <span>📞 <span><?php echo esc_html($phone); ?></span></span>
                    <?php endif; ?>
                    <?php $email = fusion_college_email(); ?>
                    <?php if ($email) : ?>
                        <span>✉️ <span><?php echo esc_html($email); ?></span></span>
                    <?php endif; ?>
                    <?php $address = fusion_college_address(); ?>
                    <?php if ($address) : ?>
                        <span>📍 <?php echo esc_html($address); ?></span>
                    <?php endif; ?>
                </div>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <?php $rto = fusion_college_get_option('rto_number'); ?>
                    <?php if ($rto) : ?>
                        <span>RTO: <?php echo esc_html($rto); ?></span>
                    <?php endif; ?>
                    <?php $cricos = fusion_college_get_option('cricos_code'); ?>
                    <?php if ($cricos) : ?>
                        <span>CRICOS: <?php echo esc_html($cricos); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="nav-container nav-pill-wrapper">
        <nav class="main-nav">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
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
                    <div class="logo-text" id="collegeName"><?php echo esc_html(fusion_college_college_name()); ?></div>
                    <?php $tagline = fusion_college_get_option('college_tagline'); ?>
                    <?php if ($tagline) : ?>
                        <div class="logo-tagline"><?php echo esc_html($tagline); ?></div>
                    <?php endif; ?>
                </div>
            </a>

            <?php
            // Primary navigation menu
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'depth'          => 3,
                    'walker'         => new Fusion_College_Nav_Walker(),
                ));
            } else {
                // Fallback menu if no menu is set
                ?>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?php echo esc_url(home_url('/')); ?>#about" class="nav-link has-dropdown">About Us</a>
                        <div class="dropdown-menu">
                            <a href="<?php echo esc_url(home_url('/')); ?>#about">Our Story</a>
                            <a href="<?php echo esc_url(home_url('/')); ?>#about">Mission & Vision</a>
                            <a href="<?php echo esc_url(home_url('/')); ?>#about">Leadership</a>
                            <a href="<?php echo esc_url(home_url('/')); ?>#about">Campus & Facilities</a>
                            <a href="<?php echo esc_url(home_url('/')); ?>#about">Accreditations</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo get_post_type_archive_link('course'); ?>" class="nav-link <?php echo is_post_type_archive('course') || is_singular('course') ? 'current-menu-item' : ''; ?> has-dropdown">Courses</a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <div class="mega-menu-column">
                                    <h4>Information Technology</h4>
                                    <ul>
                                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">View All IT Courses</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-column">
                                    <h4>Business & Management</h4>
                                    <ul>
                                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">View All Business Courses</a></li>
                                    </ul>
                                </div>
                                <div class="mega-menu-column">
                                    <h4>All Courses</h4>
                                    <ul>
                                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Browse All Courses</a></li>
                                        <li><a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">How to Apply</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>" class="nav-link <?php echo is_page('admissions') ? 'active' : ''; ?> has-dropdown">Admissions</a>
                        <div class="dropdown-menu">
                            <a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">How to Apply</a>
                            <a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">Entry Requirements</a>
                            <a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">International Students</a>
                            <a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">Fees & Payment Plans</a>
                            <a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">Policies & Forms</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo get_post_type_archive_link('event'); ?>" class="nav-link <?php echo is_post_type_archive('event') ? 'active' : ''; ?> has-dropdown">Events</a>
                        <div class="dropdown-menu">
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Upcoming Events</a>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Workshops</a>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Graduation Ceremony</a>
                            <a href="<?php echo get_post_type_archive_link('event'); ?>">Student Activities</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="nav-link <?php echo is_page('contact') ? 'active' : ''; ?>">Contact</a>
                    </li>
                </ul>
                <?php
            }
            ?>

            <div style="display: flex; align-items: center; gap: 15px;">
                <div class="mobile-menu-btn" id="mobileMenuBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </div>
</header>

<?php fusion_college_mobile_menu(); ?>
<?php fusion_college_toast(); ?>
