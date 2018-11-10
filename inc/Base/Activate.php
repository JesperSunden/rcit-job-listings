<?php
/**
 * @package RcitJobListings
 */
namespace Inc\Base;

use \Inc\Pages\User;

class Activate
{
    public static function activate() {
        $user = new User();

        $user->register();
        $user->on_activation();

        flush_rewrite_rules();
    }
}