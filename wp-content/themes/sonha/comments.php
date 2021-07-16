<div class="comments">
    <?php
    // Show a new comment form
    comment_form([
        'comment_field' => '<div class="block"><textarea name="comment"></textarea></div>',
        'fields' => [
            'author' => '<div class="block"><input type="text" name="author" placeholder="Your Name" />',
            'email' => '<input type="email" name="email" placeholder="Email" /></div>',
            'url' => '<div class="block"><input type="text" name="website" placeholder="Website" />',
            'location' => '<input type="text" name="location" placeholder="Location" /></div>',
        ],
        'class_container' => 'comment-container',
        'id_form' => 'custom-comment-form-id',
        'class_form' => 'custom-comment-form',
        'submit_button' => '<div class="block"><button type="submit" name="submit" class="btn">'.__('Submit', TEXT_DOMAIN).'</button></div>',
        'title_reply_before' => '<div class="comment-title"><h3>',
        'title_reply' => __('<span>Leave a comment</span>', TEXT_DOMAIN),
        'title_reply_after' => '</h3></div>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'submit_field' => '%1$s %2$s',
        // 'must_log_in' => '',
        // 'logged_in_as' => '',
        'cancel_reply_before' => '<span class="hide-comment-reply" title="'.(__('Hide this reply form', TEXT_DOMAIN)).'">',
        'cancel_reply_link' => 'X',
        'cancel_reply_after' => '</span>',

    ]);
    ?>
    <div class="comment-list">
        <?php if (is_waiting_approval_comment()):
            clear_waiting_approval_comment();
        ?>
        <div class="comment-notice" style="font-style: italic; padding: 10px 0 20px 0; color: green;">
            <?php _e('Comment already created successfully. Please waiting to be approved.', TEXT_DOMAIN); ?>
        </div>
        <?php endif; ?>
        <div class="comment-total">
            <?php
            // Show total of comments
            comments_number(
                __('No comments', TEXT_DOMAIN),
                __('One comment', TEXT_DOMAIN),
                __('% comments', TEXT_DOMAIN)
            );
            ?>
        </div>
        <ul>
            <?php
            // Show comment list
            wp_list_comments([
                'callback' => function ($comment, $args, $depth) {
                    global $count;
                    $count++;
                    if ($comment->comment_approved == 1) {
                        sonha_include(__DIR__.'/templates/partials/comments/comment-item.php', [
                            'count'   => $count,
                            'comment' => $comment,
                            'args'    => $args,
                            'depth'   => $depth,
                        ]);
                    }
                }
            ]);
            ?>
        </ul>
        <?php
        // Comments pagination
        if (get_comment_pages_count() > 1 && get_option('page_comments')) {
            // include(__DIR__.'/templates/partials/comments/comment-pagination.php');
            sonha_custom_comment_pagination();
        }

        // Show notice when comments are closed
        if (!comments_open()) {
            sonha_include(__DIR__.'/templates/notice.php', [
                'notice' => __('We are sorry. Comments are closed.', TEXT_DOMAIN),
                'class'  => 'sm-notice'
            ]);
        }
        ?>
    </div>
</div>