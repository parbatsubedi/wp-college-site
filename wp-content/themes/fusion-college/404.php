<?php
/**
 * 404 Error Page Template
 */

get_header();
?>

<section class="section" style="padding-top: 120px; min-height: 80vh; display: flex; align-items: center;">
    <div class="container" style="text-align: center;">
        <div class="fade-in">
            <h1 style="font-size: 120px; font-weight: 700; color: var(--primary); margin-bottom: 20px;">404</h1>
            <h2 style="font-size: 32px; font-weight: 700; color: var(--text-dark); margin-bottom: 15px;">Page Not Found</h2>
            <p style="font-size: 18px; color: var(--text-muted); margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto;">
                Sorry, the page you're looking for doesn't exist. It may have been moved or deleted.
            </p>
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Go Home</a>
                <a href="<?php echo get_post_type_archive_link('course'); ?>" class="btn btn-outline" style="border: 2px solid var(--primary); color: var(--primary);">Browse Courses</a>
                <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="btn btn-outline" style="border: 2px solid var(--primary); color: var(--primary);">Contact Us</a>
            </div>

            <div style="margin-top: 60px; max-width: 400px; margin-left: auto; margin-right: auto;">
                <h3 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 20px;">Search Our Site</h3>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" style="display: flex; gap: 10px;">
                    <input type="search" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>" style="flex: 1; padding: 14px 18px; border: 2px solid var(--border-color); border-radius: 10px; font-size: 15px; background: var(--bg-light); color: var(--text-dark);">
                    <button type="submit" class="btn btn-primary" style="padding: 14px 25px;">Search</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
