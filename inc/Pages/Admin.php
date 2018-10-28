<?php
/**
 * @package RcitJobListings
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;

class Admin extends BaseController
{
    public function register() {
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
    }

    public function add_admin_pages() {
            add_menu_page( 'Job Listing', 'Job Listing', 'manage_options', 'rcit_job_listings', array( $this, 'admin_index' ), 'dashicons-nametag', 110 );
    }

    public function admin_index() {
        require_once $this->plugin_path . 'templates/admin-page.php';
    }
}