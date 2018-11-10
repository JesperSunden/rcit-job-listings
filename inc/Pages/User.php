<?php
/**
 * @package RcitJobListings
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;

class User extends BaseController
{
    public $settings;

    public $wp_pages = array();

    public function register() {
        $this->settings = new SettingsApi(); 
    }

    public function on_activation() {
        
        $this->add_pages();

        $this->settings->add_wp_pages( $this->wp_pages )->register_wp_pages();

    }



    public function add_pages() {
        $this->wp_pages = array(
            array(
                'post_title'    => 'My Page',
                'post_content'  => 'This is my page',
                'post_status'   => 'publish',
                'post_type'     => 'page'
            ),
        );
    }
}