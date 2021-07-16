<?php
get_header();
?>

<div id="content">
    <div id="main-content">
        <div class="contact-info">
            <h4>Contact address</h4>
            <p>117 Ly Chinh Thang street, Ward 7, District 7, HCM City, Vietnam</p>
            <p>0280123456789</p>
        </div>
        <div class="contact-info">
            <?php echo do_shortcode('[contact-form-7 id="373" title="Contact form 1"]'); ?>
        </div>
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
?>
