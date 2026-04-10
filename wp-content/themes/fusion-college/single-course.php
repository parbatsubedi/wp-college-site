<?php
/**
 * Single Course Template
 */

get_header();

while (have_posts()) : the_post();

$duration = get_post_meta(get_the_ID(), '_course_duration', true);
$fee = get_post_meta(get_the_ID(), '_course_fee', true);
$cricos = get_post_meta(get_the_ID(), '_course_cricos_code', true);
$study_mode = get_post_meta(get_the_ID(), '_course_study_mode', true);
$intake = get_post_meta(get_the_ID(), '_course_intake_months', true);
$location = get_post_meta(get_the_ID(), '_course_location', true);

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
                <div class="fade-in">
                    <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 20px; color: var(--text-dark);">Course Overview</h2>
                    <div class="rich-content" style="font-size: 16px; color: var(--text-muted); line-height: 1.8; margin-bottom: 30px;">
                        <?php the_content(); ?>
                    </div>
                </div>

                <?php
                // Check for additional content sections (using ACF flexible content or page builder)
                if (function_exists('get_field') && have_rows('course_sections')) :
                    while (have_rows('course_sections')) : the_row();
                        if (get_row_layout() == 'content_section') :
                ?>
                <div class="fade-in" style="margin-top: 40px;">
                    <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 20px; color: var(--text-dark);"><?php echo esc_html(get_sub_field('section_title')); ?></h3>
                    <div class="rich-content">
                        <?php echo apply_filters('the_content', get_sub_field('section_content')); ?>
                    </div>
                </div>
                <?php
                        endif;
                    endwhile;
                endif;
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
                <section class="section section-alt" style="margin-top: 60px; margin-left: -50px; margin-right: -50px; padding: 80px 50px;">
                    <div class="section-header">
                        <h2 class="section-title">Related Courses</h2>
                    </div>
                    <div class="courses-grid">
                        <?php while ($related->have_posts()) : $related->the_post(); ?>
                            <?php get_template_part('templates/course-card'); ?>
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
                <div style="background: var(--card-bg); border-radius: 16px; padding: 30px; box-shadow: 0 10px 40px var(--shadow); border: 1px solid var(--border-color); position: sticky; top: 100px;" class="fade-in">
                    <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 25px; color: var(--text-dark);">Quick Facts</h3>

                    <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                        <?php if ($duration) : ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: var(--text-muted); font-size: 14px;">Duration</span>
                            <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($duration); ?> Weeks</span>
                        </div>
                        <?php endif; ?>
                        <?php if ($study_mode) : ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: var(--text-muted); font-size: 14px;">Study Mode</span>
                            <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($study_mode); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if ($intake) : ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: var(--text-muted); font-size: 14px;">Intake</span>
                            <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($intake); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if ($location) : ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
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
                    </div>

                    <?php if ($fee > 0) : ?>
                    <div style="margin-bottom: 25px;">
                        <span style="color: var(--text-muted); font-size: 14px; display: block; margin-bottom: 8px;">Tuition Fee</span>
                        <span style="font-size: 32px; font-weight: 700; color: var(--primary);">$<?php echo number_format($fee, 0); ?></span>
                        <span style="color: var(--text-muted); font-size: 14px;">per year</span>
                    </div>
                    <?php endif; ?>

                    <?php $admissions_page = get_page_by_path('admissions'); ?>
                    <?php $contact_page = get_page_by_path('contact'); ?>
                    <a href="<?php echo $admissions_page ? esc_url(get_permalink($admissions_page->ID)) : '#'; ?>" class="btn btn-primary" style="width: 100%; text-align: center; margin-bottom: 15px;">Apply Now</a>
                    <a href="<?php echo $contact_page ? esc_url(get_permalink($contact_page->ID)) : '#'; ?>" class="btn btn-outline" style="width: 100%; text-align: center; border: 2px solid var(--primary); color: var(--primary);">Enquire Now</a>

                    <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                        <h4 style="font-size: 14px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Need Help?</h4>
                        <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 15px;">Speak to our course advisors</p>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span>📞</span>
                            <span style="color: var(--text-dark); font-weight: 600;"><?php echo esc_html(fusion_college_phone()); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endwhile; ?>
<?php get_footer(); ?>
