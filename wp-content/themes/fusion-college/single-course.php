<?php
/**
 * Single Course Template
 */

get_header();

while (have_posts()) : the_post();

$duration = get_post_meta(get_the_ID(), '_course_duration', true);
$fee = get_post_meta(get_the_ID(), '_course_fee', true);
$material_fee = get_post_meta(get_the_ID(), '_course_material_fee', true);
$application_fee = get_post_meta(get_the_ID(), '_course_application_fee', true);
$cricos = get_post_meta(get_the_ID(), '_course_cricos_code', true);
$study_mode = get_post_meta(get_the_ID(), '_course_study_mode', true);
$intake = get_post_meta(get_the_ID(), '_course_intake_months', true);
$location = get_post_meta(get_the_ID(), '_course_location', true);
$location_address = get_post_meta(get_the_ID(), '_course_location_address', true);
$delivery = get_post_meta(get_the_ID(), '_course_delivery', true);

$category = '';
$terms = get_the_terms(get_the_ID(), 'course_category');
if ($terms && !is_wp_error($terms)) {
    $category = $terms[0]->name;
}
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    get_the_title(),
    ($category ? strtoupper($category) : 'Nationally Recognized') . ($cricos ? ' | CRICOS: ' . $cricos : ''),
    array(
        array('label' => 'Courses', 'url' => get_post_type_archive_link('course')),
        array('label' => get_the_title()),
    )
); ?>

<!-- Course Detail Section -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 50px;">
            <!-- Main Content -->
            <div>
                <!-- Tabs -->
                <div class="course-tabs-wrapper fade-in">
                    <div class="course-tabs">
                        <button class="course-tab active" data-tab="overview">Course Overview</button>
                        <button class="course-tab" data-tab="entry">Entry Requirements</button>
                        <button class="course-tab" data-tab="dates">Dates and Fees</button>
                        <button class="course-tab" data-tab="apply">Apply Now</button>
                        <button class="course-tab" data-tab="delivery">Duration & Delivery</button>
                    </div>
                    
                    <div class="course-tab-content">
                        <div id="overview" class="tab-pane active">
                            <?php 
                            $featured_image = get_post_meta(get_the_ID(), '_course_featured_image', true);
                            if ($featured_image) : ?>
                            <div style="margin-bottom: 30px; border-radius: 12px; overflow: hidden;">
                                <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" style="width: 100%; height: auto; border-radius: 12px;">
                            </div>
                            <?php endif; ?>
                            <div class="rich-content" style="font-size: 16px; color: var(--text-muted); line-height: 1.8;">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        
                        <div id="entry" class="tab-pane">
                            <div style="background: var(--card-bg); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
                                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">International Students must:</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="padding: 10px 0; color: var(--text-muted); border-bottom: 1px solid var(--border-color);">be at least 18 years of age and have completed Year 12 or equivalent</li>
                                    <li style="padding: 10px 0; color: var(--text-muted); border-bottom: 1px solid var(--border-color);">participate in a course entry interview to determine suitability for the course and student needs</li>
                                    <li style="padding: 10px 0; color: var(--text-muted);">have an IELTS score of 6.0 (test results must be no more than 2 years old)</li>
                                </ul>
                                <p style="margin-top: 15px; color: var(--text-muted); font-size: 14px;">Student must bring their laptop or compatible devices for classroom use.</p>
                            </div>
                        </div>
                        
                        <div id="dates" class="tab-pane">
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Intake Months each year</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 25px;">
                                <?php 
                                if ($intake) {
                                    $intake_months = explode(', ', $intake);
                                    foreach ($intake_months as $month) {
                                        echo '<span style="background: var(--primary); color: white; padding: 6px 14px; border-radius: 20px; font-size: 13px;">' . trim($month) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Course Fees and Payment</h4>
                            <div style="background: var(--card-bg); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
                                <?php if ($application_fee) : ?>
                                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--border-color);">
                                    <span style="color: var(--text-muted);">Enrolment Application Fee</span>
                                    <span style="color: var(--text-dark); font-weight: 600;"><?php echo number_format($application_fee, 0); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if ($fee) : ?>
                                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--border-color);">
                                    <span style="color: var(--text-muted);">Course Fee</span>
                                    <span style="color: var(--text-dark); font-weight: 600;"><?php echo number_format($fee, 0); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if ($material_fee) : ?>
                                <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                                    <span style="color: var(--text-muted);">Material Fee</span>
                                    <span style="color: var(--text-dark); font-weight: 600;"><?php echo number_format($material_fee, 0); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <div style="margin-top: 15px;">
                                <h5 style="font-size: 14px; font-weight: 600; margin-bottom: 10px; color: var(--text-dark);">Payment Option</h5>
                                <ul style="list-style: none; padding: 0; color: var(--text-muted); font-size: 14px;">
                                    <li>Credit Card</li>
                                    <li>Electronic Funds Transfer</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div id="apply" class="tab-pane">
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">How can I apply?</h4>
                            <div style="background: var(--card-bg); padding: 20px; border-radius: 12px; border: 1px solid var(--border-color); margin-bottom: 20px;">
                                <p style="color: var(--text-muted); font-size: 14px;">To apply for this course, you are required to complete an application for enrolment form and submit:</p>
                                <ul style="list-style: none; padding: 0; margin: 10px 0; color: var(--text-muted); font-size: 14px;">
                                    <li>- Copy of your passport</li>
                                    <li>- Academic certificate/s</li>
                                    <li>- Proof of English language proficiency</li>
                                </ul>
                            </div>
                            
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Offer and Enrolment Process</h4>
                            <div style="background: var(--card-bg); padding: 20px; border-radius: 12px; border: 1px solid var(--border-color);">
                                <p style="color: var(--text-muted); font-size: 14px;">If your application is successful, you will receive a <strong>Letter of Offer</strong>. If you are in agreement, sign and return to us and we will issue you with an invoice. Once we receive your first payment, we will issue your <strong>Confirmation of Enrolment (CoE)</strong>.</p>
                            </div>
                        </div>
                        
                        <div id="delivery" class="tab-pane">
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Course Duration</h4>
                            <div style="background: var(--card-bg); padding: 20px; border-radius: 12px; border: 1px solid var(--border-color); margin-bottom: 20px;">
                                <p style="color: var(--text-muted); font-size: 14px;">This qualification will be delivered over <?php echo $duration ? esc_html($duration) : '52'; ?> weeks.</p>
                            </div>
                            
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Course Delivery Mode</h4>
                            <div style="background: var(--card-bg); padding: 20px; border-radius: 12px; border: 1px solid var(--border-color); margin-bottom: 20px;">
                                <p style="color: var(--text-muted); font-size: 14px;">This program is delivered in the classroom.</p>
                                <?php if ($delivery) : ?>
                                <p style="color: var(--text-dark); font-weight: 600; margin-top: 10px;"><?php echo esc_html($delivery); ?></p>
                                <?php endif; ?>
                            </div>
                            
                            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Course Delivery Site</h4>
                            <div style="background: var(--card-bg); padding: 20px; border-radius: 12px; border: 1px solid var(--border-color);">
                                <p style="color: var(--text-muted); font-size: 14px;"><?php echo $location_address ? esc_html($location_address) : 'Level 5, 16-18 Wentworth Street, Parramatta NSW 2150'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.course-tab').forEach(function(tab) {
                        tab.addEventListener('click', function() {
                            document.querySelectorAll('.course-tab').forEach(function(t) {
                                t.classList.remove('active');
                            });
                            document.querySelectorAll('.tab-pane').forEach(function(p) {
                                p.classList.remove('active');
                            });
                            this.classList.add('active');
                            document.getElementById(this.dataset.tab).classList.add('active');
                        });
                    });
                });
                </script>
                
                <style>
                .course-tabs { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 25px; border-bottom: 2px solid var(--border-color); padding-bottom: 10px; }
                .course-tab { background: transparent; border: none; padding: 10px 18px; font-size: 14px; font-weight: 600; color: var(--text-muted); cursor: pointer; transition: all 0.3s; border-radius: 6px; }
                .course-tab:hover { color: var(--primary); }
                .course-tab.active { background: var(--primary); color: white; }
                .tab-pane { display: none; }
                .tab-pane.active { display: block; }
                </style>

                <!-- Course Gallery -->
                <?php
                if ($terms && !is_wp_error($terms)) {
                    $gallery_args = array(
                        'post_type' => 'gallery',
                        'posts_per_page' => 6,
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'gallery_category',
                                'field'    => 'slug',
                                'terms'    => $terms[0]->slug,
                            ),
                        ),
                    );
                    $gallery = new WP_Query($gallery_args);

                    if ($gallery->have_posts()) :
                ?>
                <section style="margin-top: 50px;">
                    <div class="section-header">
                        <h2 class="section-title">Course Gallery</h2>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                        <?php while ($gallery->have_posts()) : $gallery->the_post(); 
                            $gallery_image = get_post_meta(get_the_ID(), '_gallery_image_url', true);
                        ?>
                        <div class="fade-in" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                            <div style="aspect-ratio: 4/3; background-image: url('<?php echo esc_url($gallery_image); ?>'); background-size: cover; background-position: center;"></div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </section>
                <?php
                    endif;
                    wp_reset_postdata();
                }
                ?>

                <!-- Related Courses -->
                <?php
                if ($terms && !is_wp_error($terms)) {
                    $related_args = array(
                        'post_type' => 'course',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'course_category',
                                'field'    => 'term_id',
                                'terms'    => $terms[0]->term_id,
                            ),
                        ),
                    );
                    $related = new WP_Query($related_args);

                    if ($related->have_posts()) :
                ?>
                <section style="margin-top: 50px;">
                    <div class="section-header">
                        <h2 class="section-title">Related Courses</h2>
                    </div>
                    <div class="courses-grid">
                        <?php while ($related->have_posts()) : $related->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="course-card fade-in" style="display: block; text-decoration: none;">
                            <div class="course-image">
                                <?php 
                                $thumb = get_post_meta(get_the_ID(), '_course_featured_image', true);
                                if ($thumb) : ?>
                                <div class="course-image-bg" style="background-image: url('<?php echo esc_url($thumb); ?>'); background-size: cover; background-position: center;"></div>
                                <?php else : ?>
                                <div class="course-image-bg" style="background: linear-gradient(135deg, #077E86 0%, #2A7970 100%);"></div>
                                <?php endif; ?>
                            </div>
                            <div class="course-content">
                                <h3 class="course-title"><?php the_title(); ?></h3>
                                <div class="course-meta">
                                    <span class="course-duration">Duration <?php echo get_post_meta(get_the_ID(), '_course_duration', true); ?> Weeks</span>
                                </div>
                            </div>
                        </a>
                        <?php endwhile; ?>
                    </div>
                </section>
                <?php
                    endif;
                    wp_reset_postdata();
                }
                ?>
            </div>

            <!-- Sidebar -->
            <div>
                <div style="background: var(--card-bg); padding: 25px; border-radius: 12px; border: 1px solid var(--border-color); position: sticky; top: 100px;">
                    <?php if ($duration) : ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: var(--text-muted); font-size: 14px;">Duration</span>
                        <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($duration); ?> Weeks</span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($study_mode) : ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: var(--text-muted); font-size: 14px;">Study Mode</span>
                        <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($study_mode); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($intake) : ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: var(--text-muted); font-size: 14px;">Intake</span>
                        <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($intake); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($location) : ?>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: var(--text-muted); font-size: 14px;">Location</span>
                        <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($location); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($cricos) : ?>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: var(--text-muted); font-size: 14px;">CRICOS</span>
                        <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($cricos); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($application_fee > 0) : ?>
                    <div style="margin: 15px 0; padding-top: 15px; border-top: 1px solid var(--border-color);">
                        <span style="color: var(--text-muted); font-size: 14px;">Application Fee</span>
                        <div style="font-size: 20px; font-weight: 700; color: var(--primary);"><?php echo number_format($application_fee, 0); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($fee > 0) : ?>
                    <div style="margin: 15px 0;">
                        <span style="color: var(--text-muted); font-size: 14px;">Course Fee</span>
                        <div style="font-size: 20px; font-weight: 700; color: var(--primary);"><?php echo number_format($fee, 0); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($material_fee > 0) : ?>
                    <div style="margin: 15px 0;">
                        <span style="color: var(--text-muted); font-size: 14px;">Material Fee</span>
                        <div style="font-size: 20px; font-weight: 700; color: var(--primary);"><?php echo number_format($material_fee, 0); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php $apply_page = get_page_by_path('apply'); ?>
                    <a href="<?php echo $apply_page ? esc_url(get_permalink($apply_page->ID)) : '#'; ?>" class="btn btn-primary" style="width: 100%; text-align: center;">Apply Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>
<?php get_footer(); ?>