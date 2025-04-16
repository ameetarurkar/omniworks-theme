<?php
/**
 * The template for displaying comments
 *
 * @package Omniworks_Clone
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
        ?>
        <h2 class="comments-title">
            <?php
            $omniworks_comment_count = get_comments_number();
            if ('1' === $omniworks_comment_count) {
                printf(
                    /* translators: 1: title. */
                    esc_html__('One comment on &ldquo;%1$s&rdquo;', 'omniworks-clone'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf( 
                    /* translators: 1: comment count number, 2: title. */
                    esc_html(_nx('%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $omniworks_comment_count, 'comments title', 'omniworks-clone')),
                    number_format_i18n($omniworks_comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 60,
                )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
            ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'omniworks-clone'); ?></p>
            <?php
        endif;

    endif; // Check for have_comments().

    comment_form(
        array(
            'title_reply' => esc_html__('Leave a Comment', 'omniworks-clone'),
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h3>',
            'class_submit' => 'btn-primary',
            'comment_notes_before' => '<p class="comment-notes">' . esc_html__('Your email address will not be published. Required fields are marked *', 'omniworks-clone') . '</p>',
        )
    );
    ?>

</div><!-- #comments -->
