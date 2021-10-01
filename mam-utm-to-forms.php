<?php
/**
 * Plugin Name: Move Ahead Media UTM To Forms
 * Plugin URI: https://github.com/moveaheadmedia/mam-utm-to-forms/
 * Description: This plugin helps users to get utm data into contact forms hidden fields!
 * Version: 1.0
 * Author: Move Ahead Media
 * Author URI: https://github.com/moveaheadmedia
 * Requires jQuery to be installed and ACF Pro plugin
 */

function mam_utm_to_forms_admin_options() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {
        // parent page
        acf_add_options_page(array(
            'page_title' 	=> 'UTM To Forms',
            'menu_title'	=> 'UTM To Forms',
            'menu_slug' 	=> 'mam-utm-to-forms',
            'capability'	=> 'read',
            'redirect'		=> true
        ));

        // child page
        acf_add_options_sub_page(array(
            'page_title' 	=> 'UTM To Forms Options',
            'menu_title'	=> 'UTM To Forms Options',
            'menu_slug'  => 'mam-utm-to-forms-options',
            'capability'	=> 'read',
            'parent_slug'	=> 'mam-utm-to-forms'
        ));
    }
}

add_action('plugins_loaded', 'mam_utm_to_forms_admin_options');
