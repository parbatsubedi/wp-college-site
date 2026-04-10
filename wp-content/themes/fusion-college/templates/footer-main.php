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
                    <a href="#" aria-label="Facebook">📘</a>
                    <a href="#" aria-label="Twitter">🐦</a>
                    <a href="#" aria-label="Instagram">📷</a>
                    <a href="#" aria-label="LinkedIn">💼</a>
                    <a href="#" aria-label="YouTube">▶️</a>
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
                    <li><a href="<?php echo get_post_type_archive_link('course'); ?>?category=it">Information Technology</a></li>
                    <li><a href="<?php echo get_post_type_archive_link('course'); ?>?category=business">Business & Management</a></li>
                    <li><a href="<?php echo get_post_type_archive_link('course'); ?>?category=education">Early Childhood Education</a></li>
                    <li><a href="<?php echo get_post_type_archive_link('course'); ?>?category=english">English Programs</a></li>
                    <li><a href="<?php echo get_post_type_archive_link('course'); ?>?category=leadership">Leadership</a></li>
                    <li><a href="<?php echo get_post_type_archive_link('course'); ?>?category=cybersecurity">Cybersecurity</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Contact Info</h4>
                <ul class="footer-links">
                    <li>📍 <?php echo esc_html(fusion_college_address()); ?></li>
                    <li>📞 <span id="footerPhone"><?php echo esc_html(fusion_college_phone()); ?></span></li>
                    <li>✉️ <span id="footerEmail"><?php echo esc_html(fusion_college_email()); ?></span></li>
                    <li>🕐 Mon-Fri: 9AM-5PM</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copyright">© <?php echo date('Y'); ?> <?php echo esc_html(fusion_college_college_name()); ?>. All rights reserved. <?php $rto = fusion_college_get_option('rto_number'); $cricos = fusion_college_get_option('cricos_code'); ?><?php if ($rto) : ?>RTO: <?php echo esc_html($rto); ?><?php endif; ?><?php if ($rto && $cricos) : ?> | <?php endif; ?><?php if ($cricos) : ?>CRICOS: <?php echo esc_html($cricos); ?><?php endif; ?></p>
            <div class="footer-policies">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Refund Policy</a>
                <a href="#">Student Handbook</a>
            </div>
        </div>
    </div>
</footer>
