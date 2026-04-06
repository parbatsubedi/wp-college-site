// Fusion College Theme JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuClose = document.getElementById('mobile-menu-close');

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            this.classList.toggle('active');
        });

        mobileMenuClose.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            mobileMenuToggle.classList.remove('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                mobileMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            }
        });
    }

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (mobileMenu) {
                    mobileMenu.classList.remove('active');
                    if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
                }
            }
        });
    });

    // Form validation
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const requiredFields = contactForm.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('error');
                    isValid = false;
                } else {
                    field.classList.remove('error');
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }

    // Application form validation
    const applicationForm = document.querySelector('.application-form');
    if (applicationForm) {
        applicationForm.addEventListener('submit', function(e) {
            const emailField = applicationForm.querySelector('input[type="email"]');
            const phoneField = applicationForm.querySelector('input[name="phone"]');

            if (emailField && !isValidEmail(emailField.value)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                emailField.focus();
                return;
            }

            if (phoneField && !isValidPhone(phoneField.value)) {
                e.preventDefault();
                alert('Please enter a valid phone number.');
                phoneField.focus();
                return;
            }
        });
    }

    // Sticky header
    const header = document.querySelector('.site-header');
    if (header) {
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scrolling down
                header.style.transform = 'translateY(-100%)';
            } else {
                // Scrolling up
                header.style.transform = 'translateY(0)';
            }

            lastScrollTop = scrollTop;
        });
    }

    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.card, .stat-item, .section > *');
    animateElements.forEach(element => {
        observer.observe(element);
    });

    // Success message handling
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        showNotification('Message sent successfully!', 'success');
    }
    if (urlParams.get('applied') === '1') {
        showNotification('Application submitted successfully!', 'success');
    }
});

// Utility functions
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
    return phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''));
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;

    // Add to page
    document.body.appendChild(notification);

    // Show notification
    setTimeout(() => notification.classList.add('show'), 100);

    // Hide and remove after 5 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => document.body.removeChild(notification), 300);
    }, 5000);
}

// Add notification styles
const notificationStyles = `
<style>
.notification {
    position: fixed;
    top: 100px;
    right: 20px;
    background: #077E86;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    transform: translateX(100%);
    transition: transform 0.3s ease;
    z-index: 10000;
    max-width: 300px;
}

.notification.show {
    transform: translateX(0);
}

.notification-success {
    background: #28a745;
}

.notification-error {
    background: #dc3545;
}

.notification-info {
    background: #17a2b8;
}

.error {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

.mobile-menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 300px;
    height: 100vh;
    background: white;
    box-shadow: -2px 0 10px rgba(0,0,0,0.1);
    transition: right 0.3s ease;
    z-index: 10001;
    padding-top: 80px;
}

.mobile-menu.active {
    right: 0;
}

.mobile-menu-header {
    position: absolute;
    top: 20px;
    right: 20px;
}

.mobile-menu-close {
    font-size: 24px;
    cursor: pointer;
    color: #666;
}

.mobile-menu-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-menu-nav li {
    border-bottom: 1px solid #eee;
}

.mobile-menu-nav a {
    display: block;
    padding: 15px 20px;
    color: #333;
    text-decoration: none;
    transition: background 0.3s;
}

.mobile-menu-nav a:hover {
    background: #f8f9fa;
}

.mobile-menu-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
    gap: 4px;
}

.mobile-menu-toggle span {
    width: 25px;
    height: 3px;
    background: #333;
    transition: 0.3s;
}

.mobile-menu-toggle.active span:nth-child(1) {
    transform: rotate(-45deg) translate(-5px, 6px);
}

.mobile-menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active span:nth-child(3) {
    transform: rotate(45deg) translate(-5px, -6px);
}

@media (max-width: 768px) {
    .mobile-menu-toggle {
        display: flex;
    }

    .main-navigation {
        display: none;
    }
}

.animate-in {
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
`;

// Add styles to head
document.head.insertAdjacentHTML('beforeend', notificationStyles);