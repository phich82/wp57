<?php
get_header();
?>

<div id="content">
    <div id="main-content">
        <div class="search-info">
            <?php
            // $query = new WP_Query("s={$s}&showpost=-1");
            $query = new WP_Query(sonha_query_params(['showpost' => -1]));
            $search_count = $query->found_posts;
            $search_count_per_page = $query->post_count;
            printf(__('Result: We found %d article(s) matching to your search keyword.', TEXT_DOMAIN), $search_count);
            ?>
        </div>
        <div>
            <?php get_search_form(); ?>
        </div>
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('content', get_post_format());
            }
            // sonha_pagination();
            sonha_custom_pagination();
        } else {
            get_template_part('content', 'none');
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