<?php
/**
 * Single Event Template
 */

get_header();

while (have_posts()) : the_post();

$start_date = get_post_meta(get_the_ID(), '_event_start_date', true);
$end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
$location = get_post_meta(get_the_ID(), '_event_location', true);
$organizer = function_exists('get_field') ? get_field('event_organizer') : '';
$registration_url = function_exists('get_field') ? get_field('event_registration_url') : '';
$capacity = function_exists('get_field') ? get_field('event_capacity') : '';

$category = '';
$terms = get_the_terms(get_the_ID(), 'event_category');
if ($terms && !is_wp_error($terms)) {
    $category = $terms[0]->name;
}

$day = $start_date ? date('d', strtotime($start_date)) : '';
$month = $start_date ? date('M', strtotime($start_date)) : '';
$year = $start_date ? date('Y', strtotime($start_date)) : '';
$formatted_start = $start_date ? date('F d, Y', strtotime($start_date)) : '';
$formatted_end = $end_date ? date('F d, Y', strtotime($end_date)) : '';
?>

<!-- Page Banner -->
<?php fusion_college_page_banner(
    get_the_title(),
    $formatted_start . ($location ? ' | ' . $location : ''),
    array(
        array('label' => 'Events', 'url' => get_post_type_archive_link('event')),
        array('label' => get_the_title()),
    )
); ?>

<!-- Event Detail Section -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 50px;">
            <!-- Main Content -->
            <div>
                <div class="fade-in">
                    <div class="rich-content" style="font-size: 16px; color: var(--text-muted); line-height: 1.8; margin-bottom: 30px;">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <div style="background: var(--card-bg); border-radius: 16px; padding: 30px; box-shadow: 0 10px 40px var(--shadow); border: 1px solid var(--border-color); position: sticky; top: 100px;" class="fade-in">
                    <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 25px; color: var(--text-dark);">Event Details</h3>

                    <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                        <?php if ($day && $month) : ?>
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                            <div style="background: var(--primary); color: white; padding: 15px; border-radius: 10px; text-align: center; min-width: 70px;">
                                <span style="font-size: 28px; font-weight: 700; display: block;"><?php echo esc_html($day); ?></span>
                                <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;"><?php echo esc_html($month); ?></span>
                            </div>
                            <div>
                                <span style="color: var(--text-muted); font-size: 14px;">Date</span>
                                <p style="color: var(--text-dark); font-weight: 600; margin: 0;"><?php echo esc_html($formatted_start); ?></p>
                                <?php if ($end_date && $end_date !== $start_date) : ?>
                                    <p style="color: var(--text-muted); font-size: 13px; margin: 0;">to <?php echo esc_html($formatted_end); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($location) : ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: var(--text-muted); font-size: 14px;">Location</span>
                            <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($location); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($category) : ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: var(--text-muted); font-size: 14px;">Category</span>
                            <span style="color: var(--primary); font-weight: 600; font-size: 14px;"><?php echo esc_html(ucfirst(str_replace('-', ' ', $category))); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($organizer) : ?>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <span style="color: var(--text-muted); font-size: 14px;">Organizer</span>
                            <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($organizer); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ($capacity) : ?>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: var(--text-muted); font-size: 14px;">Capacity</span>
                            <span style="color: var(--text-dark); font-weight: 600; font-size: 14px;"><?php echo esc_html($capacity); ?> people</span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($registration_url) : ?>
                        <a href="<?php echo esc_url($registration_url); ?>" class="btn btn-primary" style="width: 100%; text-align: center; margin-bottom: 15px;">Register Now</a>
                    <?php endif; ?>
                    <a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn-outline" style="width: 100%; text-align: center; border: 2px solid var(--primary); color: var(--primary);">View All Events</a>

                    <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                        <h4 style="font-size: 14px; font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">Need Help?</h4>
                        <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 15px;">Contact our events team</p>
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
