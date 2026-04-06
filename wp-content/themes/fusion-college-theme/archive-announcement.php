<?php get_header(); ?>

<main>
    <section class="archive-section">
        <div class="container">
            <div class="archive-header">
                <h1>Announcements</h1>
                <p>Latest updates, news, and important notices from Fusion College.</p>
            </div>

            <div class="archive-grid">
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <article class="archive-card">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="archive-date"><?php echo get_the_date('F j, Y'); ?></p>
                        <div class="archive-excerpt"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Read More</a>
                    </article>
                <?php endwhile; else: ?>
                    <div class="no-content">
                        <h3>No announcements found.</h3>
                        <p>Please check back soon for updates.</p>
                    </div>
                <?php endif; ?>

                <div class="pagination">
                    <?php
echo paginate_links(array(
    'total' => $wp_query->max_num_pages,
    'prev_text' => '&laquo; Previous',
    'next_text' => 'Next &raquo;'
));
?></div>
            </div>
        </div>
    </section>
</main>

<style>
.archive-section { padding: 80px 0; }
.archive-header { text-align: center; margin-bottom: 50px; }
.archive-header h1 { color: #FF6B35; margin-bottom: 15px; font-size: 3rem; }
.archive-header p { color: #666; max-width: 650px; margin: 0 auto; }
.archive-grid { display: grid; gap: 30px; }
.archive-card { background: white; padding: 35px; border-radius: 10px; box-shadow: 0 4px 25px rgba(0,0,0,0.08); }
.archive-card h2 { margin-top: 0; color: #FF6B35; }
.archive-date { color: #888; margin-bottom: 20px; display: block; }
.archive-excerpt { color: #555; line-height: 1.8; margin-bottom: 20px; }
.no-content { background: white; padding: 50px; border-radius: 10px; text-align: center; }
.pagination { text-align: center; margin-top: 40px; }
.pagination .page-numbers { margin: 0 5px; padding: 10px 14px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #FF6B35; }
.pagination .page-numbers.current, .pagination .page-numbers:hover { background: #FF6B35; color: white; border-color: #FF6B35; }
</style>

<?php get_footer(); ?>