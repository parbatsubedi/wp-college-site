<?php
/**
 * Comments Template
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area" style="margin-top: 60px; padding-top: 40px; border-top: 1px solid var(--border-color);">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title" style="font-size: 28px; font-weight: 700; margin-bottom: 30px; color: var(--text-dark);">
            <?php
            $comment_count = get_comments_number();
            if ($comment_count === 1) {
                esc_html_e('One Comment', 'fusion-college');
            } else {
                printf(esc_html('%1$s Comments', 'fusion-college'), number_format_i18n($comment_count));
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
            ?>
            <p class="no-comments" style="color: var(--text-muted);"><?php esc_html_e('Comments are closed.', 'fusion-college'); ?></p>
            <?php
        endif;

    endif;

    comment_form();
    ?>
</div>
