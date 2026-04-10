<?php
/**
 * The main template file
 */

get_header();
?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <section class="section" style="padding-top: 120px;">
            <div class="container">
                <article>
                    <h1 style="font-size: 40px; font-weight: 700; margin-bottom: 30px; color: var(--text-dark);"><?php the_title(); ?></h1>
                    <div class="rich-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
        </section>
    <?php endwhile; ?>
<?php else : ?>
    <section class="section" style="padding-top: 120px;">
        <div class="container">
            <h1 style="font-size: 40px; font-weight: 700; margin-bottom: 20px;">Nothing Found</h1>
            <p style="color: var(--text-muted);">Sorry, no posts matched your criteria.</p>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
