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
$thumb_url = get_post_meta(get_the_ID(), '_course_featured_image', true);
if (!$thumb_url) {
    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'course-thumb');
}
?>
<a href="<?php the_permalink(); ?>" class="course-card fade-in" style="display: block; text-decoration: none;">
    <div class="course-image">
        <?php if ($thumb_url) : ?>
            <div class="course-image-bg" style="background-image: url('<?php echo esc_url($thumb_url); ?>'); background-size: cover; background-position: center;"></div>
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
                <span class="course-duration"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:4px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> Duration <?php echo esc_html($duration); ?> Weeks</span>
            <?php endif; ?>
            <span class="btn btn-primary btn-small">View Details</span>
        </div>
    </div>
</a>
