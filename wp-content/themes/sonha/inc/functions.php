<?php

/**
 * Show sidebar
 */
if (!function_exists('sonha_show_sidebar')) {
    /**
     * Show sidebar
     *
     * @param  string $sidebar_name
     * @param  bool $showWarning
     * @return void
     */
    function sonha_show_sidebar($sidebar_name, $showWarning = true) {
        if (is_active_sidebar($sidebar_name)) {
            dynamic_sidebar($sidebar_name);
        } else if ($showWarning) {
            _e('This is a sidebar. You have to add some widgets.', TEXT_DOMAIN);
        }
    }
}

/**
 * Pagination
 */
if (!function_exists('sonha_pagination')) {
    /**
     * Pagination
     *
     * @return void
     */
    function sonha_pagination() {
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return '';
        }
        echo '<nav class="pagination" role="navigation">';
        if (get_next_posts_link()) {
            echo '<div class="prev">'.next_posts_link(__('Prev', TEXT_DOMAIN)).'</div>';
        }
        if (get_previous_posts_link()) {
            echo '<div class="next">'.previous_posts_link(__('Next', TEXT_DOMAIN)).'</div>';
        }
        echo '</nav>';
    }
}

if (!function_exists('sonha_custom_pagination')) {
    function sonha_custom_pagination(WP_Query $wp_query = null, $echo = true) {
        if (!$wp_query) {
            global $wp_query;
        }
        $pages = paginate_links([
            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format'       => '?paged=%#%',
            'current'      => max(1, get_query_var('paged')),
            'total'        => $wp_query->max_num_pages,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => '<i class="zmdi zmdi-chevron-left arrow-left"></i>Prev',
            'next_text'    => 'Next<i class="zmdi zmdi-chevron-right arrow-right"></i>',
            'add_args'     => false,
            'add_fragment' => ''
        ]);

        if (empty($pages)) {
            return null;
        }

        $is_active = function ($page) { return strpos($page, 'current') !== false; };
        $pagination = '
            <div class="custom-pagination">
                <ul class="clearfix">
        ';
        foreach ($pages as $page) {
            $pagination .= '<li'.($is_active($page) ? ' class="active"' : '').'>';
            if ($is_active($page)) {
                $p = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
                $pagination .= '<a>'.$p.'</a>';
            } else {
                $pagination .= str_replace('class="page-numbers"', '', $page);
            }
            $pagination .= '</li>';
        }
        $pagination .= '
                </ul>
            </div>
        ';
        echo $pagination;
    }
}

if (!function_exists('sonha_custom_comment_pagination')) {
    function sonha_custom_comment_pagination(WP_Rewrite $wp_rewrite = null, $echo = true) {
        if (!$wp_rewrite) {
            global $wp_rewrite;
        }
        $pages = paginate_comments_links([
            'base'         => add_query_arg( 'cpage', '%#%' ),
		    'format'       => '',
            'current'      => max(1, get_query_var('cpage')),
            'total'        => get_comment_pages_count(),
            'echo'         => $echo,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => '<i class="zmdi zmdi-chevron-left"></i>Prev',
            'next_text'    => 'Next<i class="zmdi zmdi-chevron-right"></i>',
            'add_args'     => false,
		    'add_fragment' => '#comments',
        ]);

        if (empty($pages)) {
            return null;
        }

        $is_active = function ($page) { return strpos($page, 'current') !== false; };
        $pagination = '
            <div class="custom-pagination">
                <ul class="clearfix">
        ';
        foreach ($pages as $page) {
            $pagination .= '<li'.($is_active($page) ? ' class="active"' : '').'>';
            if ($is_active($page)) {
                $p = get_query_var('cpage') > 1 ? get_query_var('cpage') : 1;
                $pagination .= '<a>'.$p.'</a>';
            } else {
                $pagination .= str_replace('class="page-numbers"', '', $page);
            }
            $pagination .= '</li>';
        }
        $pagination .= '
                </ul>
            </div>
        ';
        echo $pagination;
    }
}

/**
 * Show post thumbnail
 */
if (!function_exists('sonha_thumbnail')) {
    function sonha_thumbnail($size = 'thumbnail') {
        if (!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')) {
            // echo '<figure class="post-thumbnail">'.the_post_thumbnail($size).'</figure>';
            the_post_thumbnail($size);
        }
    }
}

/**
 * Show post header
 */
if (!function_exists('sonha_entry_header')) {
    function sonha_entry_header() {
        if (is_single()) {
            echo '
                <h1>
                    <a href="'.get_the_permalink().'" title="'.get_the_title().'">'.
                        get_the_title().'
                    </a>
                </h1>
            ';
        } else {
            echo '
                <h2>
                    <a href="'.get_the_permalink().'" title="'.get_the_title().'">'.
                        sonha_highlight_search_keywords(get_the_title()).'
                    </a>
                </h2>
            ';
        }
    }
}

/**
 * Show post meta
 */
if (!function_exists('sonha_entry_meta')) {
    function sonha_entry_meta() {
        if (!is_page()) {
            echo '
                <div class="entry-meta">
                    <span class="author">'.__('Posted by ', TEXT_DOMAIN).get_the_author().'</span>
                    <span class="date-published">'.__('at ', TEXT_DOMAIN).get_the_date().'</span>
                    <span class="category">'.__('in ', TEXT_DOMAIN).get_the_category_list(', ').'</span>'.
                    (comments_open() ?
                        '<span class="meta-reply">'.
                            comments_popup_link(
                                __('Leave a comment', TEXT_DOMAIN),
                                __('One comment', TEXT_DOMAIN),
                                __('% comment(s)', TEXT_DOMAIN),
                                __('Read all comments', TEXT_DOMAIN),
                            ).
                        '</span>' : '').'
                </div>
            ';
        }
    }
}

/**
 * Show post content
 */
if (!function_exists('sonha_entry_content')) {
    function sonha_entry_content() {
        if (!is_single() && !is_page()) {
            // the_excerpt();
            echo sonha_highlight_search_keywords(get_the_excerpt());
        } else {
            the_content();
            // pagination in single page
            wp_link_pages([
                'before'           => '<p>'.__('Page: ', TEXT_DOMAIN),
                'after'            => '</p>',
                'nextpagelink'     => __('Next page', TEXT_DOMAIN),
                'previouspagelink' => __('Previous page', TEXT_DOMAIN),
            ]);
        }
    }
}

/**
 * Show content tags
 */
if (!function_exists('sonha_entry_tag'))  {
    function sonha_entry_tag() {
        if (has_tag()) {
            echo '
                <div class="entry-tag">
                    '.sprintf(
                        __('Tagged in %s', TEXT_DOMAIN),
                        get_the_tag_list('', ', ')
                    ).'
                </div>
            ';
        }
    }
}

if (!function_exists('sonha_get_latest_relative_posts')) {
    function sonha_get_latest_relative_posts() {
        $posts_not_in = [get_the_ID()];
        $category_ids = array_reduce(get_the_category() ?: [], function ($carry, $item) {
            $carry[] = $item->term_id;
            return $carry;
        }, []);
        $tag_ids = array_reduce(get_the_tags() ?: [], function ($carry, $item) {
            $carry[] = $item->term_id;
            return $carry;
        }, []);
        $post_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 2,
            'post__not_in' => $posts_not_in,
            'orderby' => ['post_modified' => 'DESC'],
            'tax_query' => [
                'relation' => 'OR',
                [
                    'taxonomy' => 'category',
                    'field' => 'id',
                    'terms' => $category_ids,
                    'include_children' => true,
                    'operator' => 'IN'
                ],
                [
                    'taxonomy' => 'tag',
                    'field' => 'id',
                    'terms' => $tag_ids,
                    'include_children' => true,
                    'operator' => 'IN'
                ],
            ],
        ]);

        if ($post_query->have_posts()) {
            while ($post_query->have_posts()) {
                $post_query->the_post();
                get_template_part('templates/partials/posts', 'relative');
            }
        }

        wp_reset_query();
    }
}

if (!function_exists('sonha_highlight_keywords')) {
    /**
     * Highlight the specified keywords
     *
     * @param  string $content
     * @param  string|array $keywords
     * @return string
     */
    function sonha_highlight_keywords($content = null, $keywords = []) {
        $title = is_null($content) ? get_the_title() : $content;
        if (!is_array($keywords)) {
            $keywords = explode(' ', $keywords);
        }
        $keys = implode('|', $keywords);
        return preg_replace(
            "/({$keys})/ui",
            '<span class="highlight-search">\0</span>',
            $title
        );
    }
}

if (!function_exists('sonha_highlight_search_keywords')) {
    /**
     * Highlight the search keywords
     *
     * @param  string $content
     * @param  string|array $keywords
     * @return string
     */
    function sonha_highlight_search_keywords($content) {
        return sonha_is_searching()
            ? sonha_highlight_keywords($content, get_search_query())
            : $content;
    }
}