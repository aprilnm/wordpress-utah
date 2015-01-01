<?php

define('BW_ADMIN_PATH', get_template_directory() . '/library/admin/');
define('BW_ADMIN_URL', get_template_directory_uri() . '/library/admin/');

Class BW_admin_control {

    function __construct() {
        add_action('admin_menu', array($this, 'BW_options_page'));
        add_action('admin_enqueue_scripts', array($this, 'BW_lode_admin_scripts'));
    }

    function BW_options_page() {
        add_theme_page('Theme Options', 'Theme Options', 'edit_theme_options', 'theme-option', array($this, 'BW_display_admin_view'));
    }

    function BW_display_admin_view() {
        if (!current_user_can('edit_theme_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'bizwrap'));
        }
        if (isset($_POST['BW_display_admin_form_submit'])) {
            update_option('bizwrap_theme_options', $_POST['bizwrap_theme_options']);
        }
        get_template_part('library/admin/template/admin-view');
    }

    function BW_lode_admin_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('my-upload');
        wp_enqueue_style('thickbox');
        wp_enqueue_script('adminjquery-ui', BW_ADMIN_URL . 'js/jquery-ui.js', array('jquery'));
        wp_enqueue_script('custom_script', BW_ADMIN_URL . 'js/admin_script.js', array('jquery', 'wp-color-picker'));
        wp_enqueue_style('custom-admin-social-share-css', BW_ADMIN_URL . 'css/admin-style.css');
        wp_enqueue_script('Vertical Tabs', BW_ADMIN_URL . 'js/jquery-jvert-tabs-1.1.4.js', array('jquery'), '1.1.4');
    }

}

new BW_admin_control();
?>
