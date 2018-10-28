<?php
/*
* @package RcitJobListings
*/

class RcitJobListingsActivate
{
    public static function activate() {
        flush_rewrite_rules();
    }
}