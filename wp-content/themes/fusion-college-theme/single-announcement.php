<?php get_header(); ?>

<main>
    <?php while (have_posts()) : the_post(); ?>
        <section class="single-section">
            <div class="container">
                <div class="single-header">
                    <h1><?php the_title(); ?></h1>
                    <p class="single-meta">Published on <?php echo get_the_date('F j, Y'); ?></p>
                </div>

                <div class="single-content">
                    <?php the_content(); ?>
                </div>

                <div class="single-navigation">
                    <div class="nav-prev"><?php previous_post_link('%link', '← Previous Announcement'); ?></div>
                    <div class="nav-next"><?php next_post_link('%link', 'Next Announcement →'); ?></div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<style>
.single-section { padding: 80px 0; }
.single-header { margin-bottom: 40px; }
.single-header h1 { color: #FF6B35; font-size: 3rem; margin-bottom: 10px; }
.single-meta { color: #777; }
.single-content { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 25px rgba(0,0,0,0.08); color: #444; line-height: 1.8; }
.single-navigation { display: flex; justify-content: space-between; gap: 20px; margin-top: 40px; }
.single-navigation a { color: #077E86; text-decoration: none; font-weight: 600; }
@media (max-width: 768px) { .single-navigation { flex-direction: column; align-items: stretch; } }
</style>

<?php get_footer(); ?>