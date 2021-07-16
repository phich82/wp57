<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php sonha_thumbnail(); ?>
    </div>
    <div class="entry-header">
        <?php sonha_entry_header(); ?>
        <?php sonha_entry_meta(); ?>
    </div>
    <div class="entry-content">
        <?php sonha_entry_content(); ?>
        <?php is_single() ? sonha_entry_tag() : ''; ?>
    </div>
</article>