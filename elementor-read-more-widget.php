<?php
/*
Plugin Name: Elementor Read More Widget
Description: A custom "Read More" widget for Elementor with a text editor.
Version: 1.0
Author: Maia Internet Consulting.
Text Domain: elementor-read-more-widget
*/

// Prevent direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Hook to load the widget after Elementor is loaded
function ermw_load_widget($widgets_manager) {
    // Check if Elementor is active
    
    require_once( __DIR__ . '/widgets/read-more-widget.php' );
    
    $widgets_manager->register( new \Elementor_Read_More_Widget() );

}
add_action( 'elementor/widgets/register', 'ermw_load_widget' );

// Enqueue the necessary assets (CSS & JS)
function ermw_enqueue_assets() {
    wp_enqueue_style( 'ermw-style', plugin_dir_url( __FILE__ ) . 'assets/css/read-more-widget.css' );
    wp_enqueue_script( 'ermw-script', plugin_dir_url( __FILE__ ) . 'assets/js/read-more-widget.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'ermw_enqueue_assets' );
