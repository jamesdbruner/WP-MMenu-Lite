<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
Plugin Name: WP MMenu Lite (Mobile Menu)
Plugin URI: http://profiles.wordpress.org/jamesdbruner/
Description: Easily create and customize a mobile menu based on Fred Heusschen's <a href="http://mmenu.frebsite.nl/">mmenu.js</a>
Version: 1.0.0
Author: James Bruner
Author URI: http://profiles.wordpress.org/jamesdbruner/
License: GPLv2 or later
*/

	//Load Redux Framework
	if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/redux-framework/ReduxCore/framework.php' ) ) {
		require_once( dirname( __FILE__ ) . '/admin/redux-framework/ReduxCore/framework.php' );
	}
	if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/redux-framework/sample/sample-config.php' ) ) {
		require_once( dirname( __FILE__ ) . '/admin/admin-init.php' );;
	}

class mmenulite{

    // Constructor for the class.
    public function __construct() {

	   // Hook into the 'init' action & register/initialize the menu
	   add_action( 'init', array( $this, 'register_mmenu' ) );
	   add_action( 'wp_head', array( $this, 'init_menu' ) );

	   //include js-php mix thingy
	   add_action( 'wp_footer', array( $this, 'mmenu_init') );

	   // Add mmenu Shortcodes
	   add_shortcode( 'mmenu', array( $this, 'mmenubtn' ) );

	   // Enqueue scripts
	   add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	   // Add help link
	   add_filter( 'plugin_action_links_'. plugin_basename( __FILE__ ), array( $this, 'settings_link' ) );

    }

    // Register Navigation Menus
    public function register_mmenu() {

	   $locations = array('mmenu' => 'Mobile Menu');
	   register_nav_menus( $locations );

    }

    //Enqueue js and css
    public function enqueue_scripts() {

	   	wp_enqueue_script( 'mmenu-all-min-js' , plugins_url('/js/jquery.mmenu.min.all.js', __FILE__), array('jquery'), null, false );
	   	wp_register_style('mmenu-all-css', plugins_url('/css/jquery.mmenu.all.css', __FILE__), '', null, 'all');
	   	wp_enqueue_style('mmenu-all-css');

    }

    public function mmenu_init() {

	   include_once('js/mmenu.init.php');

    }

    public function mmenubtn($atts, $content = null) {

	   return '<a href="#mmenu">'. $content .'</a>';
  
    }

    public function init_menu() {

	   wp_nav_menu( array( 'theme_location' => 'mmenu', 'menu' => 'Mobile Menu', 'container' => 'nav', 'container_id' => 'mmenu' ) );

    }

    public function settings_link($links){

	   $settings_link = '<a href="options-general.php?page=mmenu_options_lite">Settings</a>';
	   array_push( $links, $settings_link );
	   return $links;
    } 
}

// Instantiate the class.
$mmenulite = new mmenulite();