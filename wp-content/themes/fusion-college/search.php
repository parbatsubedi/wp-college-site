<?php
/**
 * Search Results Template
 */

get_header();
?>

<?php fusion_college_page_banner(
    'Search Results',
    'Search results for: "' . get_search_query() . '"',
    array(array('label' => 'Search Results'))
); ?>

<section class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="section-header">
                <p class="section-subtitle">
                    Found <?php echo $wp_query->found_posts; ?> result<?php echo $wp_query->found_posts !== 1 ? 's' : ''; ?>
                </p>
            </div>

            <div style="display: grid; gap: 30px;">
                <?php while (have_posts()) : the_post(); ?>
                    <article style="background: var(--card-bg); padding: 30px; border-radius: 16px; box-shadow: 0 10px 40px var(--shadow); border: 1px solid var(--border-color);" class="fade-in">
                        <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 10px;">
                            <a href="<?php the_permalink(); ?>" style="color: var(--text-dark); text-decoration: none;"><?php the_title(); ?></a>
                        </h2>
                        <div style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px;">
                            <?php echo get_the_date(); ?> | <?php echo get_the_category_list(', '); ?>
                        </div>
                        <p style="color: var(--text-muted); line-height: 1.7;">
                            <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                        </p>
                        <a href="<?php the_permalink(); ?>" style="color: var(--primary); font-weight: 600; text-decoration: none;">Read More →</a>
                    </article>
                <?php endwhile; ?>
            </div>

            <div style="margin-top: 50px; text-align: center;">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                ));
                ?>
            </div>
        <?php else : ?>
            <div style="text-align: center; padding: 60px 20px;">
                <h2 style="font-size: 28px; font-weight: 700; margin-bottom: 15px; color: var(--text-dark);">No Results Found</h2>
                <p style="color: var(--text-muted); font-size: 16px; margin-bottom: 30px;">
                    Sorry, but nothing matched your search terms. Please try different keywords.
                </p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
