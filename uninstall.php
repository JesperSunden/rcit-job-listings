<?php

/**
 * Trigger this file on Plugin uninstall
 * 
 * @package RcitJobListings
 */


if(! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

//Clear DB data of the post type created by the plugin
$books = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ) );

foreach( $books as $book ){
    wp_delete_post( $book->ID, true );
}