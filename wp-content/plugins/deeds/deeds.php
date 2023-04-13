<?php
/*
Plugin Name: Deeds Theme Support 
Plugin URI: http://themeforest.net/user/webinane/
Description: Supported plugin for deeds wordpress theme
Author: Webinane
Version: 1.4
Author URI: https://themeforest.net/user/webinane/
*/
$theme_path = get_template_directory().'/envato_setup/envato_setup.php'; 

if(! file_exists( $theme_path ) ) {
    return;
}
defined( 'deeds_PLUGIN_PATH' ) || define( 'deeds_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
defined( 'deeds_PLUGIN_URL' ) || define( 'deeds_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
defined( 'DEEDS_NAME' ) or define( 'DEEDS_NAME', 'wp_deeds' );
load_plugin_textdomain( 'wp_deeds', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
require_once deeds_PLUGIN_PATH . 'functions.php';
require_once deeds_PLUGIN_PATH . 'taxonomies.php';
add_action('init', 'deeds_custom_post_type');
add_action( 'init', 'registered_taxonomies');
require_once WP_PLUGIN_DIR. '/deeds/vafpress/bootstrap.php';
add_action( 'after_setup_theme', 'themes_Vafpress_load', 10, 2 ); 
function themes_Vafpress_load() {

$tmpl_opt = WP_PLUGIN_DIR . '/deeds/vafpress/admin/option/option.php';
include_once( WP_PLUGIN_DIR . '/deeds/vp_new/loader.php' );


require_once(WP_PLUGIN_DIR . '/deeds/vafpress/admin/data_sources.php');

require_once WP_PLUGIN_DIR . '/deeds/includes/Deeds_Resizer.php';


$tmpl_mb1 = include_once(WP_PLUGIN_DIR . '/deeds/vafpress/admin/metabox/meta_boxes.php');



$theme_options = new VP_Option(array(

    'is_dev_mode' => false, // dev mode, default to false

    'option_key' => 'wp_deeds_theme_options', // options key in db, required

    'page_slug' => 'wp_deeds' . '_option', // options page slug, required

    'template' => $tmpl_opt, // template file path or array, required

    'menu_page' => 'themes.php', // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu

    'use_auto_group_naming' => true, // default to true

    'use_util_menu' => true, // default to true, shows utility menu

    'minimum_role' => 'edit_theme_options', // default to 'edit_theme_options'

    'layout' => 'fluid', // fluid or fixed, default to fixed

    'page_title' => __('Theme Options', 'wp_deeds'), // page title

    'menu_label' => __('Theme Options', 'wp_deeds'), // menu label

        ));

// * Create instances of Metaboxes



foreach ((array) $tmpl_mb1 as $tmb)

    new VP_Metabox($tmb);



$tmpl_mb1 = include WP_PLUGIN_DIR. '/deeds/vafpress/admin/taxonomy/taxonomy.php';



include_once( WP_PLUGIN_DIR . '/deeds/vp_new/taxonomy.php' );

foreach ($tmpl_mb1 as $tmb)

    new SH_Metabox($tmb);
}
