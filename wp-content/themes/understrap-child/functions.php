<?php
function  wporg_css_body_class($classes){
    $classes[] = 'wporg-is-awesome';
    return $classes;
}
// add_filter('body_class', 'wporg_css_body_class', 10, 1);
add_action('wp-enqueue_scripts', 'understrap_remove_parent_styles', 11);
function understrap_remove_parent_styles() {
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');
    wp_enqueue_style( 'understrap-child', get_stylesheet_directory_uri().'/assets/css/bootstrap.min.css', array( '' ), false, 'all' );
}