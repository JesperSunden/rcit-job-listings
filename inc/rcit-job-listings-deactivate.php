<?php
/*
* @package RcitJobListings
*/

class RcitJobListingsDeactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}