<?php

/* * ************* SLIDER POST-TYPES  *************** */
add_action('init', 'slider_items_register');

function slider_items_register() {
    $args = array(
        'label' => 'Slider',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'page',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
        'labels' => array(
  'add_new_item' => 'Add New Slider',
  'edit' => 'Edit',
  'edit_item' => 'Edit Slider',
  'new_item' => 'New Slider',
        ),
        'menu_icon' => 'dashicons-slides'
    );
    register_post_type('slider', $args);
}

add_filter("manage_edit-slider_columns", "slider_edit_columns");
add_action("manage_posts_custom_column", "slider_columns_display");

function slider_edit_columns($slider_columns) {
    $slider_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Slide Title",
        "description" => "Description",        
        'slider_image' => 'Image',
    );
    return $slider_columns;
}

function slider_columns_display($slider_columns) {
    switch ($slider_columns) {
        case "description":
            the_excerpt();
            break;
        case 'slider_image':
            the_post_thumbnail(array(60, 60));
            break;
        case 'slide_url':
            $custom = get_post_custom();
            echo $custom['slide_url'][0];
            break;
    }
}

/* * ************* PORTFOLIO POST-TYPES  *************** */
add_action('init', 'portfolio_register');

function portfolio_register() {

    register_post_type('portfolio', array(
        'label' => 'Portfolio',
        'singular_label' => 'Portfolio',
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'menu_position' => null,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'page',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'portfolio', 'with_front' => false),
        'edit_item' => __('Edit Portfolio', 'Bizwrap'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions'),
        'labels' => array('add_new_item' => 'Add New portfolio', 'edit' => 'Edit', 'edit_item' => 'Edit portfolio', 'new_item' => 'New portfolio'),
        'menu_icon' => 'dashicons-portfolio'
)
    );

    register_taxonomy('portfolio_category', 'portfolio', array('hierarchical' => true,
        'label' => __('Categories', 'Bizwrap'),
        'singular_label' => __('Category', 'Bizwrap'),
        'public' => true,
        'show_tagcloud' => false,
        'query_var' => 'true',
        'rewrite' => array('slug' => 'portfolio_category', 'with_front' => false)
            )
    );

    add_filter('manage_edit-portfolio_columns', 'portfolio_edit_columns');
    add_action('manage_posts_custom_column', 'portfolio_custom_columns');

    function portfolio_edit_columns($columns) {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => 'Title',
            'portfolio_category' => 'Category',
            'portfolio_description' => 'Description',
            'portfolio_image' => 'Image Preview'
        );

        return $columns;
    }

    function portfolio_custom_columns($column) {
        global $post;
        switch ($column) {
            case "portfolio_category":
                echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', '');
                break;

            case 'portfolio_description':
                the_excerpt();
                break;

            case 'portfolio_image':
                the_post_thumbnail(array(60, 60));
                break;
        }
    }

}

function my_post_type_link_filter_function($post_link, $id = 0, $leavename = FALSE) {
    if (strpos('%portfolio_category%', $post_link) < 0) {
        return $post_link;
    }
    $post = get_post($id);
    if (!is_object($post) || $post->post_type != 'portfolio') {
        return $post_link;
    }
    $terms = wp_get_object_terms($post->ID, 'portfolio_category');
    if (!$terms) {
        return str_replace('portfolio/category/%portfolio_category%/', '', $post_link);
    }
    return str_replace('%portfolio_category%', $terms[0]->slug, $post_link);
}

add_filter('post_type_link', 'my_post_type_link_filter_function', 1, 3);
?>
