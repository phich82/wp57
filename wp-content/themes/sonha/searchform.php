<form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <!--  attr 'name': it must be 's' -->
    <input type="search"
           name="s"
           placeholder="<?php _e('Enter a keyword', TEXT_DOMAIN); ?>"
           id="<?php esc_attr(uniqid('search-form-')); ?>"
           value="<?php the_search_query(); ?>"
    />
    <button type="submit" id="search">
        <i class="zmdi zmdi-search"></i>
    </button>
</form>