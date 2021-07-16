<?php
get_header();
?>

<div id="content">
    <div id="main-content" class="fullscreen">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('content', get_post_format());
            }
        } else {
            get_template_part('content', 'none');
        }
        ?>
    </div>
</div>

<?php
get_footer();
?>