<?php get_header(); ?>

<main>
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-slider">
            <div class="hero-slide hero-slide-1 active">
                <div class="hero-slide-bg" style="background: linear-gradient(135deg, #077E86 0%, #2A7970 50%, #077E86 100%);"></div>
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-slide hero-slide-2">
                <div class="hero-slide-bg" style="background: linear-gradient(135deg, #172566 0%, #1e3170 50%, #172566 100%);"></div>
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-slide hero-slide-3">
                <div class="hero-slide-bg" style="background: linear-gradient(135deg, #077E86 0%, #172566 50%, #2A7970 100%);"></div>
                <div class="hero-overlay"></div>
            </div>
        </div>

        <div class="hero-content">
            <span class="hero-badge">RTO: <?php echo esc_html(get_college_setting('rto_number', '45123')); ?> | CRICOS: <?php echo esc_html(get_college_setting('cricos_code', '03456J')); ?></span>
            <h1 class="hero-title"><?php echo esc_html(get_college_setting('hero_title', 'Empowering Future Professionals Through Quality Education')); ?></h1>
            <p class="hero-subtitle"><?php echo esc_html(get_college_setting('hero_subtitle', 'Join Australia\'s leading vocational education provider')); ?></p>
            <div class="hero-buttons">
                <a href="<?php echo home_url('/admissions'); ?>" class="btn btn-primary">Apply Now</a>
                <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-outline">Explore Courses</a>
            </div>
        </div>

        <div class="hero-indicators">
            <div class="hero-indicator active" data-slide="0"></div>
            <div class="hero-indicator" data-slide="1"></div>
            <div class="hero-indicator" data-slide="2"></div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" id="about">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <span class="section-badge">About Us</span>
                    <h3><?php echo esc_html(get_college_setting('college_name', 'Fusion College')); ?> - Building Careers Since 2005</h3>
                    <p><?php echo esc_html(get_college_setting('about_description', 'We are a leading registered training organisation committed to delivering high-quality vocational education.')); ?></p>
                    <div class="about-features">
                        <div class="about-feature"><div class="about-feature-icon">✓</div><span>Industry-Recognized Qualifications</span></div>
                        <div class="about-feature"><div class="about-feature-icon">✓</div><span>Experienced Trainers</span></div>
                        <div class="about-feature"><div class="about-feature-icon">✓</div><span>Modern Facilities</span></div>
                        <div class="about-feature"><div class="about-feature-icon">✓</div><span>Career Support</span></div>
                    </div>
                </div>
                <div class="about-image">
                    <div class="about-image-main" style="background: linear-gradient(135deg, #077E86, #2A7970);"></div>
                    <div class="about-badge"><span class="about-badge-number">19+</span><span class="about-badge-text">Years</span></div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card"><div class="stat-icon">🎓</div><div class="stat-number" data-target="5000">0</div><div class="stat-label">Graduates</div></div>
                <div class="stat-card"><div class="stat-icon">📚</div><div class="stat-number" data-target="45">0</div><div class="stat-label">Courses</div></div>
                <div class="stat-card"><div class="stat-icon">👨‍🏫</div><div class="stat-number" data-target="120">0</div><div class="stat-label">Trainers</div></div>
                <div class="stat-card"><div class="stat-icon">🌍</div><div class="stat-number" data-target="50">0</div><div class="stat-label">Countries</div></div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="section section-alt" id="courses">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Our Programs</span>
                <h2 class="section-title">Popular Courses</h2>
            </div>
            <div class="courses-grid">
                <?php
                $courses = new WP_Query(array('post_type' => 'course', 'posts_per_page' => 6, 'post_status' => 'publish'));
                if ($courses->have_posts()) {
                    while ($courses->have_posts()) {
                        $courses->the_post();
                        echo '<div class="course-card">';
                        echo '<div class="course-image"><div class="course-image-bg" style="background: linear-gradient(135deg, #077E86, #2A7970);"></div>';
                        $terms = get_the_terms(get_the_ID(), 'course_category');
                        if ($terms) echo '<span class="course-category">'.$terms[0]->name.'</span>';
                        echo '</div>';
                        echo '<div class="course-content">';
                        echo '<h3 class="course-title">'.get_the_title().'</h3>';
                        echo '<p class="course-description">'.get_the_excerpt().'</p>';
                        echo '<div class="course-meta"><span class="course-duration">⏱️ 12 Months</span>';
                        echo '<a href="'.get_permalink().'" class="btn btn-primary btn-small">View Details</a></div>';
                        echo '</div></div>';
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p style="grid-column:1/-1;text-align:center;">No courses available.</p>';
                }
                ?>
            </div>
            <div style="text-align:center;margin-top:50px;">
                <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-primary">View All Courses</a>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="section section-alt" id="events">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Stay Connected</span>
                <h2 class="section-title">Upcoming Events</h2>
            </div>
            <div class="events-grid">
                <div class="event-card">
                    <div class="event-image"><div style="background: linear-gradient(135deg, #077E86, #2A7970);height:160px;"></div>
                    <div class="event-date"><span class="event-day">15</span><span class="event-month">Mar</span></div></div>
                    <div class="event-content"><span class="event-category">Open Day</span><h3 class="event-title">Campus Open Day</h3><p class="event-location">📍 Main Campus</p></div>
                </div>
                <div class="event-card">
                    <div class="event-image"><div style="background: linear-gradient(135deg, #7c3aed, #5b21b6);height:160px;"></div>
                    <div class="event-date"><span class="event-day">22</span><span class="event-month">Mar</span></div></div>
                    <div class="event-content"><span class="event-category">Workshop</span><h3 class="event-title">Career Workshop</h3><p class="event-location">📍 Room B204</p></div>
                </div>
                <div class="event-card">
                    <div class="event-image"><div style="background: linear-gradient(135deg, #059669, #047857);height:160px;"></div>
                    <div class="event-date"><span class="event-day">10</span><span class="event-month">Apr</span></div></div>
                    <div class="event-content"><span class="event-category">Graduation</span><h3 class="event-title">Graduation 2024</h3><p class="event-location">📍 Convention Centre</p></div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Start Your Journey?</h2>
                <p class="cta-subtitle">Apply now and join thousands of successful graduates.</p>
                <div style="display:flex;gap:15px;justify-content:center;">
                    <a href="<?php echo home_url('/admissions'); ?>" class="btn btn-primary">Apply Now</a>
                    <a href="<?php echo home_url('/contact'); ?>" class="btn btn-outline">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
:root{--primary:#077E86;--primary-light:#2A7970;--secondary:#CF5E1C;--accent:#FD6406;--midnight:#172566;--bg-light:#fff;--bg-section:#f8f9fa;--text-dark:#1a1a1a;--text-muted:#6b7280;--card-bg:#fff;--border-color:#e5e7eb;--shadow:rgba(0,0,0,0.1)}
*{margin:0;padding:0;box-sizing:border-box}
body{background:var(--bg-light);color:var(--text-dark)}
.hero{position:relative;height:100vh;overflow:hidden}
.hero-slider{position:relative;height:100%}
.hero-slide{position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;transition:opacity 1s}
.hero-slide.active{opacity:1}
.hero-slide-bg{position:absolute;top:0;left:0;width:100%;height:100%;background-size:cover}
.hero-overlay{position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.4)}
.hero-content{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:#fff;width:90%;z-index:10}
.hero-badge{display:inline-block;background:var(--secondary);color:var(--primary);padding:8px 20px;border-radius:30px;font-size:13px;font-weight:600;margin-bottom:20px}
.hero-title{font-size:52px;font-weight:700;margin-bottom:20px;text-shadow:2px 4px 20px rgba(0,0,0,0.3)}
.hero-subtitle{font-size:20px;margin-bottom:35px}
.hero-buttons{display:flex;gap:15px;justify-content:center}
.hero-indicators{position:absolute;bottom:40px;left:50%;transform:translateX(-50%);display:flex;gap:12px}
.hero-indicator{width:12px;height:12px;border-radius:50%;background:rgba(255,255,255,0.4);cursor:pointer}
.hero-indicator.active{background:var(--secondary);width:35px;border-radius:6px}
.btn{display:inline-block;padding:16px 35px;border-radius:8px;font-size:15px;font-weight:600;text-decoration:none;transition:all 0.3s;border:none;cursor:pointer}
.btn-primary{background:var(--secondary);color:var(--primary)}
.btn-primary:hover{background:var(--accent);transform:translateY(-3px)}
.btn-outline{background:transparent;color:#fff;border:2px solid #fff}
.btn-outline:hover{background:#fff;color:var(--primary);transform:translateY(-3px)}
.btn-small{padding:10px 20px;font-size:13px}
.section{padding:100px 0}
.section-alt{background:var(--bg-section)}
.container{max-width:1200px;margin:0 auto;padding:0 20px}
.section-header{text-align:center;margin-bottom:60px}
.section-badge{display:inline-block;background:linear-gradient(135deg,var(--primary),var(--primary-light));color:#fff;padding:6px 18px;border-radius:20px;font-size:12px;font-weight:600;text-transform:uppercase;margin-bottom:15px}
.section-title{font-size:40px;font-weight:700;margin-bottom:15px}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;margin-bottom:60px}
.about-content h3{font-size:32px;font-weight:700;margin-bottom:20px}
.about-content p{color:var(--text-muted);font-size:16px;line-height:1.8;margin-bottom:25px}
.about-features{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:30px}
.about-feature{display:flex;align-items:center;gap:12px}
.about-feature-icon{width:40px;height:40px;background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff}
.about-image{position:relative}
.about-image-main{width:100%;height:450px;border-radius:20px}
.about-badge{position:absolute;bottom:30px;right:30px;background:var(--secondary);color:var(--primary);padding:20px 25px;border-radius:12px;text-align:center}
.about-badge-number{font-size:36px;font-weight:700;display:block}
.about-badge-text{font-size:12px;text-transform:uppercase}
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:30px;margin-top:60px}
.stat-card{background:var(--card-bg);padding:35px 25px;border-radius:16px;text-align:center;box-shadow:0 10px 40px var(--shadow);border:1px solid var(--border-color)}
.stat-card:hover{transform:translateY(-10px)}
.stat-icon{width:60px;height:60px;background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:24px;color:#fff}
.stat-number{font-size:42px;font-weight:700;color:var(--primary);margin-bottom:8px}
.stat-label{font-size:14px;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px}
.courses-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:30px}
.course-card{background:var(--card-bg);border-radius:16px;overflow:hidden;box-shadow:0 10px 40px var(--shadow);border:1px solid var(--border-color)}
.course-card:hover{transform:translateY(-10px)}
.course-image{height:180px;position:relative}
.course-image-bg{width:100%;height:100%}
.course-category{position:absolute;top:15px;left:15px;background:var(--secondary);color:var(--primary);padding:6px 14px;border-radius:20px;font-size:11px;font-weight:600;text-transform:uppercase}
.course-content{padding:25px}
.course-title{font-size:20px;font-weight:700;margin-bottom:12px}
.course-description{font-size:14px;color:var(--text-muted);margin-bottom:20px}
.course-meta{display:flex;justify-content:space-between;align-items:center;padding-top:20px;border-top:1px solid var(--border-color)}
.course-duration{font-size:13px;color:var(--text-muted)}
.events-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:30px}
.event-card{background:var(--card-bg);border-radius:16px;overflow:hidden;box-shadow:0 10px 40px var(--shadow);border:1px solid var(--border-color)}
.event-image{height:160px;position:relative}
.event-date{position:absolute;top:15px;right:15px;background:var(--primary);color:#fff;padding:12px 15px;border-radius:10px;text-align:center}
.event-day{font-size:24px;font-weight:700;display:block}
.event-month{font-size:11px;text-transform:uppercase}
.event-content{padding:25px}
.event-category{display:inline-block;background:var(--bg-section);color:var(--primary);padding:5px 12px;border-radius:15px;font-size:11px;font-weight:600;margin-bottom:12px}
.event-title{font-size:18px;font-weight:700;margin-bottom:10px}
.event-location{font-size:13px;color:var(--text-muted)}
.cta-section{background:linear-gradient(135deg,var(--primary),#0f172a);padding:100px 0;position:relative}
.cta-content{text-align:center;color:#fff;position:relative;z-index:1}
.cta-title{font-size:44px;font-weight:700;margin-bottom:20px}
.cta-subtitle{font-size:18px;opacity:0.9;margin-bottom:35px}
@media (max-width:1024px){.about-grid{grid-template-columns:1fr}.courses-grid,.events-grid{grid-template-columns:repeat(2,1fr)}.stats-grid{grid-template-columns:repeat(2,1fr)}.hero-title{font-size:36px}}
@media (max-width:768px){.hero-title{font-size:28px}.section{padding:60px 0}.section-title{font-size:28px}.courses-grid,.events-grid{grid-template-columns:1fr}.stats-grid{grid-template-columns:1fr 1fr}.cta-title{font-size:28px}}
</style>

<script>
const heroSlides=document.querySelectorAll('.hero-slide'),heroIndicators=document.querySelectorAll('.hero-indicator');
let cs=0;
function ss(i){heroSlides.forEach((s,j)=>s.classList.toggle('active',j===i));heroIndicators.forEach((d,j)=>d.classList.toggle('active',j===i));cs=i}
setInterval(()=>{if(heroSlides.length>0){cs=(cs+1)%heroSlides.length;ss(cs)}},5000);
heroIndicators.forEach(i=>i.addEventListener('click',()=>ss(parseInt(i.dataset.slide))));
const fe=document.querySelectorAll('.fade-in, .stat-card, .course-card, .event-card');
const ob=new IntersectionObserver(e=>e.forEach(en=>{if(en.isIntersecting)en.target.classList.add('visible')}),{threshold:0.1});
fe.forEach(el=>ob.observe(el));
const sn=document.querySelectorAll('.stat-number[data-target]');
const so=new IntersectionObserver(e=>{e.forEach(en=>{if(en.isIntersecting){let t=parseInt(en.target.dataset.target),c=0,i=t/50,s=setInterval(()=>{c+=i;if(c>=t){en.target.textContent=t;clearInterval(s)}else en.target.textContent=Math.floor(c)},30)}so.unobserve(en.target)})},{threshold:0.5});
sn.forEach(el=>so.observe(el));
window.addEventListener('scroll',()=>{document.querySelector('.main-header').classList.toggle('scrolled',window.scrollY>80)});
</script>

<?php get_footer(); ?>
