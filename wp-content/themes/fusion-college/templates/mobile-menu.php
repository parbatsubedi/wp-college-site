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
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 002.37 7.38 2 2 0 01-.45 2.32L8 16a2 2 0 012 2v2a2 2 0 01-2 2h-.06a19.68 19.68 0 01-1.21-3.08A2 2 0 015 9a2 2 0 012-2h3z"/></svg>
            <span><?php echo esc_html($phone); ?></span>
        </div>
        <?php endif; ?>
        <?php if ($email) : ?>
        <div style="display: flex; align-items: center; gap: 10px; color: var(--text-muted); font-size: 14px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
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
