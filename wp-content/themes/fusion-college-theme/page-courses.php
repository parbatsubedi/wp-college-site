<?php
/*
Template Name: Courses Page
*/

get_header();
?>

<main>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <p>Explore our comprehensive range of courses designed to prepare you for a successful career.</p>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="courses-section">
        <div class="container">
            <!-- Course Filters -->
            <div class="course-filters">
                <form method="GET" class="filters-form">
                    <div class="filter-group">
                        <label for="course_category">Category:</label>
                        <select name="course_category" id="course_category">
                            <option value="">All Categories</option>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'course_category',
                                'hide_empty' => false
                            ));

                            foreach ($categories as $category) {
                                $selected = (isset($_GET['course_category']) && $_GET['course_category'] == $category->slug) ? 'selected' : '';
                                echo '<option value="' . $category->slug . '" ' . $selected . '>' . $category->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="study_mode">Study Mode:</label>
                        <select name="study_mode" id="study_mode">
                            <option value="">All Modes</option>
                            <?php
                            $study_modes = get_terms(array(
                                'taxonomy' => 'study_mode',
                                'hide_empty' => false
                            ));

                            foreach ($study_modes as $mode) {
                                $selected = (isset($_GET['study_mode']) && $_GET['study_mode'] == $mode->slug) ? 'selected' : '';
                                echo '<option value="' . $mode->slug . '" ' . $selected . '>' . $mode->name . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-secondary">Filter Courses</button>
                </form>
            </div>

            <!-- Courses Grid -->
            <div class="courses-grid grid grid-3">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $args = array(
                    'post_type' => 'course',
                    'posts_per_page' => 9,
                    'paged' => $paged,
                    'post_status' => 'publish'
                );

                // Add category filter
                if (isset($_GET['course_category']) && !empty($_GET['course_category'])) {
                    $args['tax_query'][] = array(
                        'taxonomy' => 'course_category',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($_GET['course_category'])
                    );
                }

                // Add study mode filter
                if (isset($_GET['study_mode']) && !empty($_GET['study_mode'])) {
                    $args['tax_query'][] = array(
                        'taxonomy' => 'study_mode',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($_GET['study_mode'])
                    );
                }

                $courses_query = new WP_Query($args);

                if ($courses_query->have_posts()) {
                    while ($courses_query->have_posts()) {
                        $courses_query->the_post();
                        $duration = get_post_meta(get_the_ID(), '_course_duration', true);
                        $fee = get_post_meta(get_the_ID(), '_course_fee', true);
                        $study_mode = get_post_meta(get_the_ID(), '_course_study_mode', true);
                        ?>
                        <div class="card course-card">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'course-thumbnail'); ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>

                            <div class="card-content">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="course-meta">
                                    <?php if ($duration): ?>
                                        <span class="meta-item">⏱️ <?php echo esc_html($duration); ?></span>
                                    <?php endif; ?>

                                    <?php if ($fee): ?>
                                        <span class="meta-item">💰 $<?php echo number_format($fee, 2); ?></span>
                                    <?php endif; ?>

                                    <?php if ($study_mode): ?>
                                        <span class="meta-item">📚 <?php echo esc_html($study_mode); ?></span>
                                    <?php endif; ?>
                                </div>
                                <p><?php echo get_the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Learn More</a>
                            </div>
                        </div>
                        <?php
                    }

                    // Pagination
                    echo '<div class="pagination">';
                    echo paginate_links(array(
                        'total' => $courses_query->max_num_pages,
                        'current' => $paged,
                        'format' => '?paged=%#%',
                        'add_args' => $_GET
                    ));
                    echo '</div>';

                } else {
                    echo '<div class="no-courses"><p>No courses found matching your criteria.</p></div>';
                }

                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
</main>

<style>
.page-header {
    background: linear-gradient(135deg, #077E86, #2A7970);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.courses-section {
    padding: 80px 0;
}

.course-filters {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 40px;
}

.filters-form {
    display: flex;
    gap: 20px;
    align-items: end;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.filter-group label {
    font-weight: 500;
    color: #333;
}

.filter-group select {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    min-width: 150px;
}

.course-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 15px 0;
}

.meta-item {
    font-size: 14px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 5px;
}

.pagination {
    margin-top: 40px;
    text-align: center;
}

.pagination .page-numbers {
    display: inline-block;
    padding: 8px 12px;
    margin: 0 2px;
    text-decoration: none;
    background: #f8f9fa;
    color: #333;
    border-radius: 4px;
    transition: all 0.3s;
}

.pagination .page-numbers:hover,
.pagination .page-numbers.current {
    background: #077E86;
    color: white;
}

.no-courses {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .filters-form {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-group select {
        min-width: auto;
    }

    .course-meta {
        flex-direction: column;
        gap: 8px;
    }
}
</style>

<?php get_footer(); ?>