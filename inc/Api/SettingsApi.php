<?php
/**
 * @package RcitJobListings
 */

namespace Inc\Api;

class SettingsApi
{
    //Admin Pages variables
    public $admin_pages = array();
    public $admin_subpages = array();

    //Admin Pages setting variables
    public $settings = array();
    public $sections = array();
    public $fields = array();

    public $wp_pages = array();

    public function register() {
        if ( ! empty($this->admin_pages) ) {
            add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        }

        if ( ! empty($this->settings) ) {
            add_action( 'admin_init', array( $this, 'register_custom_fields' ) );
        }
    }

    public function add_pages(array $pages) {
        $this->admin_pages = $pages;  

        return $this;
    }

    public function with_sub_page(string $title = null) {
        if ( empty( $this->admin_pages ) ) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = array(
            array(
                'parent_slug'   => $admin_page['menu_slug'],
                'page_title'    => $admin_page['page_title'],
                'menu_title'    => ($title) ? $title : $admin_page['menu_title'],
                'capability'    => $admin_page['capability'],
                'menu_slug'     => $admin_page['menu_slug'],
                'callback'      => $admin_page['callback']
            )
        );

        $this->admin_subpages = $subpage;

        return $this;
    }

    public function add_subpages( array $pages) {
        $this->admin_subpages = array_merge( $this->admin_subpages ,$pages );

        return $this;
    }

    public function add_admin_menu() {
        foreach ( $this->admin_pages as $page ) {
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
        }

        foreach ( $this->admin_subpages as $page ) {
            add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback']);
        }
    }

    /**
     * Setting the admin pages settings fields
     */

    public function set_settings(array $settings) {
        $this->settings = $settings;  

        return $this;
    }

    public function set_sections(array $sections) {
        $this->sections = $sections;  

        return $this;
    }

    public function set_fields(array $fields) {
        $this->fields = $fields;  

        return $this;
    }

    /**
     * Register WordPress functions for looping through and create custom fileds
     * in admin area.
     */
    public function register_custom_fields() {
        // Register setting
        foreach ( $this->settings as $setting ) {
            register_setting( $setting['option_group'], $setting['option_name'], ( isset( $setting['callback'] ) ? $setting['callback'] : '' ) );
        }
        // Add setting section
        foreach ( $this->sections as $section ) {
            add_settings_section( $section['id'], $section['title'], ( isset( $section['callback'] ) ? $section['callback'] : '' ), $section['page'] );
        }
        // Add settings field
        foreach ( $this->fields as $field ) {
            add_settings_field($field['id'], $field['title'], ( isset( $field['callback'] ) ? $field['callback'] : '' ), $field['page'], $field['section'], ( isset( $field['args'] ) ? $field['args'] : '' ) );
        }
    }

    public function add_wp_pages(array $wp_pages) {
        $this->wp_pages = $wp_pages;

        return $this;
    }

    public function register_wp_pages() {
        //Adding WP Pages
        foreach ( $this->wp_pages as $wp_page ) {
            $post_object = array(
                'post_content' => $wp_page['post_content'],
                'post_title' => $wp_page['post_title'],
                'post_type'     => $wp_page['post_type'],
                'post_status'   => $wp_page['post_status'],
            );
            
            wp_insert_post( $post_object );
        }
    }
}