<?php
/**
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

// Check if WP is accessing file, if else die;
if ( ! defined( 'ABSPATH' ) ) {
    echo 'Not that easy, buddy!';
    die;
}

// Require once Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Code runs during activation of plugin
 */
function activate_rcit_job_listings() {
    Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_rcit_job_listings' );

/**
 * Code runs during deactivation of plugin
 */
function deactivate_rcit_job_listings() {
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_rcit_job_listings' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::register_services();
}
