<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div style="display: flex; gap: 10px;">
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search …', 'placeholder', 'fusion-college'); ?>" value="<?php echo get_search_query(); ?>" name="s" style="flex: 1; padding: 14px 18px; border: 2px solid var(--border-color); border-radius: 10px; font-size: 15px; background: var(--bg-light); color: var(--text-dark);">
        <button type="submit" class="btn btn-primary" style="padding: 14px 25px;"><?php echo esc_html_x('Search', 'submit button', 'fusion-college'); ?></button>
    </div>
</form>
