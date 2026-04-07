<?php
/**
 * Footer Template
 * Matches Laravel design
 */
if (! defined('ABSPATH')) {
    exit;
}
?>

    </div><!-- End site-content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Footer Brand & About -->
                <div class="footer-brand">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                        <div class="logo-icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M15 2L3 9v12l12 7 12-7V9L15 2z" fill="white" fill-opacity="0.3"/>
                                <path d="M15 5L6 10v10l9 5 9-5V10l-9-5z" fill="white"/>
                                <circle cx="15" cy="15" r="4" fill="#c9a227"/>
                            </svg>
                        </div>
                        <div class="logo-text-wrapper">
                            <span class="logo-text"><?php echo esc_html(fusion_get_setting('college_name', 'Fusion College')); ?></span>
                            <span class="logo-tagline"><?php echo esc_html(fusion_get_setting('tagline', 'of Technology')); ?></span>
                        </div>
                    </a>
                    <p class="footer-description"><?php echo esc_html(fusion_get_setting('about_description', 'Fusion College of Technology is a leading registered training organisation dedicated to providing quality vocational education and training.')); ?></p>
                    <div class="footer-social">
                        <?php
                        $social = fusion_get_social_links();
if ($social['facebook'] && $social['facebook'] !== '#') {
    echo '<a href="'.esc_url($social['facebook']).'" target="_blank" aria-label="Facebook">📘</a>';
}
if ($social['twitter'] && $social['twitter'] !== '#') {
    echo '<a href="'.esc_url($social['twitter']).'" target="_blank" aria-label="Twitter">🐦</a>';
}
if ($social['instagram'] && $social['instagram'] !== '#') {
    echo '<a href="'.esc_url($social['instagram']).'" target="_blank" aria-label="Instagram">📷</a>';
}
if ($social['linkedin'] && $social['linkedin'] !== '#') {
    echo '<a href="'.esc_url($social['linkedin']).'" target="_blank" aria-label="LinkedIn">💼</a>';
}
?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <?php
                    wp_nav_menu([
'theme_location' => 'footer',
'container' => false,
'menu_class' => 'footer-links',
'fallback_cb' => false,
                    ]);
?>
                    <?php if (! has_nav_menu('footer')) { ?>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/#about')); ?>">About Us</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Our Courses</a></li>
                        <li><a href="<?php echo esc_url(home_url('/admissions')); ?>">Admissions</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('event')); ?>">Events</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
                    </ul>
                    <?php } ?>
                </div>

                <!-- Programs -->
                <div class="footer-column">
                    <h4>Programs</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Information Technology</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Business & Management</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Early Childhood Education</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">English Programs</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Leadership</a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>">Cybersecurity</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-column">
                    <h4>Contact Info</h4>
                    <ul class="footer-links">
                        <li>📞 <?php echo esc_html(fusion_get_contact_info()['phone']); ?></li>
                        <li>✉️ <?php echo esc_html(fusion_get_contact_info()['email']); ?></li>
                        <li>📍 <?php echo esc_html(fusion_get_contact_info()['address']); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p class="footer-copyright">
                    © <?php echo date('Y'); ?> <?php echo esc_html(fusion_get_setting('college_name', 'Fusion College')); ?>. All rights reserved. 
                    RTO: <?php echo esc_html(fusion_get_setting('rto_number', '45123')); ?> | 
                    CRICOS: <?php echo esc_html(fusion_get_setting('cricos_code', '03456J')); ?>
                </p>
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

    <!-- Theme Scripts -->
    <script>
    (function() {
        'use strict';

        // ========== PILL NAVIGATION SCROLL EFFECT ==========
        var header = document.getElementById('mainHeader');
        var topBar = document.getElementById('topBar');
        var navPillWrapper = document.getElementById('navPillWrapper');
        var mainNav = document.getElementById('mainNav');
        
        if (header && topBar && navPillWrapper && mainNav) {
            // Check if we're on homepage (hero section present)
            var isHomepage = document.querySelector('.hero');
            
            function updateHeaderOnScroll() {
                var scrollY = window.scrollY;
                var windowHeight = window.innerHeight;
                
                if (scrollY > 80) {
                    // Scrolled: Show pill nav, hide top bar
                    header.classList.add('scrolled');
                    topBar.style.maxHeight = '0';
                    topBar.style.padding = '0';
                    topBar.style.opacity = '0';
                    navPillWrapper.style.padding = '0';
                    mainNav.style.padding = '8px 25px';
                    mainNav.style.background = 'rgba(255, 255, 255, 0.95)';
                    mainNav.style.backdropFilter = 'blur(20px)';
                    mainNav.style.borderRadius = '50px';
                    mainNav.style.border = '1px solid #e5e7eb';
                    mainNav.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.12)';
                } else {
                    // At top: Show full header, transparent nav
                    header.classList.remove('scrolled');
                    topBar.style.maxHeight = '50px';
                    topBar.style.padding = '8px 0';
                    topBar.style.opacity = '1';
                    navPillWrapper.style.padding = '0';
                    mainNav.style.padding = '12px 0';
                    mainNav.style.background = 'transparent';
                    mainNav.style.backdropFilter = 'none';
                    mainNav.style.borderRadius = '0';
                    mainNav.style.border = '1px solid transparent';
                    mainNav.style.boxShadow = 'none';
                }
            }
            
            // Initial check
            updateHeaderOnScroll();
            
            // Listen to scroll
            window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
        }

        // ========== THEME TOGGLE ==========
        var themeToggle = document.getElementById('themeToggle');
        var body = document.body;
        
        if (themeToggle) {
            var savedTheme = localStorage.getItem('fusion-theme') || 'light';
            body.setAttribute('data-theme', savedTheme);
            updateThemeIcon(savedTheme);

            themeToggle.addEventListener('click', function() {
                var currentTheme = body.getAttribute('data-theme');
                var newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                body.setAttribute('data-theme', newTheme);
                localStorage.setItem('fusion-theme', newTheme);
                updateThemeIcon(newTheme);
            });
        }

        function updateThemeIcon(theme) {
            var sunIcon = document.querySelector('.sun-icon');
            var moonIcon = document.querySelector('.moon-icon');
            if (sunIcon && moonIcon) {
                sunIcon.style.opacity = theme === 'dark' ? '0' : '1';
                moonIcon.style.opacity = theme === 'dark' ? '1' : '0';
            }
        }

        // ========== MOBILE MENU ==========
        var mobileMenuBtn = document.getElementById('mobileMenuBtn');
        var mobileMenu = document.getElementById('mobileMenu');
        var mobileMenuClose = document.getElementById('mobileMenuClose');
        var mobileOverlay = document.getElementById('mobileOverlay');

        function openMobileMenu() {
            if (mobileMenu) {
                mobileMenu.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
            if (mobileOverlay) {
                mobileOverlay.classList.add('open');
            }
        }

        function closeMobileMenu() {
            if (mobileMenu) {
                mobileMenu.classList.remove('open');
                document.body.style.overflow = '';
            }
            if (mobileOverlay) {
                mobileOverlay.classList.remove('open');
            }
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileMenu);
        }

        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', closeMobileMenu);
        }

        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', closeMobileMenu);
        }

        // ========== FADE IN ANIMATION ==========
        var fadeElements = document.querySelectorAll('.fade-in');
        if ('IntersectionObserver' in window) {
            var fadeObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });

            fadeElements.forEach(function(el) {
                fadeObserver.observe(el);
            });
        } else {
            fadeElements.forEach(function(el) {
                el.classList.add('visible');
            });
        }

        // ========== COUNTER ANIMATION ==========
        var counters = document.querySelectorAll('[data-target]');
        if ('IntersectionObserver' in window) {
            var counterObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var target = parseInt(entry.target.dataset.target);
                        var current = 0;
                        var increment = target / 50;
                        var timer = setInterval(function() {
                            current += increment;
                            if (current >= target) {
                                entry.target.textContent = target;
                                clearInterval(timer);
                            } else {
                                entry.target.textContent = Math.floor(current);
                            }
                        }, 30);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(function(counter) {
                counterObserver.observe(counter);
            });
        }

    })();
    </script>

</body>
</html>
