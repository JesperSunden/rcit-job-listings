<?php
/*
* @package RcitJobListings
*/
/*
Plugin Name: RCIT Job Listings
Plugin URI: https://redcapesit.se
Description: A WordPress Plugin to quickly set up a site which with functionality such as; Create an account, manage your account, create and list jobs at your personal page.
Version: 1.0.0
Author: Jesper Sundén
Author URI: jespersunden.se
License: GPLv2 or later
Text Domain: rcit-job-listings
*/

/*
* Classes are writting with PascalCase
* Variables are written with camelCase
* Methods are written with underscores
*/

// Check if WP is accessing file, if else die;
if ( ! defined( 'ABSPATH' ) ) {
    echo 'Not that easy, buddy!';
    die;
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

use Inc\Activate;
use Inc\Deactivate;

if ( ! class_exists( 'RcitJobListings' ) ){
    class RcitJobListings
    {

        // Init Plugin basename variable
        public $plugin_basename;

        function __construct() {
            //Populate plugin basename
            $this->plugin_basename = plugin_basename( __FILE__ );
        }

        function register() {
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );

            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

            add_filter( "plugin_action_links_$this->plugin_basename", array( $this, 'settings_link' ) );
        }

        public function settings_link( $links ) {
            $settingsLink = '<a href="admin.php?page=rcit_job_listings">Settings</a>';
            array_push( $links, $settingsLink );

            return $links;
        }

        public function add_admin_pages() {
            add_menu_page( 'Job Listing', 'Job Listing', 'manage_options', 'rcit_job_listings', array( $this, 'admin_index' ), 'dashicons-nametag', 110 );
        }

        public function admin_index() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin-page.php';
        }

        protected function create_post_type() {
            add_action( 'init', array( $this, 'custom_post_type' ) );

        }

        function custom_post_type() {
            register_post_type( 'book', [ 'public' => true, 'label' => 'Books' ] ) ;
        }

        function enqueue() {
            wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/style.css', __FILE__ ) );
            wp_enqueue_script( 'mypluginsript', plugins_url( '/assets/script.js', __FILE__ ) );
            
        }

        function activate() {
            Activate::activate();
        }

        function deactivate() {
            Deactivate::deactivate();
        }
    }


    $rcitJobListings = new RcitJobListings();
    $rcitJobListings->register();


    // Activation
    register_activation_hook( __FILE__, array( $rcitJobListings, 'activate' ) );

    // Deactivation
    register_deactivation_hook( __FILE__, array( $rcitJobListings, 'deactivate' ) );
}
