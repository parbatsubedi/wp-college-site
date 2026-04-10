<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileOverlay"></div>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <div class="logo-icon">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path d="M15 2L3 9v12l12 7 12-7V9L15 2z" fill="white" fill-opacity="0.2" />
                    <path d="M15 5L6 10v10l9 5 9-5V10l-9-5z" fill="white" />
                    <circle cx="15" cy="15" r="4" fill="#077E86" />
                </svg>
            </div>
            <div>
                <div class="logo-text"><?php echo esc_html(fusion_college_college_name()); ?></div>
            </div>
        </a>
        <button class="mobile-menu-close" id="mobileClose">×</button>
    </div>

    <?php $phone = fusion_college_phone(); $email = fusion_college_email(); ?>
    <?php if ($phone || $email) : ?>
    <div style="padding: 15px 20px; border-bottom: 1px solid var(--border-color);">
        <?php if ($phone) : ?>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; color: var(--text-muted); font-size: 14px;">
            <span>📞</span>
            <span><?php echo esc_html($phone); ?></span>
        </div>
        <?php endif; ?>
        <?php if ($email) : ?>
        <div style="display: flex; align-items: center; gap: 10px; color: var(--text-muted); font-size: 14px;">
            <span>✉️</span>
            <span><?php echo esc_html($email); ?></span>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <nav class="mobile-menu-nav">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => '',
                'container'      => false,
                'depth'          => 1,
                'link_before'    => '',
                'link_after'     => '',
                'items_wrap'     => '%3$s',
            ));
        } else {
        ?>
        <a href="<?php echo esc_url(home_url('/')); ?>#about">About Us</a>
        <a href="<?php echo get_post_type_archive_link('course'); ?>">Courses</a>
        <a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">Admissions</a>
        <a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a>
        <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>">Contact</a>
        <?php } ?>
    </nav>
</div>
