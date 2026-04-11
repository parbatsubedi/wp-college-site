<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                    <div class="logo-icon">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M15 2L3 9v12l12 7 12-7V9L15 2z" fill="#077E86" fill-opacity="0.3" />
                            <path d="M15 5L6 10v10l9 5 9-5V10l-9-5z" fill="#077E86" />
                            <circle cx="15" cy="15" r="4" fill="#c9a227" />
                        </svg>
                    </div>
                    <div>
                        <div class="logo-text" id="collegeNameFooter"><?php echo esc_html(fusion_college_college_name()); ?></div>
                        <?php $tagline = fusion_college_get_option('college_tagline'); ?>
                        <?php if ($tagline) : ?>
                            <div class="logo-tagline"><?php echo esc_html($tagline); ?></div>
                        <?php endif; ?>
                    </div>
                </a>
                <p><?php echo esc_html(fusion_college_college_name()); ?> is a leading registered training organisation dedicated to providing quality vocational education and training to domestic and international students.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a>
                    <a href="#" aria-label="Twitter"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.11 11.11 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg></a>
                    <a href="#" aria-label="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
                    <a href="#" aria-label="LinkedIn"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg></a>
                    <a href="#" aria-label="YouTube"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="white"/></svg></a>
                </div>
            </div>

            <div class="footer-column">
                <h4>Quick Links</h4>
                <?php
                if (has_nav_menu('footer')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-links',
                        'container'      => false,
                        'depth'          => 1,
                    ));
                } else {
                ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>#about">About Us</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Our Courses</a></li>
                        <li><a href="<?php echo get_permalink(get_page_by_path('admissions')); ?>">Admissions</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a></li>
                        <li><a href="<?php echo get_permalink(get_page_by_path('contact')); ?>">Contact Us</a></li>
                        <li><a href="#">Student Portal</a></li>
                    </ul>
                <?php } ?>
            </div>

            <div class="footer-column">
                <h4>Programs</h4>
                <ul class="footer-links">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'course_category',
                        'hide_empty' => true,
                    ));
                    if ($categories && !is_wp_error($categories)) :
                        foreach ($categories as $cat) :
                    ?>
                    <li><a href="<?php echo esc_url(get_post_type_archive_link('course') . '?category=' . $cat->slug); ?>"><?php echo esc_html($cat->name); ?></a></li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Contact Info</h4>
                <ul class="footer-links">
                    <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg> <?php echo esc_html(fusion_college_address()); ?></li>
                    <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:middle;"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 002.37 7.38 2 2 0 01-.45 2.32L8 16a2 2 0 012 2v2a2 2 0 01-2 2h-.06a19.68 19.68 0 01-1.21-3.08A2 2 0 015 9a2 2 0 012-2h3z"/></svg> <span id="footerPhone"><?php echo esc_html(fusion_college_phone()); ?></span></li>
                    <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:middle;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> <span id="footerEmail"><?php echo esc_html(fusion_college_email()); ?></span></li>
                    <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;vertical-align:middle;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Mon-Fri: 9AM-5PM</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copyright">© <?php echo date('Y'); ?> FUSION COLLEGE OF TECHNOLOGY, All Rights Reserved. <?php echo esc_html(fusion_college_rto()); ?> | <?php echo esc_html(fusion_college_cricos()); ?></p>
            <div class="footer-policies">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Refund Policy</a>
                <a href="#">Student Handbook</a>
            </div>
        </div>
    </div>
</footer>
