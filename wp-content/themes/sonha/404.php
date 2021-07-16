<?php
get_header();
?>

<div id="content">
    <div id="main-content">
        <h2><?php _e('NOT FOUND', TEXT_DOMAIN); ?></h2>
        <p><?php _e('The article you are looking for was not found. Please try again!', TEXT_DOMAIN); ?></p>
        <h3><?php _e('Content categories: ', TEXT_DOMAIN); ?></h3>
        <div class="404-cat-list">
            <?php wp_list_categories(['title_li' => '']); ?>
        </div>
        <?php
            _e('Tag cloud', TEXT_DOMAIN);
            wp_tag_cloud();
        ?>
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
?>