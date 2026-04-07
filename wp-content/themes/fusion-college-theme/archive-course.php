<?php
/**
 * Archive Template for Courses
 * Uses fusion_courses shortcode with filtering
 */
get_header();
?>

<main class="site-main">
    
    <!-- Page Banner -->
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-content">
                <h1><?php post_type_archive_title(); ?></h1>
                <p>Explore our comprehensive range of courses designed to help you achieve your educational goals.</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="page-nav">
        <div class="container">
            <form method="GET" class="filter-form">
                <div class="filter-row">
                    <div class="filter-group">
                        <label>Category:</label>
                        <select name="course_category">
                            <option value="">All Categories</option>
                            <?php
                            $categories = get_terms(['taxonomy' => 'course_category', 'hide_empty' => false]);
foreach ($categories as $cat) {
    $selected = isset($_GET['course_category']) && $_GET['course_category'] == $cat->slug ? 'selected' : '';
    echo '<option value="'.esc_attr($cat->slug).'" '.$selected.'>'.esc_html($cat->name).'</option>';
}
?>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label>Study Mode:</label>
                        <select name="study_mode">
                            <option value="">All Modes</option>
                            <?php
$modes = get_terms(['taxonomy' => 'study_mode', 'hide_empty' => false]);
foreach ($modes as $mode) {
    $selected = isset($_GET['study_mode']) && $_GET['study_mode'] == $mode->slug ? 'selected' : '';
    echo '<option value="'.esc_attr($mode->slug).'" '.$selected.'>'.esc_html($mode->name).'</option>';
}
?>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Search:</label>
                        <input type="text" name="s" value="<?php echo isset($_GET['s']) ? esc_attr($_GET['s']) : ''; ?>" placeholder="Search courses...">
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="<?php echo esc_url(get_post_type_archive_link('course')); ?>" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Courses Grid -->
    <section class="section">
        <div class="container">
            <?php
            $limit = 12;
$category = isset($_GET['course_category']) ? sanitize_text_field($_GET['course_category']) : '';
echo do_shortcode('[fusion_courses limit="'.$limit.'" category="'.$category.'" columns="3"]');
?>

            <?php if (! have_posts()) { ?>
            <div style="text-align: center; padding: 60px 20px;">
                <h3>No courses found</h3>
                <p style="color: var(--text-muted); margin-top: 10px;">Try adjusting your filters or search terms.</p>
            </div>
            <?php } ?>
        </div>
    </section>

</main>

<style>
.page-nav {
    background: var(--card-bg);
    border-bottom: 1px solid var(--border-color);
    padding: 20px 0;
}

.filter-form {
    max-width: 100%;
}

.filter-row {
    display: flex;
    gap: 20px;
    align-items: flex-end;
    flex-wrap: wrap;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
    color: var(--text-dark);
}

.filter-group select,
.filter-group input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 14px;
    background: var(--bg-light);
    color: var(--text-dark);
}

.filter-group select:focus,
.filter-group input:focus {
    outline: none;
    border-color: var(--primary);
}

.filter-actions {
    display: flex;
    gap: 10px;
}

@media (max-width: 768px) {
    .filter-row {
        flex-direction: column;
    }
    
    .filter-group {
        min-width: 100%;
    }
    
    .filter-actions {
        width: 100%;
    }
    
    .filter-actions .btn {
        flex: 1;
    }
}
</style>

<?php get_footer(); ?>
