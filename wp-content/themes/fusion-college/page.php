<?php
/**
 * Default Page Template
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>
    <section class="section" style="padding-top: 120px;">
        <div class="container">
            <?php
            // Show page banner if it's not the front page
            if (!is_front_page()) {
                fusion_college_page_banner(
                    get_the_title(),
                    '',
                    array(array('label' => get_the_title()))
                );
            }
            ?>
            <article>
                <?php if (!is_front_page()) : ?>
                    <div style="margin-top: 60px;"></div>
                <?php endif; ?>
                <div class="rich-content">
                    <?php the_content(); ?>
                </div>
                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'fusion-college'),
                    'after'  => '</div>',
                ));
                ?>
            </article>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer(); ?>
