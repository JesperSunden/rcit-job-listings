<?php
/**
 * @package RcitJobListings
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function admin_settings() {
       return require_once( "$this->plugin_path/templates/admin-settings-page.php" ); 
    }

    public function admin_users() {
        return require_once( "$this->plugin_path/templates/admin-users-page.php" );
    }

    public function admin_jobs() {
        return require_once( "$this->plugin_path/templates/admin-jobs-page.php" );
    }

    public function job_listings_option_group( $input ) {
        return $input;
    }

    public function job_listings_admin_section() {
        echo 'check this beautiful section';
    }

    public function job_listings_text_example() {
        $value = esc_attr( get_option( 'text_example' ) );
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Text goes here">';
    }

}