<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php sonha_thumbnail('large'); ?>
    </div>
    <div class="entry-header">
        <?php sonha_entry_header(); ?>
        <?php
            $attachments = get_children(['post_parent' => $post->ID]);
            printf(__('This image post contains %d photo(s).', TEXT_DOMAIN), count($attachments));
        ?>
    </div>
    <div class="entry-content">
        <?php sonha_entry_content(); ?>
        <?php is_single() ? sonha_entry_tag() : ''; ?>
    </div>
</article>