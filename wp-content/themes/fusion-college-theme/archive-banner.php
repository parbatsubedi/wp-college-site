<?php get_header(); ?>

<main>
    <section class="archive-section">
        <div class="container">
            <div class="archive-header">
                <h1>Banners</h1>
                <p>Manage the current homepage banners and featured promotions.</p>
            </div>

            <div class="banner-list">
                <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <article class="banner-card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="banner-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="banner-details">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </article>
                <?php endwhile; else: ?>
                    <div class="no-content">
                        <h3>No banners available.</h3>
                        <p>Publish banners to highlight promotions and announcements.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<style>
.archive-section { padding: 80px 0; }
.banner-list { display: grid; gap: 30px; }
.banner-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 25px rgba(0,0,0,0.08); }
.banner-image img { width: 100%; display: block; }
.banner-details { padding: 25px; }
.banner-details h2 { margin-top: 0; color: #FF6B35; }
.banner-details p { color: #555; line-height: 1.8; }
.no-content { background: white; padding: 50px; border-radius: 10px; text-align: center; }
</style>

<?php get_footer(); ?>