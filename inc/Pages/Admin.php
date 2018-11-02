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

        $this->set_settings();

        $this->set_sections();

        $this->set_fields();

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

    public function set_settings() {
        $args = array(
            array(
                'option_group'  => 'job_listing_option_group',
                'option_name'   => 'text_example',
                'callback'      => array( $this->callbacks, 'job_listings_option_group' )
            ),
        );

        $this->settings->set_settings( $args );
    }

    public function set_sections() {
        $args = array(
            array(
                'id'            => 'job_listing_admin_index',
                'title'         => 'Settings',
                'callback'      => array( $this->callbacks, 'job_listings_admin_section' ),
                'page'          => 'rcit_job_listings'
            ),
        );

        $this->settings->set_sections( $args );
    }

    public function set_fields() {
        $args = array(
            array(
                'id'            => 'text_example',
                'title'         => 'Text example',
                'callback'      => array( $this->callbacks, 'job_listings_text_example' ),
                'page'          => 'rcit_job_listings',
                'section'       => 'job_listing_admin_index',
                'args'          => array(
                    'label_for'     => 'text_example',
                    'class'         => 'example-class'
                ),
            ),
        );

        $this->settings->set_fields( $args );
    }
}