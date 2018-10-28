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

}