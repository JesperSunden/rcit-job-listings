<?php
/**
 * @package RcitJobListings
 */

namespace Inc\Base;

class Enqueue
{
    public function register() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue') );
    }

    function enqueue() {
        wp_enqueue_style( 'mypluginstyle', PLUGIN_URL . 'assets/style.css' );
        wp_enqueue_script( 'mypluginsript', PLUGIN_URL . 'assets/script.js' );             
    }
}