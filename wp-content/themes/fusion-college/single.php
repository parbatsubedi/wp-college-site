<?php
/**
 * Single Post Template (fallback)
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>
    <section class="section" style="padding-top: 120px;">
        <div class="container">
            <article>
                <h1 style="font-size: 40px; font-weight: 700; margin-bottom: 20px; color: var(--text-dark);"><?php the_title(); ?></h1>
                <div style="color: var(--text-muted); margin-bottom: 30px; font-size: 14px;">
                    Published on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                </div>
                <div class="rich-content">
                    <?php the_content(); ?>
                </div>
            </article>

            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div>
    </section>
<?php endwhile; ?>

<?php get_footer(); ?>
