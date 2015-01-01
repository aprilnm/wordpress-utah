<?php
$AdminPath = get_template_directory() . '/library/admin/';
$functionPath = get_template_directory() . '/library/functions/';

/* * ************* INCLUDE ADMIN FILES*************** */
require_once ($AdminPath . 'admin-panel.php');
require_once ($functionPath . 'shortcodes/shortcodes.php');
require_once ($functionPath . 'widgets/widgets.php');
require_once ($functionPath . 'post-types.php');
require_once ($functionPath . 'custom-fields.php');
require_once ($functionPath . 'class-tgm-plugin-activation.php');

// Cleaning up the Wordpress Head
function bizwrap_head_cleanup() {
    // remove header links
    remove_action('wp_head', 'feed_links_extra', 3);                    // Category Feeds
    remove_action('wp_head', 'feed_links', 2);                          // Post and Comment Feeds
    remove_action('wp_head', 'rsd_link');                               // EditURI link
    remove_action('wp_head', 'wlwmanifest_link');                       // Windows Live Writer
    remove_action('wp_head', 'index_rel_link');                         // index link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);            // previous link
    remove_action('wp_head', 'start_post_rel_link', 10, 0);             // start link
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Links for Adjacent Posts
    remove_action('wp_head', 'wp_generator');                           // WP version
}

add_action('wp_head', 'bizwrap_custom_css');
function bizwrap_custom_css(){
    echo '<style type="text/css">'.get_bw_theme_options('custom_css').'</style>';
}

// launching operation cleanup
add_action('init', 'bizwrap_head_cleanup');

// remove WP version from RSS
function bizwrap_rss_version() {
    return '';
}

add_filter('the_generator', 'bizwrap_rss_version');

// loading jquery reply elements on single pages automatically
function bizwrap_queue_js() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
            wp_enqueue_script('comment-reply');
    }
}

// reply on comments script
add_action('wp_print_scripts', 'bizwrap_queue_js');

// Fixing the Read More in the Excerpts

function bizwrap_excerpt_length($length) {
    return 15;
}

add_filter('excerpt_length', 'bizwrap_excerpt_length', 999);

function bizwrap_excerpt_more($more) {
    global $post;
    // edit here if you like
    return '';
}

add_filter('excerpt_more', 'bizwrap_excerpt_more');

// Adding WP 3+ Functions & Theme Support
function bizwrap_theme_support() {
    add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
    //add_theme_support('custom-header');      // wp thumbnails (sizes handled in functions.php)
    //add_theme_support('custom-background');  // wp custom background
    add_theme_support('automatic-feed-links'); // rss thingy
    add_image_size('blog_fullwidth', '1140', '410', TRUE);
    //
    // adding post format support
    add_theme_support('menus');            // wp menus
    register_nav_menus(// wp3+ menus
            array(
                'main_nav' => 'The Main Menu', // main nav in header
            )
    );
}

// launching this stuff after theme setup
add_action('after_setup_theme', 'bizwrap_theme_support');

function bizwrap_main_nav() {
    // display the wp3 menu if available
    wp_nav_menu(
            array(
                'menu' => 'main_nav', /* menu name */
                'menu_class' => 'nav navbar-nav navbar-right',
                'theme_location' => 'main_nav', /* where in the theme it's assigned */
                'container' => 'false', /* container class */
                'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
                // 'depth' => '2',  suppress lower levels for now 
                'walker' => new Bizwrap_Bootstrap_walker()
            )
    );
}
function bizwrap_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bizwrap' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'bizwrap_wp_title', 10, 2 );

/* * **************** PLUGINS & EXTRA FEATURES ************************* */

// Numeric Page Navi (built into the theme by default)
function page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ($numposts <= $posts_per_page) {
        return;
    }
    if (empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;
    if ($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if ($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if ($start_page <= 0) {
        $start_page = 1;
    }

    echo $before . '<ul class="pagination">' . "";
    if ($paged > 1) {
        $first_page_text = "&laquo";
        echo '<li class="prev"><a href="' . get_pagenum_link() . '" title="First">' . $first_page_text . '</a></li>';
    }

    $prevposts = get_previous_posts_link('&larr; Previous');
    if ($prevposts) {
        echo '<li>' . $prevposts . '</li>';
    } else {
        echo '<li class="disabled"><a href="#">&larr; Previous</a></li>';
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $paged) {
            echo '<li class="active"><a href="#">' . $i . '</a></li>';
        } else {
            echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
        }
    }
    echo '<li class="">';
    next_posts_link('Next &rarr;');
    echo '</li>';
    if ($end_page < $max_page) {
        $last_page_text = "&raquo;";
        echo '<li class="next"><a href="' . get_pagenum_link($max_page) . '" title="Last">' . $last_page_text . '</a></li>';
    }
    echo '</ul>' . $after . "";
}

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content) {
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

// Set content width
if (!isset($content_width))
    $content_width = 580;
/* * *********** ACTIVE SIDEBARS ******************* */

// Sidebars & Widgetizes Areas
add_action('widgets_init', 'bizwrap_register_sidebars');

function bizwrap_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => 'Main Sidebar',
        'description' => 'Used on every page BUT the homepage page template.',
        'before_widget' => '<div id="%1$s" class="widget sidebar-box %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'sidebar2',
        'name' => 'Blog Sidebar',
        'description' => 'Used only on the blog page template.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'topleftbar',
        'name' => 'Top Left Sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'id' => 'toprightbar',
        'name' => 'Top Right Sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'id' => 'footer1',
        'name' => 'Footer 1',
        'before_widget' => '<div id="%1$s" class="widget footer-col %2$s">',
        'after_widget' => '</div><div class="space-20"></div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'id' => 'footer2',
        'name' => 'Footer 2',
        'before_widget' => '<div id="%1$s" class="widget footer-col %2$s">',
        'after_widget' => '</div><div class="space-20"></div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'id' => 'footer3',
        'name' => 'Footer 3',
        'before_widget' => '<div id="%1$s" class="widget footer-col %2$s">',
        'after_widget' => '</div><div class="space-20"></div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'id' => 'footer4',
        'name' => 'Footer 4',
        'before_widget' => '<div id="%1$s" class="widget footer-col %2$s">',
        'after_widget' => '</div><div class="space-20"></div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
}

// Comment Layout
function wp_bootstrap_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <div class="comment-box clearfix">
        <?php echo get_avatar($comment, $size = '75'); ?>

        <span>by | <?php comment_author($comment->comment_ID); ?> <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
        <p>
            <?php comment_text() ?>
        </p>
    </div><!--comment box-->
    <?php
}

add_filter('comment_form', 'bootstrap3_comment_button');

function bootstrap3_comment_button() {
    echo '<div class="col-md-12 text-right"><button id="submit" name="submit" class="btn btn-lg theme-btn-color" type="submit">Comment</button>
                                    </div>';
}

// don't remove this bracket!
// don't remove this bracket!
// Menu output mods
class Bizwrap_Bootstrap_walker extends Walker_Nav_Menu {

    function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0) {

        global $wp_query;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

// If the item has children, add the dropdown class for bootstrap
        if ($args->has_children) {
            $class_names = "dropdown ";
        }

        $classes = empty($object->classes) ? array() : (array) $object->classes;

        $class_names .= join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $object));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li id="menu-item-' . $object->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($object->attr_title) ? ' title="' . esc_attr($object->attr_title) . '"' : '';
        $attributes .=!empty($object->target) ? ' target="' . esc_attr($object->target) . '"' : '';
        $attributes .=!empty($object->xfn) ? ' rel="' . esc_attr($object->xfn) . '"' : '';
        $attributes .=!empty($object->url) ? ' href="' . esc_attr($object->url) . '"' : '';

        //if the item has children add these two attributes to the anchor tag
        if ($args->has_children) {
            $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $object->title, $object->ID);
        $item_output .= $args->link_after;

// if the item has children add the caret just before closing the anchor tag
        if ($args->has_children) {
            $item_output .= '<b class="caret"></b></a>';
        } else {
            $item_output .= '</a>';
        }

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $object, $depth, $args);
    }

// end start_el function

    function start_lvl(&$output, $depth = 0, $args = Array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

}

add_editor_style('editor-style.css');

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'add_active_class', 10, 2);

function add_active_class($classes, $item) {
    if ($item->menu_item_parent == 0 && in_array('current-menu-item', $classes)) {
        $classes[] = "active";
    }

    return $classes;
}

// enqueue styles
if (!function_exists("bizwrap_theme_styles")) {

    function bizwrap_theme_styles() {
// This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/library/bootstrap/css/bootstrap.min.css');
        wp_enqueue_style('ionicons', get_template_directory_uri() . '/library/icons/css/ionicons.css');
        wp_enqueue_style('bizwrap-custom-style', get_template_directory_uri() . '/library/css/styles.css');
// For child themes
        wp_enqueue_style('bizwrap-style', get_stylesheet_directory_uri() . '/style.css');
        /* --flex slider css */
        wp_enqueue_style('flexslider', get_template_directory_uri() . '/library/css/flexslider.css');
        /* animated css */
        wp_enqueue_style('animate', get_template_directory_uri() . '/library/css/animate.css');
        wp_enqueue_style('component', get_template_directory_uri() . '/library/css/component.css');
    }

}
add_action('wp_enqueue_scripts', 'bizwrap_theme_styles');

// enqueue javascript
if (!function_exists("bizwrap_theme_js")) {

    function bizwrap_theme_js() {
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
            wp_deregister_script('jquery');
            wp_enqueue_script('jquery', get_template_directory_uri() . '/library/js/jquery-1.10.2.min.js');
            wp_enqueue_script('jquery.easing', get_template_directory_uri() . '/library/js/jquery.easing.1.3.min.js', array('jquery'));
            wp_enqueue_script('bootstrap.min', get_template_directory_uri() . '/library/bootstrap/js/bootstrap.min.js', array('jquery'));
            wp_enqueue_script('bootstrap-hover-dropdown', get_template_directory_uri() . '/library/js/bootstrap-hover-dropdown.min.js', array('jquery'));
            wp_enqueue_script('flexslider-min', get_template_directory_uri() . '/library/js/jquery.flexslider-min.js', array('jquery'));
            wp_enqueue_script('jquery.mixitup.min', get_template_directory_uri() . '/library/js/jquery.mixitup.min.js', array('jquery'));
            wp_enqueue_script('custom-script', get_template_directory_uri() . '/library/js/app.js', array('jquery'), '1.0', TRUE);
        }
    }

}
add_action('wp_enqueue_scripts', 'bizwrap_theme_js');


function get_bw_theme_options($option) {
    $bw_theme_option = get_option('bizwrap_theme_options');
    return $bw_theme_option[$option];
}

function get_bw_sidebar() {
    global $post;
    $post_sidebar = get_post_meta($post->ID, '_bw_page_sidebar', true);
    return dynamic_sidebar($post_sidebar);
}

/* * ******ON ACTIVE THEME SET DEFAULT OPTION******** */
add_action("after_switch_theme", "setup_default_option");

function setup_default_option() {
    $default_option = array('logo_img' => get_template_directory_uri() . '/library/img/logo-dark.png', 'favicon_img' => get_template_directory_uri() . '/library/img/favicon.ico', 'top_widget' => '1', 'footer_copyright' => '&copy;2014.All right reserved. Designed by Webschool',
        'blog_per_page' => '10', 'blog_layout' => '2', 'portfolio_per_page' => '10', 'portfolio_layout' => '2',
        'social_share' => array('facebook' => '', 'twitter' => '', 'linkedin' => '', 'googleplus' => '', 'pinterest' => ''
        ), 'map' => array('active_map' => '1', 'zoom' => '12', 'scrollwheel' => true, 'draggable' => true, 'contact_address' => 'sydney australia'), 'custom_css' => '');
    add_option('bizwrap_theme_options', $default_option);
}

/* * *****************************Author Link******************** */

function bizwrap_author_posts($link) {
    global $authordata;
    $link = sprintf(
            '<a href="%1$s" title="%2$s" rel="author" class="hover-color">%3$s</a>', get_author_posts_url($authordata->ID, $authordata->user_nicename), esc_attr(sprintf(__('by %s', 'bizwrap'), get_the_author())), get_the_author()
    );
    return $link;
}

add_filter('the_author_posts_link', 'bizwrap_author_posts');

/* * **********************INSTALL PLUGIN********************************** */
add_action('tgmpa_register', 'bizwrap_register_required_plugins');

function bizwrap_register_required_plugins() {
    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name' => 'Contact Form 7', // The plugin name.
            'slug' => 'contact-form-7', // The plugin slug (typically the folder name).
            'source' => get_stylesheet_directory() . '/library/admin/contact-form-7.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        ),
    );

    $config = array(
        'id' => 'bizwrap_install_plugins', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'bizwrap-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'tgmpa'),
            'menu_title' => __('Install Plugins', 'tgmpa'),
            'installing' => __('Installing Plugin: %s', 'tgmpa'), // %s = plugin name.
            'oops' => __('Something went wrong with the plugin API.', 'tgmpa'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa'), // %1$s = plugin name(s).
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'tgmpa'),
            'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'tgmpa'),
            'return' => __('Return to Required Plugins Installer', 'tgmpa'),
            'plugin_activated' => __('Plugin activated successfully.', 'tgmpa'),
            'complete' => __('All plugins installed and activated successfully. %s', 'tgmpa'), // %s = dashboard link.
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa($plugins, $config);
}