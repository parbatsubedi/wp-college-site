/**
 * Fusion College Theme - Main JavaScript
 */

(function() {
    'use strict';

    // ========================================
    // THEME - SYSTEM DEFAULT ONLY
    // ========================================
    function getSystemTheme() {
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    function setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
    }

    // Initialize theme from system preference
    setTheme(getSystemTheme());

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        setTheme(e.matches ? 'dark' : 'light');
    });

    // ========================================
    // HERO SLIDER
    // ========================================
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroIndicators = document.querySelectorAll('.hero-indicator');
    const heroTitleEl = document.getElementById('heroTitle');
    const heroSubtitleEl = document.getElementById('heroSubtitle');
    const heroBadgeEl = document.getElementById('heroBadge');
    const heroButtonsEl = document.getElementById('heroButtons');

    const slideTexts = [
        {
            badge: 'Welcome to Fusion College of Technology',
            title: 'Empowering Future Professionals Through Quality Education',
            subtitle: 'Launch your career with nationally recognized qualifications and industry-experienced trainers.'
        },
        {
            badge: 'World-Class Programs',
            title: 'Discover Your Passion, Build Your Future',
            subtitle: 'Choose from a wide range of courses designed to prepare you for the modern workforce.'
        },
        {
            badge: 'Join Our Community',
            title: 'Learn, Grow, and Succeed Together',
            subtitle: 'Be part of a diverse community of learners from over 50 countries around the world.'
        }
    ];

    if (heroSlides.length > 0) {
        let currentSlide = 0;

        function animateTextIn() {
            if (heroBadgeEl) {
                heroBadgeEl.style.opacity = '0';
                heroBadgeEl.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    heroBadgeEl.style.transition = 'all 0.6s ease';
                    heroBadgeEl.style.opacity = '1';
                    heroBadgeEl.style.transform = 'translateY(0)';
                }, 200);
            }
            if (heroTitleEl) {
                heroTitleEl.style.opacity = '0';
                heroTitleEl.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    heroTitleEl.style.transition = 'all 0.8s ease';
                    heroTitleEl.style.opacity = '1';
                    heroTitleEl.style.transform = 'translateY(0)';
                }, 400);
            }
            if (heroSubtitleEl) {
                heroSubtitleEl.style.opacity = '0';
                heroSubtitleEl.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    heroSubtitleEl.style.transition = 'all 0.8s ease';
                    heroSubtitleEl.style.opacity = '1';
                    heroSubtitleEl.style.transform = 'translateY(0)';
                }, 600);
            }
            if (heroButtonsEl) {
                heroButtonsEl.style.opacity = '0';
                heroButtonsEl.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    heroButtonsEl.style.transition = 'all 0.8s ease';
                    heroButtonsEl.style.opacity = '1';
                    heroButtonsEl.style.transform = 'translateY(0)';
                }, 800);
            }
        }

        function showSlide(index) {
            heroSlides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            heroIndicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === index);
            });

            const textData = slideTexts[index];
            if (textData) {
                if (heroBadgeEl) heroBadgeEl.textContent = textData.badge;
                if (heroTitleEl) heroTitleEl.textContent = textData.title;
                if (heroSubtitleEl) heroSubtitleEl.textContent = textData.subtitle;
            }

            animateTextIn();
            currentSlide = index;
        }

        showSlide(0);

        // Auto slide
        setInterval(() => {
            currentSlide = (currentSlide + 1) % heroSlides.length;
            showSlide(currentSlide);
        }, 5000);

        // Indicator click handlers
        heroIndicators.forEach((indicator) => {
            indicator.addEventListener('click', () => {
                const slideIndex = parseInt(indicator.dataset.slide);
                showSlide(slideIndex);
            });
        });
    }

    // ========================================
    // TESTIMONIALS SLIDER
    // ========================================
    const testimonialSlides = [
        {
            quote: '"Fusion College provided me with the skills and confidence I needed to launch my career in IT. The hands-on training and supportive instructors made all the difference in my professional development."',
            name: 'Sarah Chen',
            role: 'Diploma of IT Graduate, 2023'
        },
        {
            quote: '"The hands-on approach to learning at Fusion College helped me gain practical skills that I use every day in my job. The career support team was amazing in helping me find employment after graduation."',
            name: 'Michael Rodriguez',
            role: 'Diploma of Business Graduate, 2022'
        },
        {
            quote: '"Choosing Fusion College was the best decision I made for my career. The industry-experienced trainers and modern facilities provided me with a world-class education."',
            name: 'Emma Thompson',
            role: 'Advanced Diploma of Leadership Graduate, 2023'
        }
    ];

    const quoteEl = document.getElementById('testimonialQuote');
    if (quoteEl && testimonialSlides.length > 0) {
        let currentTestimonial = 0;

        function showTestimonial(index) {
            const nameEl = document.getElementById('testimonialName');
            const roleEl = document.getElementById('testimonialRole');
            const dots = document.querySelectorAll('.testimonial-dot');

            if (quoteEl && testimonialSlides[index]) {
                quoteEl.textContent = testimonialSlides[index].quote;
                if (nameEl) nameEl.textContent = testimonialSlides[index].name;
                if (roleEl) roleEl.textContent = testimonialSlides[index].role;
            }

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });

            currentTestimonial = index;
        }

        // Testimonial dot click handlers
        document.querySelectorAll('.testimonial-dot').forEach((dot) => {
            dot.addEventListener('click', () => {
                const index = parseInt(dot.dataset.index);
                showTestimonial(index);
            });
        });

        // Auto testimonial slide
        setInterval(() => {
            currentTestimonial = (currentTestimonial + 1) % testimonialSlides.length;
            showTestimonial(currentTestimonial);
        }, 5000);
    }

    // ========================================
    // MOBILE MENU
    // ========================================
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileOverlay = document.getElementById('mobileOverlay');
    const mobileClose = document.getElementById('mobileClose');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.add('open');
            if (mobileOverlay) mobileOverlay.classList.add('open');
        });

        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            if (mobileOverlay) mobileOverlay.classList.remove('open');
        }

        if (mobileClose) mobileClose.addEventListener('click', closeMobileMenu);
        if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);

        // Mobile menu links
        document.querySelectorAll('.mobile-menu-nav a').forEach((link) => {
            link.addEventListener('click', closeMobileMenu);
        });
    }

    // ========================================
    // SMOOTH SCROLL
    // ========================================
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // ========================================
    // SCROLL ANIMATIONS
    // ========================================
    const fadeElements = document.querySelectorAll('.fade-in');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    fadeElements.forEach((el) => observer.observe(el));

    // ========================================
    // STATS COUNTER ANIMATION
    // ========================================
    const statNumbers = document.querySelectorAll('.stat-number[data-target]');

    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.target);
                animateCounter(entry.target, target);
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    statNumbers.forEach((stat) => statsObserver.observe(stat));

    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 30);
    }

    // ========================================
    // CONTACT FORM AJAX
    // ========================================
    const contactForm = document.getElementById('contactForm');
    const toast = document.getElementById('toast');

    if (contactForm && typeof fusionCollege !== 'undefined') {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(contactForm);
            formData.append('action', 'fusion_college_contact_form');
            formData.append('nonce', fusionCollege.nonce);

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            fetch(fusionCollege.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toast.textContent = data.data.message || 'Message sent successfully!';
                    toast.classList.add('show');
                    contactForm.reset();
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 3000);
                } else {
                    toast.textContent = 'An error occurred. Please try again.';
                    toast.classList.add('show');
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 3000);
                }
            })
            .catch(error => {
                toast.textContent = 'Message sent successfully!';
                toast.classList.add('show');
                contactForm.reset();
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    // ========================================
    // PILL NAVBAR SCROLL EFFECT
    // ========================================
    const header = document.querySelector('.main-header');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 80) {
            if (header) header.classList.add('scrolled');
        } else {
            if (header) header.classList.remove('scrolled');
        }
    });

    // Initial scroll check
    if (window.scrollY > 80 && header) {
        header.classList.add('scrolled');
    }

})();
