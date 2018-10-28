<?php
/**
 * @package RcitJobListings
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
    public $settings;

    public $pages = array();
    public $subpages = array();

    public function __construct() {

        $this->settings = new SettingsApi();

        $this->pages = array(
            array(
                'page_title'    => 'Job Listing',
                'menu_title'    => 'Job Listing',
                'capability'    => 'manage_options',
                'menu_slug'     => 'rcit_job_listings',
                'callback'      => function() { echo '<h1>Settings</h1>'; },
                'icon_url'      => 'dashicons-nametag',
                'position'      => 110
            ),
        );

        $this->subpages = array(
            array(
                'parent_slug'   => 'rcit_job_listings',
                'page_title'    => 'Users',
                'menu_title'    => 'Users',
                'capability'    => 'manage_options',
                'menu_slug'     => 'rcit_job_listings_users',
                'callback'      => function() { echo '<h1>Users</h1>'; }
            ),
            array(
                'parent_slug'   => 'rcit_job_listings',
                'page_title'    => 'Jobs',
                'menu_title'    => 'Jobs',
                'capability'    => 'manage_options',
                'menu_slug'     => 'rcit_job_listings_jobs',
                'callback'      => function() { echo '<h1>Jobs</h1>'; }
            ),
        );
    }

    public function register() {
        $this->settings->add_pages( $this->pages )->with_sub_page( 'Settings' )->add_subpages( $this->subpages )->register();
    }
}