<?php

class Sonha_Custom_Nav_Walker extends Walker_Nav_Menu
{
    /**
     * @override
     *
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n{$indent}<ul class=\"dropdown-menu\">\n";
    }

    /**
     * @override
     *
     * Ends the list of after the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::end_lvl()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent  = str_repeat("\t", $depth);
        $output .= "{$indent}</ul>\n";
    }

    /**
     * @override
     *
     * Starts the element output.
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     * @see Walker::start_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item= 0, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat( "\t", $depth ) : '';

        /*===== Edit attributes of li tag =====*/
        $li_class = '';
        $a_class = '';

        // classes of wordpress
        $wp_li_classes = empty($item->classes) ? [] : (array) $item->classes;
        $wp_li_classes[] = "menu-item-{$item->ID}";

        /*@hook Filters the arguments for a single nav menu item */
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        // Filters the CSS classes applied to a menu item's list item element
        $li_class = implode(' ', apply_filters('nav_menu_css_class', array_filter($wp_li_classes), $item, $args, $depth));

        if ($args->has_children) {
            $li_class .= $depth === 0 ? ' dropdown' : ' dropdown-submenu';
        }

        // Active link
        if (in_array('current-menu-item', $wp_li_classes)) {
            $a_class .= ' active';
        }

        $li_class = $li_class ? ' class="' . esc_attr($li_class) . '"' : '';
        $a_class = $a_class ? ' class="' . esc_attr($a_class) . '"' : '';

        /*@hook Filters the ID applied to a menu item's list item element */
        $li_id = apply_filters('nav_menu_item_id', "menu-item-{$item->ID}", $item, $args, $depth);
        $li_id = $li_id ? ' id="' . esc_attr($li_id) . '"' : '';

        // Combine li tag
        $output .= "{$indent}<li{$li_id}{$li_class}>";
        /*===== End - Edit attributes of li tag =====*/

        /*===== Edit attributes of a tag =====*/
        $atts = [];
        $atts['title']  = !empty($item->title)	? $item->title	: '';
        $atts['target'] = !empty($item->target)	? $item->target	: '';
        $atts['rel']    = !empty($item->xfn)	? $item->xfn	: '';

        // If item has_children add atts to a.
        // if ( $args->has_children && $depth === 0 ) {
        if ($args->has_children) { // level 1
            $atts['href']   	 = '#';
            $atts['data-toggle'] = 'dropdown';
            $atts['data-child-status'] = '1';
            $atts['class']		 = 'dropdown-toggle';
        } else { // level 0
            $atts['href'] = !empty($item->url) ? $item->url : '';
            $atts['data-parent-status'] = '0';
        }

        /*@hook Filters attributes */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $a_attr = '';
        $atts_allowed_empty = ['data-parent-status', 'data-child-status'];
        foreach ($atts as $attr => $value) {
            if (!empty($value) || in_array($attr, $atts_allowed_empty)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $a_attr .= ' ' . $attr . '="' . $value . '"';
            }
        }

        // Build a tag
        $item_output = $args->before;
        $item_output .= "<a {$a_attr} {$a_class}>";
        /*===== End - Edit attributes of a tag =====*/

        /*@hook This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);
        /*@hook  Filters a menu item's title */
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output .= $args->link_before.$title.$args->link_after;
        $item_output .=  ($args->has_children && $depth === 0) ? ' <i class="zmdi zmdi-chevron-down"></i></a>' : '</a>';
        $item_output .= $args->after;

        /*@hook Filters a menu item's starting output */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * @override
     *
     * Ends the element output, if needed.
     *
     * @since 3.0.0
     *
     * @see Walker::end_el()
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Page data object. Not used.
     * @param int      $depth  Depth of page. Not Used.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }

    /**
     * @override
     *
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        if (!$element) {
            return;
        }

        $id_field = $this->db_fields['id'];

        // Display this element.
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * @override
     *
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback($args)
    {
		if ( current_user_can( 'manage_options' ) ) {
			extract( $args );

			$fb_output = null;
			if ( $container ) {
				$fb_output = '<' . $container;
				if ( $container_id ) {
                    $fb_output .= ' id="' . $container_id . '"';
                }
				if ( $container_class ) {
                    $fb_output .= ' class="' . $container_class . '"';
                }
				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id ) {
                $fb_output .= ' id="' . $menu_id . '"';
            }

			if ( $menu_class ) {
                $fb_output .= ' class="' . $menu_class . '"';
            }

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container ) {
                $fb_output .= '</' . $container . '>';
            }

			echo $fb_output;
		}
	}
}