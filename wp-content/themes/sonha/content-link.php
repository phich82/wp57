<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php sonha_thumbnail(); ?>
    </div>
    <div class="entry-header">
        <?php
        $link = get_post_meta($post->ID, 'format_link_url', true);
        $link_description = get_post_meta($post->ID, 'format_link_description', true);
        if (is_single()) {
            printf(
                '<h1 class="entry-title"><a href="%s" target="_blank">%s</a></h1>',
                $link,
                get_the_title()
            );
        } else {
            printf(
                '<h2 class="entry-title"><a href="%s" target="_blank">%s</a></h2>',
                $link,
                get_the_title()
            );
        }
        sonha_entry_meta();
        ?>
    </div>
    <div class="entry-content">
        <?php
        printf(
            '<a href="%s" target="_blank">%s</a>',
            $link,
            $link_description
        );
        is_single() ? sonha_entry_tag() : '';
        ?>
    </div>
</article>