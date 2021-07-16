<li id="comment-<?php comment_ID(); ?>"
    <?php comment_class("comment-block count-{$count}"); ?>
>
    <div class="comment-avatar">
        <?php echo get_avatar($comment, 82); ?>
    </div>
    <div class="comment-content">
        <h5>
            <?php comment_author($comment); ?>
        </h5>
        <div class="content">
            <?php echo nl2br(get_comment_text($comment)); ?>
        </div>
        <div class="comment-date-reply">
            <h6>
                <?php comment_date('M d Y', $comment); ?>
            </h6>
            <span>|</span>
            <?php
            comment_reply_link(
                $args
                +
                [
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                ]
            );
            ?>
        </div>
    </div>
</li>