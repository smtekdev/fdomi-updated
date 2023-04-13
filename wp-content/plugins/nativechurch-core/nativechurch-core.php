<?php
/*
Plugin Name: NativeChurch Core
Plugin URI: https://demo.imithemes.com/native-church-wp/
Description: NativeChurch core plugin includes all features of NativeChurch theme in a plugin for a better user experience.
Version: 1.6
Author: Imithemes
Author URI: https://imithemes.com/
Licence:     GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Copyright:   (c) 2020 imithemes. All rights reserved
Domain Path: /languages
Text Domain: imithemes
*/

// Do not allow direct access to this file.
defined('ABSPATH') or die('No script kiddies please!');
define('NATIVECHURCH_CORE__PLUGIN_PATH', plugin_dir_path(__FILE__));
define('NATIVECHURCH_CORE__PLUGIN_URL', plugin_dir_url(__FILE__));
/* PARTIALS ATTACHMENTS
================================================== */
require_once NATIVECHURCH_CORE__PLUGIN_PATH . 'includes.php';
/* SET LANGUAGE FILE FOLDER
=================================================== */
add_action('plugins_loaded', 'nativechurch_core_load_textdomain');
function nativechurch_core_load_textdomain()
{
    load_plugin_textdomain('imithemes', false, basename(dirname(__FILE__)) . '/languages');
}