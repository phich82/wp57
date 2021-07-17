<div class="entry-footer">
    <div class="author-box">
        <div class="author-avatar">
            <?php echo get_avatar(get_the_author_meta('ID')); ?>
        </div>
        <h3>
            <?php
            printf(
                __('Written by <a href="%s">%s</a>', TEXT_DOMAIN),
                get_author_posts_url(get_the_author_meta('ID')),
                get_the_author()
            );
            ?>
        </h3>
        <p>
            <?php echo get_the_author_meta('description') ?>
        </p>
    </div>
</div>