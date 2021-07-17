<article id="post-<?php the_ID(); ?>" <?php post_class(is_single() ? 'single-page' : ''); ?>>
    <?php if (!is_single()): ?>
    <div class="entry-thumbnail">
        <?php sonha_thumbnail(); ?>
    </div>
    <?php endif; ?>
    <div class="entry-header">
        <?php sonha_entry_header(); ?>
        <?php sonha_entry_meta(); ?>
    </div>
    <div class="entry-content">
        <?php sonha_entry_content(); ?>
        <?php is_single() ? sonha_entry_tag() : ''; ?>
    </div>
</article>