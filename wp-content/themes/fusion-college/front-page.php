<?php
/**
 * Template Name: Front Page
 * The main front page template - using fusioncollege.edu.au images
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-slider">
        <div class="hero-slide hero-slide-1 active">
            <div class="hero-slide-bg" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/slider-1.jpg'); background-size: cover; background-position: center;"></div>
            <div class="hero-slide-overlay"></div>
        </div>
        <div class="hero-slide hero-slide-2">
            <div class="hero-slide-bg" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/slider-3.jpg'); background-size: cover; background-position: center;"></div>
            <div class="hero-slide-overlay"></div>
        </div>
        <div class="hero-slide hero-slide-3">
            <div class="hero-slide-bg" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/hospitality-scaled.jpg'); background-size: cover; background-position: center;"></div>
            <div class="hero-slide-overlay"></div>
        </div>
    </div>
    <div class="hero-content">
        <span class="hero-badge">Our Experts / Instruction for Your Bright Future</span>
        <h1 class="hero-title">Quality Education and Training in a Favourable Environment</h1>
        <p class="hero-subtitle">Located in Your Dream City Sydney</p>
        <div class="hero-buttons">
            <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-primary">Explore Courses</a>
            <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn btn-outline">Enquire Now</a>
        </div>
    </div>
    <div class="hero-graphics">
        <svg class="building-silhouette" width="1920" height="200" viewBox="0 0 1920 200" preserveAspectRatio="none">
            <path d="M0,200 L0,150 L100,150 L100,120 L150,120 L150,150 L200,150 L200,100 L250,100 L250,150 L350,150 L350,80 L400,80 L400,150 L500,150 L500,60 L550,60 L550,150 L650,150 L650,90 L700,90 L700,150 L800,150 L800,110 L850,110 L850,150 L950,150 L950,70 L1000,70 L1000,150 L1100,150 L1100,100 L1150,100 L1150,150 L1250,150 L1250,85 L1300,85 L1300,150 L1400,150 L1400,120 L1450,120 L1450,150 L1550,150 L1550,95 L1600,95 L1600,150 L1700,150 L1700,110 L1750,110 L1750,150 L1850,150 L1850,130 L1900,130 L1900,150 L1920,150 L1920,200 Z" fill="rgba(255,255,255,0.1)"/>
        </svg>
    </div>
    <div class="hero-indicators">
        <span class="hero-indicator active" data-slide="0"></span>
        <span class="hero-indicator" data-slide="1"></span>
        <span class="hero-indicator" data-slide="2"></span>
    </div>
</section>

<!-- Stats Section -->
<section class="section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></div>
                <div class="stat-number" data-target="5000">5000</div>
                <div class="stat-label">Graduates</div>
            </div>
            <div class="stat-card fade-in">
                <div class="stat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></div>
                <div class="stat-number" data-target="45">45</div>
                <div class="stat-label">Courses Offered</div>
            </div>
            <div class="stat-card fade-in">
                <div class="stat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg></div>
                <div class="stat-number" data-target="120">120</div>
                <div class="stat-label">Expert Trainers</div>
            </div>
            <div class="stat-card fade-in">
                <div class="stat-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg></div>
                <div class="stat-number" data-target="50">50</div>
                <div class="stat-label">Partner Countries</div>
            </div>
        </div>


    </div>
</section>

<!-- About Section -->
<section class="section section-alt" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-content fade-in">
                <h3>About Fusion College of Technology</h3>
                <p>We are a leading educational institution dedicated to providing high-quality training and education to students from around the world. Our modern facilities, experienced trainers, and industry-focused curriculum ensure graduates are ready for the workforce.</p>
                <p>At Fusion College of Technology, we believe in practical learning that prepares you for real-world challenges. Our courses are designed in consultation with industry partners to ensure relevance and employment outcomes.</p>
                <div class="about-features">
                    <div class="about-feature">
                        <div class="about-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Nationally Recognized Qualifications</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Industry-Experienced Trainers</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Modern Campus Facilities</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Career Support Services</span>
                    </div>
                </div>
            </div>
            <div class="about-image fade-in">
                <div class="about-image-main" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/about_img-1.png'); background-size: cover; background-position: center; border-radius: 20px; overflow: hidden;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Explore Courses Section -->
<?php
$courses_query = new WP_Query(array(
    'post_type' => 'course',
    'posts_per_page' => 5,
    'post_status' => 'publish',
    'orderby' => 'rand',
));
?>
<section class="section section-alt" id="courses">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-badge">Explore Courses</span>
            <h2 class="section-title">Learning Courses</h2>
        </div>

        <div class="courses-grid">
            <?php if ($courses_query->have_posts()) : ?>
                <?php while ($courses_query->have_posts()) : $courses_query->the_post(); ?>
                    <?php
                    $duration = get_post_meta(get_the_ID(), '_course_duration', true);
                    $terms = get_the_terms(get_the_ID(), 'course_category');
                    $cat = $terms && !is_wp_error($terms) ? $terms[0]->name : 'Course';
                    $thumb_url = get_post_meta(get_the_ID(), '_course_featured_image', true);
                    if (!$thumb_url) {
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'course-thumb');
                    }
                    ?>
                    <div class="course-card fade-in">
                        <div class="course-image">
                            <?php if ($thumb_url) : ?>
                                <div class="course-image-bg" style="background-image: url('<?php echo esc_url($thumb_url); ?>'); background-size: cover; background-position: center;"></div>
                            <?php else : ?>
                                <div class="course-image-bg" style="background: linear-gradient(135deg, #077E86 0%, #2A7970 100%); display: flex; align-items: center; justify-content: center;">
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
                                        <path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4"/>
                                        <path d="M3 9h18M3 15h18"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <span class="course-category"><?php echo esc_html($cat); ?></span>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title"><?php the_title(); ?></h3>
                            <div class="course-meta">
                                <?php if ($duration) : ?>
                                    <span class="course-duration"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Duration <?php echo esc_html($duration); ?> Weeks</span>
                                <?php endif; ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-small" style="margin-top: 10px;">View Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                    <p>No courses available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-top: 50px;" class="fade-in">
            <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-primary">View All Courses</a>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>

<!-- Campus Life Section -->
<section class="section" id="campus">
    <div class="container">
        <div class="section-header fade-in">
            <span class="section-badge">Student Experience</span>
            <h2 class="section-title">Campus Life</h2>
            <p class="section-subtitle">Experience vibrant campus culture with modern facilities, diverse activities, and a supportive community.</p>
        </div>

        <div class="campus-gallery">
            <div class="gallery-item fade-in">
                <div class="gallery-image" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/slider-1.jpg'); background-size: cover; background-position: center;"></div>
            </div>
            <div class="gallery-item fade-in">
                <div class="gallery-image" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/hospitality-scaled.jpg'); background-size: cover; background-position: center;"></div>
            </div>
            <div class="gallery-item fade-in">
                <div class="gallery-image" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/slider-3.jpg'); background-size: cover; background-position: center;"></div>
            </div>
            <div class="gallery-item fade-in">
                <div class="gallery-image" style="background-image: url('https://fusioncollege.edu.au/wp-content/uploads/2023/02/IMG_9091-scaled-e1742476562820.jpeg'); background-size: cover; background-position: center;"></div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events Section -->
<?php fusion_college_upcoming_events(3); ?>

<!-- Testimonials Section -->
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Testimonials</span>
            <h2 class="section-title">What Our Students Say</h2>
        </div>

        <div class="testimonial-slides">
            <!-- Testimonial 1 -->
            <div class="testimonial-card active">
                <p class="testimonial-quote">"Fusion College provided me with the skills and confidence I needed to launch my career. The hands-on training and supportive instructors made all the difference."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <svg viewBox="0 0 70 70" fill="none">
                            <circle cx="35" cy="25" r="12" fill="rgba(255,255,255,0.3)"/>
                            <path d="M10 65c0-15 10-25 25-25s25 10 25 25" fill="rgba(255,255,255,0.3)"/>
                        </svg>
                    </div>
                    <div class="testimonial-info">
                        <h4>Sarah Chen</h4>
                        <span>Diploma of IT Graduate</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-card">
                <p class="testimonial-quote">"The practical skills I learned helped me secure a job within months of graduating. The campus facilities are excellent and the staff are very supportive."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <svg viewBox="0 0 70 70" fill="none">
                            <circle cx="35" cy="25" r="12" fill="rgba(255,255,255,0.3)"/>
                            <path d="M10 65c0-15 10-25 25-25s25 10 25 25" fill="rgba(255,255,255,0.3)"/>
                        </svg>
                    </div>
                    <div class="testimonial-info">
                        <h4>Michael Kumar</h4>
                        <span>Diploma of Business Graduate</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-card">
                <p class="testimonial-quote">"Excellent learning environment with industry-experienced trainers. I highly recommend Fusion College to anyone seeking quality education."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <svg viewBox="0 0 70 70" fill="none">
                            <circle cx="35" cy="25" r="12" fill="rgba(255,255,255,0.3)"/>
                            <path d="M10 65c0-15 10-25 25-25s25 10 25 25" fill="rgba(255,255,255,0.3)"/>
                        </svg>
                    </div>
                    <div class="testimonial-info">
                        <h4>Emma Wilson</h4>
                        <span>Certificate III in Carpentry Graduate</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial-dots">
            <span class="testimonial-dot active" data-index="0"></span>
            <span class="testimonial-dot" data-index="1"></span>
            <span class="testimonial-dot" data-index="2"></span>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Ready to Start Your Journey?</h2>
            <p class="cta-subtitle">Enroll now and take the first step towards your dream career. Our admissions team is here to help you.</p>
            <div class="hero-buttons">
                <a href="<?php echo get_permalink(get_page_by_path('apply')); ?>" class="btn btn-primary">Apply Now</a>
                <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn btn-outline">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>