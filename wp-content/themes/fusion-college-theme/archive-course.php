<?php get_header(); ?>

<main>
    <section class="courses-archive">
        <div class="container">
            <div class="archive-header">
                <h1>Courses</h1>
                <p>Explore our comprehensive range of courses designed to help you achieve your educational goals.</p>
            </div>

            <!-- Filters -->
            <div class="courses-filters">
                <form method="GET" class="filter-form">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="course_category">Category:</label>
                            <select name="course_category" id="course_category">
                                <option value="">All Categories</option>
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'course_category',
                                    'hide_empty' => false,
                                ));
                                foreach ($categories as $category) {
                                    $selected = (isset($_GET['course_category']) && $_GET['course_category'] == $category->slug) ? 'selected' : '';
                                    echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
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
                                    'hide_empty' => false,
                                ));
                                foreach ($study_modes as $mode) {
                                    $selected = (isset($_GET['study_mode']) && $_GET['study_mode'] == $mode->slug) ? 'selected' : '';
                                    echo '<option value="' . esc_attr($mode->slug) . '" ' . $selected . '>' . esc_html($mode->name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="search">Search:</label>
                            <input type="text" name="search" id="search" value="<?php echo isset($_GET['search']) ? esc_attr($_GET['search']) : ''; ?>" placeholder="Search courses...">
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-secondary">Clear</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Courses Grid -->
            <div class="courses-grid">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'post_type' => 'course',
                    'posts_per_page' => 12,
                    'paged' => $paged,
                    'meta_query' => array(),
                    'tax_query' => array('relation' => 'AND'),
                );

                // Category filter
                if (isset($_GET['course_category']) && !empty($_GET['course_category'])) {
                    $args['tax_query'][] = array(
                        'taxonomy' => 'course_category',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($_GET['course_category']),
                    );
                }

                // Study mode filter
                if (isset($_GET['study_mode']) && !empty($_GET['study_mode'])) {
                    $args['tax_query'][] = array(
                        'taxonomy' => 'study_mode',
                        'field' => 'slug',
                        'terms' => sanitize_text_field($_GET['study_mode']),
                    );
                }

                // Search filter
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $args['s'] = sanitize_text_field($_GET['search']);
                }

                $courses_query = new WP_Query($args);

                if ($courses_query->have_posts()):
                    while ($courses_query->have_posts()): $courses_query->the_post();
                        $duration = get_post_meta(get_the_ID(), '_course_duration', true);
                        $fee = get_post_meta(get_the_ID(), '_course_fee', true);
                        $study_mode = get_post_meta(get_the_ID(), '_course_study_mode', true);
                        $location = get_post_meta(get_the_ID(), '_course_location', true);
                        ?>
                        <div class="course-card">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="course-image">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>">
                                </div>
                            <?php endif; ?>

                            <div class="course-content">
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

                                    <?php if ($location): ?>
                                        <span class="meta-item">📍 <?php echo esc_html($location); ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="course-excerpt">
                                    <?php echo get_the_excerpt(); ?>
                                </div>

                                <div class="course-actions">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Learn More</a>
                                    <a href="<?php the_permalink(); ?>#apply" class="btn btn-secondary">Apply Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $courses_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => '&laquo; Previous',
                            'next_text' => 'Next &raquo;',
                        ));
                        ?>
                    </div>

                <?php else: ?>
                    <div class="no-courses">
                        <h3>No courses found</h3>
                        <p>Try adjusting your filters or search terms.</p>
                        <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-primary">View All Courses</a>
                    </div>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
</main>

<style>
.courses-archive {
    padding: 80px 0;
}

.archive-header {
    text-align: center;
    margin-bottom: 50px;
}

.archive-header h1 {
    font-size: 3rem;
    color: #077E86;
    margin-bottom: 20px;
}

.archive-header p {
    font-size: 1.2rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
}

.courses-filters {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 40px;
}

.filter-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    align-items: end;
}

.filter-group {
    display: flex;
    flex-direction: column;
}

.filter-group label {
    font-weight: 600;
    margin-bottom: 8px;
    color: #077E86;
}

.filter-group select,
.filter-group input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.filter-actions {
    display: flex;
    gap: 10px;
}

.courses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

.course-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 25px rgba(0,0,0,0.15);
}

.course-image {
    height: 200px;
    overflow: hidden;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.course-card:hover .course-image img {
    transform: scale(1.05);
}

.course-content {
    padding: 25px;
}

.course-content h3 {
    margin: 0 0 15px;
    font-size: 1.3rem;
}

.course-content h3 a {
    color: #077E86;
    text-decoration: none;
}

.course-content h3 a:hover {
    color: #2A7970;
}

.course-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.meta-item {
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    color: #666;
}

.course-excerpt {
    color: #666;
    margin-bottom: 20px;
    line-height: 1.5;
}

.course-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.pagination {
    grid-column: 1 / -1;
    text-align: center;
    margin-top: 40px;
}

.pagination .page-numbers {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 5px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #077E86;
    transition: all 0.3s ease;
}

.pagination .page-numbers:hover,
.pagination .page-numbers.current {
    background: #077E86;
    color: white;
    border-color: #077E86;
}

.no-courses {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.no-courses h3 {
    color: #077E86;
    margin-bottom: 15px;
}

.no-courses p {
    color: #666;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .courses-grid {
        grid-template-columns: 1fr;
    }

    .filter-row {
        grid-template-columns: 1fr;
    }

    .course-actions {
        flex-direction: column;
    }

    .archive-header h1 {
        font-size: 2.5rem;
    }
}
</style>

<?php get_footer(); ?>