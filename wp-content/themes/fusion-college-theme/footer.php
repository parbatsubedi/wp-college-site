    </div> <!-- End site-content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="<?php echo home_url(); ?>" class="logo">
                        <div class="logo-icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M15 2L3 9v12l12 7 12-7V9L15 2z" fill="#077E86" fill-opacity="0.3" />
                                <path d="M15 5L6 10v10l9 5 9-5V10l-9-5z" fill="#077E86" />
                                <circle cx="15" cy="15" r="4" fill="#c9a227" />
                            </svg>
                        </div>
                        <div>
                            <div class="logo-text"><?php bloginfo('name'); ?></div>
                            <div class="logo-tagline">of Technology</div>
                        </div>
                    </a>
                    <p>Fusion College of Technology is a leading registered training organisation dedicated to providing quality vocational education and training to domestic and international students.</p>
                    <div class="footer-social">
                        <a href="#">📘</a>
                        <a href="#">🐦</a>
                        <a href="#">📷</a>
                        <a href="#">💼</a>
                        <a href="#">▶️</a>
                    </div>
                </div>

                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo home_url(); ?>#about">About Us</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Our Courses</a></li>
                        <li><a href="<?php echo home_url('/admissions'); ?>">Admissions</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a></li>
                        <li><a href="<?php echo home_url('/contact'); ?>">Contact Us</a></li>
                        <li><a href="#">Student Portal</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Programs</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Information Technology</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Business & Management</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Early Childhood Education</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">English Programs</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Leadership</a></li>
                        <li><a href="<?php echo get_post_type_archive_link('course'); ?>">Cybersecurity</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Contact Info</h4>
                    <ul class="footer-links">
                        <li>📍 <?php echo get_theme_mod('contact_address', 'Level 5, 123 George Street, Sydney NSW 2000'); ?></li>
                        <li>📞 <span><?php echo get_theme_mod('contact_phone', '1300 123 456'); ?></span></li>
                        <li>✉️ <span><?php echo get_theme_mod('contact_email', 'info@pacificinstitute.edu.au'); ?></span></li>
                        <li>🕐 Mon-Fri: 9AM-5PM</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copyright">© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved. RTO: <?php echo get_option('college_rto_code', '45123'); ?> | CRICOS: <?php echo get_option('college_cricos_code', '03456J'); ?></p>
                <div class="footer-policies">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Refund Policy</a>
                    <a href="#">Student Handbook</a>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

    <script>
    // Theme toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');
        const body = document.body;

        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        body.setAttribute('data-theme', currentTheme);

        if (currentTheme === 'dark') {
            sunIcon.style.opacity = '0';
            moonIcon.style.opacity = '1';
        } else {
            sunIcon.style.opacity = '1';
            moonIcon.style.opacity = '0';
        }

        themeToggle.addEventListener('click', function() {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            if (newTheme === 'dark') {
                sunIcon.style.opacity = '0';
                moonIcon.style.opacity = '1';
            } else {
                sunIcon.style.opacity = '1';
                moonIcon.style.opacity = '0';
            }
        });
    });

    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.main-header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuClose = document.getElementById('mobileMenuClose');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
            });

            mobileMenuClose.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                    mobileMenu.classList.remove('active');
                }
            });
        }
    });
    </script>
</body>
</html>