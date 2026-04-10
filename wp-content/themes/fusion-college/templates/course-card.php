<?php
/**
 * Course Card Template
 */

$duration = get_post_meta(get_the_ID(), '_course_duration', true);
$category = '';
$terms = get_the_terms(get_the_ID(), 'course_category');
if ($terms && !is_wp_error($terms)) {
    $category = $terms[0]->name;
}
?>
<div class="course-card fade-in">
    <div class="course-image">
        <?php if (has_post_thumbnail()) : ?>
            <div class="course-image-bg" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'course-thumb')); ?>'); background-size: cover; background-position: center;"></div>
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
