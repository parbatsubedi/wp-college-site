<!-- Header -->
<header class="main-header">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="nav-container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; gap: 25px; flex-wrap: wrap; color: white;">
                    <?php $phone = fusion_college_phone(); ?>
                    <?php if ($phone) : ?>
                        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle;"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 002.37 7.38 2 2 0 01-.45 2.32L8 16a2 2 0 012 2v2a2 2 0 01-2 2h-.06a19.68 19.68 0 01-1.21-3.08A2 2 0 015 9a2 2 0 012-2h3z"/></svg> <span><?php echo esc_html($phone); ?></span></span>
                    <?php endif; ?>
                    <?php $email = fusion_college_email(); ?>
                    <?php if ($email) : ?>
                        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> <span><?php echo esc_html($email); ?></span></span>
                    <?php endif; ?>
                    <?php $address = fusion_college_address(); ?>
                    <?php if ($address) : ?>
                        <span><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;vertical-align:middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg> <?php echo esc_html($address); ?></span>
                    <?php endif; ?>
                </div>
                <div style="display: flex; gap: 20px; align-items: center; color: white;">
    <?php $rto = fusion_college_rto(); ?>
    <?php if (!empty($rto)) : ?>
        <span style="font-weight: 600; padding: 4px 12px; background: rgba(255,255,255,0.15); border-radius: 4px;">
            RTO: <?php echo esc_html($rto); ?>
        </span>
    <?php endif; ?>

    <?php $cricos = fusion_college_cricos(); ?>
    <?php if (!empty($cricos)) : ?>
        <span style="font-weight: 600; padding: 4px 12px; background: rgba(255,255,255,0.15); border-radius: 4px;">
            CRICOS: <?php echo esc_html($cricos); ?>
        </span>
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
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'course_category',
                                'hide_empty' => true,
                                'orderby' => 'name',
                                'order' => 'ASC',
                            ));
                            if ($categories && !is_wp_error($categories)) :
                            ?>
                            <div class="mega-menu-content">
                                <div class="mega-menu-parents">
                                    <?php foreach ($categories as $cat) : ?>
                                    <div class="mega-menu-parent-item">
                                        <a href="<?php echo esc_url(get_post_type_archive_link('course') . '?category=' . $cat->slug); ?>" class="mega-menu-category-link">
                                            <?php echo esc_html($cat->name); ?>
                                        </a>
                                        <div class="mega-menu-children">
                                            <?php
                                            $cat_courses = get_posts(array(
                                                'post_type' => 'course',
                                                'posts_per_page' => -1,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'course_category',
                                                        'field' => 'slug',
                                                        'terms' => $cat->slug,
                                                    ),
                                                ),
                                                'orderby' => 'title',
                                                'order' => 'ASC',
                                            ));
                                            ?>
                                            <div class="mega-menu-children-content">
                                                <h4><?php echo esc_html($cat->name); ?></h4>
                                                <ul>
                                                    <?php foreach ($cat_courses as $course) : ?>
                                                        <li><a href="<?php echo esc_url(get_permalink($course->ID)); ?>"><?php echo esc_html($course->post_title); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
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
