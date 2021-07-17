<article id="post-<?php the_ID(); ?>" <?php post_class(['post-video']); ?>>
    <div class="entry-header">
        <?php sonha_entry_header(); ?>
    </div>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php is_single() ? sonha_entry_tag() : ''; ?>
    </div>
</article>