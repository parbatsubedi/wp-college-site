<?php
/**
 * Template Functions
 *
 * @package Fusion_College
 */

if (!defined('ABSPATH')) {
    exit;
}

// Render header
function fusion_college_header() {
    get_template_part('templates/header-main');
}

// Render footer
function fusion_college_footer() {
    get_template_part('templates/footer-main');
}

// Render mobile menu
function fusion_college_mobile_menu() {
    get_template_part('templates/mobile-menu');
}

// Render toast notification
function fusion_college_toast() {
    get_template_part('templates/toast');
}

// Get page banner (for page templates)
function fusion_college_page_banner($title, $subtitle = '', $breadcrumbs = array()) {
    ?>
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <h1><?php echo esc_html($title); ?></h1>
                <?php if ($subtitle) : ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
                <?php if (!empty($breadcrumbs)) : ?>
                    <div class="breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        <?php foreach ($breadcrumbs as $crumb) : ?>
                            <span>/</span>
                            <?php if (!empty($crumb['url'])) : ?>
                                <a href="<?php echo esc_url($crumb['url']); ?>"><?php echo esc_html($crumb['label']); ?></a>
                            <?php else : ?>
                                <span><?php echo esc_html($crumb['label']); ?></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}

// Render CTA section
function fusion_college_cta_section($title = 'Ready to Start Your Journey?', $subtitle = '', $btn1_text = 'Apply Now', $btn1_url = '', $btn2_text = 'Contact Us', $btn2_url = '') {
    if (!$subtitle) {
        $subtitle = 'Enroll now and take the first step towards your dream career. Our admissions team is here to help you.';
    }
    if (!$btn1_url) {
        $btn1_url = get_permalink(get_page_by_path('admissions'));
    }
    if (!$btn2_url) {
        $btn2_url = get_permalink(get_page_by_path('contact'));
    }
    ?>
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title"><?php echo esc_html($title); ?></h2>
                <p class="cta-subtitle"><?php echo esc_html($subtitle); ?></p>
                <div class="hero-buttons">
                    <?php if ($btn1_text && $btn1_url) : ?>
                        <a href="<?php echo esc_url($btn1_url); ?>" class="btn btn-primary"><?php echo esc_html($btn1_text); ?></a>
                    <?php endif; ?>
                    <?php if ($btn2_text && $btn2_url) : ?>
                        <a href="<?php echo esc_url($btn2_url); ?>" class="btn btn-outline"><?php echo esc_html($btn2_text); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}

// Render hero section
function fusion_college_hero_section() {
    $badge = fusion_college_get_option('hero_badge', 'Welcome to Fusion College of Technology');
    $title = fusion_college_get_option('hero_title', 'Empowering Future Professionals Through Quality Education');
    $subtitle = fusion_college_get_option('hero_subtitle', 'Launch your career with nationally recognized qualifications and industry-experienced trainers.');

    $courses_url = get_permalink(get_page_by_path('courses'));
    $contact_url = get_permalink(get_page_by_path('contact'));
    if (!$courses_url) $courses_url = home_url('/courses/');
    if (!$contact_url) $contact_url = home_url('/contact/');
    ?>
    <section class="hero">
        <div class="hero-slider">
            <div class="hero-slide hero-slide-1 active">
                <div class="hero-slide-bg" style="background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c476?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;"></div>
                <div class="hero-slide-overlay"></div>
            </div>
            <div class="hero-slide hero-slide-2">
                <div class="hero-slide-bg" style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;"></div>
                <div class="hero-slide-overlay"></div>
            </div>
            <div class="hero-slide hero-slide-3">
                <div class="hero-slide-bg" style="background-image: url('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;"></div>
                <div class="hero-slide-overlay"></div>
            </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-badge" id="heroBadge"><?php echo esc_html($badge); ?></span>
            <h1 class="hero-title" id="heroTitle"><?php echo esc_html($title); ?></h1>
            <p class="hero-subtitle" id="heroSubtitle"><?php echo esc_html($subtitle); ?></p>
            <div class="hero-buttons" id="heroButtons">
                <a href="<?php echo esc_url($courses_url); ?>" class="btn btn-primary">Explore Courses</a>
                <a href="<?php echo esc_url($contact_url); ?>" class="btn btn-outline">Enquire Now</a>
            </div>
        </div>
        <div class="hero-graphics">
            <svg class="building-silhouette" width="1920" height="200" viewBox="0 0 1920 200" preserveAspectRatio="none">
                <path d="M0,200 L0,150 L100,150 L100,120 L150,120 L150,150 L200,150 L200,100 L250,100 L250,150 L350,150 L350,80 L400,80 L400,150 L500,150 L500,60 L550,60 L550,150 L650,150 L650,90 L700,90 L700,150 L800,150 L800,110 L850,110 L850,150 L950,150 L950,70 L1000,70 L1000,150 L1100,150 L1100,100 L1150,100 L1150,150 L1250,150 L1250,85 L1300,85 L1300,150 L1400,150 L1400,120 L1450,120 L1450,150 L1550,150 L1550,95 L1600,95 L1600,150 L1700,150 L1700,110 L1750,110 L1750,150 L1850,150 L1850,130 L1900,130 L1900,150 L1920,150 L1920,200 Z" fill="currentColor" opacity="0.1"/>
            </svg>
        </div>
        <div class="hero-indicators">
            <span class="hero-indicator active" data-slide="0"></span>
            <span class="hero-indicator" data-slide="1"></span>
            <span class="hero-indicator" data-slide="2"></span>
        </div>
    </section>
    <?php
}

// Render stats section
function fusion_college_stats_section() {
    ?>
    <section class="section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card fade-in">
                    <div class="stat-icon">🎓</div>
                    <div class="stat-number" data-target="5000">0</div>
                    <div class="stat-label">Students Enrolled</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-icon">🏆</div>
                    <div class="stat-number" data-target="95">0</div>
                    <div class="stat-label">% Employment Rate</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-icon">👨‍🏫</div>
                    <div class="stat-number" data-target="150">0</div>
                    <div class="stat-label">Industry Trainers</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-icon">🌍</div>
                    <div class="stat-number" data-target="50">0</div>
                    <div class="stat-label">Countries Represented</div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

// Render about section
function fusion_college_about_section() {
    $college_name = fusion_college_college_name();
    $rto = fusion_college_get_option('rto_number', '45123');
    $contact_url = get_permalink(get_page_by_path('contact'));
    if (!$contact_url) $contact_url = home_url('/contact/');
    ?>
    <section class="section section-alt" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-content fade-in">
                    <h3>About <?php echo esc_html($college_name); ?></h3>
                    <p>We are a leading educational institution dedicated to providing high-quality training and education to students from around the world. Our modern facilities, experienced trainers, and industry-focused curriculum ensure graduates are ready for the workforce.</p>
                    <p>At <?php echo esc_html($college_name); ?>, we believe in practical learning that prepares you for real-world challenges. Our courses are designed in consultation with industry partners to ensure relevance and employment outcomes.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>Nationally Recognized Qualifications</span>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>Industry-Experienced Trainers</span>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>Modern Campus Facilities</span>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>Career Support Services</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url($contact_url); ?>" class="btn btn-primary" style="margin-top: 30px;">Learn More</a>
                </div>
                <div class="about-image fade-in">
                    <div class="about-image-main">
                        <svg class="campus-scene" viewBox="0 0 400 450" preserveAspectRatio="xMidYMid meet">
                            <rect x="50" y="200" width="300" height="250" fill="rgba(255,255,255,0.1)" rx="10"/>
                            <rect x="80" y="150" width="80" height="300" fill="rgba(255,255,255,0.15)" rx="5"/>
                            <rect x="180" y="100" width="140" height="350" fill="rgba(255,255,255,0.12)" rx="5"/>
                            <rect x="100" y="180" width="40" height="40" fill="rgba(255,255,255,0.2)" rx="3"/>
                            <rect x="220" y="160" width="30" height="30" fill="rgba(255,255,255,0.2)" rx="3"/>
                            <rect x="260" y="200" width="40" height="40" fill="rgba(255,255,255,0.15)" rx="3"/>
                            <circle cx="200" cy="80" r="30" fill="rgba(255,255,255,0.1)"/>
                            <path d="M170 80 L200 30 L230 80 Z" fill="rgba(255,255,255,0.08)"/>
                        </svg>
                    </div>
                    <div class="about-badge">
                        <span class="about-badge-number"><?php echo $rto ? 'RTO' : ''; ?></span>
                        <span class="about-badge-text"><?php echo $rto ? esc_html($rto) : 'Registered'; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

// Render featured courses section
function fusion_college_featured_courses($limit = 3) {
    $courses_url = get_permalink(get_page_by_path('courses'));
    if (!$courses_url) $courses_url = home_url('/courses/');

    $args = array(
        'post_type' => 'course',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);
    ?>
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Our Courses</span>
                <h2 class="section-title">Popular Programs</h2>
                <p class="section-subtitle">Explore our range of nationally recognized qualifications designed to help you achieve your career goals.</p>
            </div>
            <div class="courses-grid">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php get_template_part('templates/course-card'); ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                        <p style="color: var(--text-muted);">No courses available at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div style="text-align: center; margin-top: 50px;">
                <a href="<?php echo esc_url($courses_url); ?>" class="btn btn-primary">View All Courses</a>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
}

// Render why choose us section
function fusion_college_why_choose_us() {
    $college_name = fusion_college_college_name();
    ?>
    <section class="section section-alt">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Why Choose Us</span>
                <h2 class="section-title">The <?php echo esc_html($college_name); ?> Advantage</h2>
                <p class="section-subtitle">We are committed to providing the best possible education and support for our students.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-card fade-in">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px;">🎯</div>
                    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: var(--text-dark);">Industry-Relevant Training</h4>
                    <p style="color: var(--text-muted); line-height: 1.7;">Our courses are designed with industry input to ensure you learn the skills employers are looking for.</p>
                </div>
                <div class="stat-card fade-in">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px;">🤝</div>
                    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: var(--text-dark);">Personal Support</h4>
                    <p style="color: var(--text-muted); line-height: 1.7;">Our dedicated student support team is here to help you throughout your studies.</p>
                </div>
                <div class="stat-card fade-in">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--midnight) 0%, #1e3170 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px;">💼</div>
                    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: var(--text-dark);">Career Opportunities</h4>
                    <p style="color: var(--text-muted); line-height: 1.7;">We provide career guidance and connections to help you kickstart your career.</p>
                </div>
                <div class="stat-card fade-in">
                    <div style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 32px;">🌏</div>
                    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: var(--text-dark);">Diverse Community</h4>
                    <p style="color: var(--text-muted); line-height: 1.7;">Study alongside students from over 50 countries in a welcoming environment.</p>
                </div>
            </div>
        </div>
    </section>
    <?php
}

// Render upcoming events section
function fusion_college_upcoming_events($limit = 3) {
    $events_url = get_permalink(get_page_by_path('events'));
    if (!$events_url) $events_url = home_url('/events/');

    $today = date('Y-m-d');
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'meta_key' => '_event_start_date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => '_event_start_date',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
    ?>
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Events</span>
                <h2 class="section-title">Upcoming Events</h2>
                <p class="section-subtitle">Stay updated with our latest events, workshops, and activities.</p>
            </div>
            <div class="events-grid">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php get_template_part('templates/event-card'); ?>
                <?php endwhile; ?>
            </div>
            <div style="text-align: center; margin-top: 50px;">
                <a href="<?php echo esc_url($events_url); ?>" class="btn btn-primary">View All Events</a>
            </div>
        </div>
    </section>
    <?php
    endif;
    wp_reset_postdata();
}

// Render testimonials section
function fusion_college_testimonials_section() {
    $college_name = fusion_college_college_name();
    ?>
    <section class="section section-alt">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Testimonials</span>
                <h2 class="section-title">What Our Students Say</h2>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial-card">
                    <p class="testimonial-quote" id="testimonialQuote">"<?php echo esc_html($college_name); ?> provided me with the skills and confidence I needed to launch my career. The hands-on training and supportive instructors made all the difference."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <svg viewBox="0 0 70 70" fill="none">
                                <circle cx="35" cy="25" r="12" fill="rgba(255,255,255,0.3)"/>
                                <path d="M10 65c0-15 10-25 25-25s25 10 25 25" fill="rgba(255,255,255,0.3)"/>
                            </svg>
                        </div>
                        <div class="testimonial-info">
                            <h4 id="testimonialName">Sarah Chen</h4>
                            <span id="testimonialRole">Diploma of IT Graduate</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-dots">
                    <span class="testimonial-dot active" data-index="0"></span>
                    <span class="testimonial-dot" data-index="1"></span>
                    <span class="testimonial-dot" data-index="2"></span>
                </div>
            </div>
        </div>
    </section>
    <?php
}

// Render course card template
function fusion_college_render_course_card($post = null) {
    if (!$post) $post = get_post();
    setup_postdata($post);

    $duration = get_post_meta($post->ID, '_course_duration', true);
    $category = '';
    $terms = get_the_terms($post->ID, 'course_category');
    if ($terms && !is_wp_error($terms)) {
        $category = $terms[0]->name;
    }
    ?>
    <div class="course-card fade-in">
        <div class="course-image">
            <?php if (has_post_thumbnail()) : ?>
                <div class="course-image-bg" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post->ID, 'course-thumb')); ?>'); background-size: cover; background-position: center;"></div>
            <?php else : ?>
                <div class="course-image-bg" style="background: linear-gradient(135deg, #077E86 0%, #2A7970 100%); display: flex; align-items: center; justify-content: center;">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
            <?php endif; ?>
            <?php if ($category) : ?>
                <span class="course-category"><?php echo esc_html($category); ?></span>
            <?php endif; ?>
        </div>
        <div class="course-content">
            <h3 class="course-title"><?php the_title(); ?></h3>
            <p class="course-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
            <div class="course-meta">
                <?php if ($duration) : ?>
                    <span class="course-duration">📅 <?php echo esc_html($duration); ?> Weeks</span>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-small">View Details</a>
            </div>
        </div>
    </div>
    <?php
    wp_reset_postdata();
}
