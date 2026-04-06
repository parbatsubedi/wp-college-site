<?php get_header(); ?>

<main>
    <section class="archive-section">
        <div class="container">
            <div class="archive-header">
                <h1>Gallery</h1>
                <p>Browse our photo galleries showcasing campus life, student achievements, and events.</p>
            </div>

            <div class="gallery-grid">
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <article class="gallery-card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="gallery-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="gallery-content">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </article>
                <?php endwhile; else: ?>
                    <div class="no-content">
                        <h3>No galleries found.</h3>
                        <p>Check back later for new photo galleries.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pagination">
                <?php
echo paginate_links(array(
    'total' => $wp_query->max_num_pages,
    'prev_text' => '&laquo; Previous',
    'next_text' => 'Next &raquo;'
));
?></div>
        </div>
    </section>
</main>

<style>
.archive-section { padding: 80px 0; }
.archive-header { text-align: center; margin-bottom: 50px; }
.archive-header h1 { color: #077E86; margin-bottom: 15px; font-size: 3rem; }
.archive-header p { color: #666; max-width: 650px; margin: 0 auto; }
.gallery-grid { display: grid; gap: 30px; }
.gallery-card { background: white; border-radius: 10px; box-shadow: 0 4px 25px rgba(0,0,0,0.08); overflow: hidden; }
.gallery-image img { width: 100%; display: block; }
.gallery-content { padding: 25px; }
.gallery-content h2 { margin: 0 0 10px; color: #077E86; }
.gallery-content p { color: #555; line-height: 1.7; }
.pagination { text-align: center; margin-top: 40px; }
.pagination .page-numbers { margin: 0 5px; padding: 10px 14px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #077E86; }
.pagination .page-numbers.current, .pagination .page-numbers:hover { background: #077E86; color: white; border-color: #077E86; }
</style>

<?php get_footer(); ?>