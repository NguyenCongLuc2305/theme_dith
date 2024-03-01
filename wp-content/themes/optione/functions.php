<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets.
 *
 * @package Optione
 */

if( !defined('THEME_DEV_MODE_ELEMENTS') && is_user_logged_in()){
    define('THEME_DEV_MODE_ELEMENTS', true);
}
use Elementor\Plugin;

require_once get_template_directory() . '/inc/classes/class-main.php';

if (is_admin()) {
    require_once get_template_directory() . '/inc/admin/admin-init.php';
}

/**
 * Theme Require
 */
optione()->require_folder('inc');
optione()->require_folder('inc/classes');
optione()->require_folder('inc/theme-options');
optione()->require_folder('template-parts/widgets');
if (class_exists('Woocommerce')) {
    optione()->require_folder('woocommerce');
}
 