<?php
get_header();
?>

<?php
// Import css file for each page here
sonha_include_css(THEME_URI.'/assets/css/pages/account/account.css');
// Import js file for each page here
sonha_include_js(THEME_URI.'/assets/js/pages/account/account.js');
?>

<div id="content">
    <div id="main-content">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('content', get_post_format(), ['is_single' => true]);
                get_template_part('author-bio');
                // comments_template();
            }
        } else {
            get_template_part('content', 'none');
        }
        ?>
        <div class="related-posts">
            <h3>Related posts</h3>
            <div class="related-post-container">
                <?php sonha_get_latest_relative_posts(); ?>
            </div>
        </div>
        <?php
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
?>