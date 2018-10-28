<?php
/**
 * @package RcitJobListings
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings;

    public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register() {
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->set_pages();

        $this->set_subpages();

        $this->settings->add_pages( $this->pages )->with_sub_page( 'Settings' )->add_subpages( $this->subpages )->register();
    }

    public function set_pages() {
        $this->pages = array(
            array(
                'page_title'    => 'Job Listing',
                'menu_title'    => 'Job Listing',
                'capability'    => 'manage_options',
                'menu_slug'     => 'rcit_job_listings',
                'callback'      => array( $this->callbacks, 'admin_settings'),
                'icon_url'      => 'dashicons-nametag',
                'position'      => 110
            ),
        );
    }

    public function set_subpages() {
        $this->subpages = array(
            array(
                'parent_slug'   => 'rcit_job_listings',
                'page_title'    => 'Users',
                'menu_title'    => 'Users',
                'capability'    => 'manage_options',
                'menu_slug'     => 'rcit_job_listings_users',
                'callback'      => array( $this->callbacks, 'admin_users' )
            ),
            array(
                'parent_slug'   => 'rcit_job_listings',
                'page_title'    => 'Jobs',
                'menu_title'    => 'Jobs',
                'capability'    => 'manage_options',
                'menu_slug'     => 'rcit_job_listings_jobs',
                'callback'      => array( $this->callbacks, 'admin_jobs' )
            ),
        );
    }
}