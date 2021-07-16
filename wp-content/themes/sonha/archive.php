<?php
/**
 * For category and tag
 */
get_header();
?>

<div id="content">
    <div id="main-content">
        <div class="archive-title">
            <?php
            if (is_tag()) {
                printf(
                    __('Posts tagged: %s', TEXT_DOMAIN),
                    single_tag_title('', false)
                );
            } elseif (is_category()) {
                printf(
                    __('Posts catgeorized: %s', TEXT_DOMAIN),
                    single_tag_title('', false)
                );
            } elseif (is_day()) { // pages stored in day
                printf(
                    __('Daily archives: %s', TEXT_DOMAIN),
                    get_the_time('l, F j, Y')
                );
            } elseif (is_month()) { // pages stored in month
                printf(
                    __('Monthly archives: %s', TEXT_DOMAIN),
                    get_the_time('F Y')
                );
            } elseif (is_year()) { // pages stored in year
                printf(
                    __('Yearly archives: %s', TEXT_DOMAIN),
                    get_the_time('Y')
                );
            }
            ?>
        </div>

        <?php if (is_tag() || is_category()): ?>
        <div class="archive-description">
            <?php echo term_description(); ?>
        </div>
        <?php endif; ?>

        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('content', get_post_format());
            }
            sonha_pagination();
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