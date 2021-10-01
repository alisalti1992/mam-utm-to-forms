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


// Storing URL parameters
add_action( 'init', 'mam_utm_to_forms_init_parameters' );
function mam_utm_to_forms_init_parameters() {
	$mam_parameters = array();
	$original       = array();
	if ( isset( $_COOKIE['mam_utm_to_forms_parameters'] ) ) {
		$original = json_decode( $_COOKIE['mam_utm_to_forms_parameters'], true );
	}
	if ( isset( $_GET['utm_source'] ) ) {
		if ( ! isset( $original['utm_source'] ) || $original['utm_source'] == '' ) {
			$mam_parameters['utm_source'] = $_GET['utm_source'];
		}
	}
	if ( isset( $_GET['utm_medium'] ) ) {
		if ( ! isset( $original['utm_medium'] ) || $original['utm_medium'] == '' ) {
			$mam_parameters['utm_medium'] = $_GET['utm_medium'];
		}
	}
	if ( isset( $_GET['utm_campaign'] ) ) {
		if ( ! isset( $original['utm_campaign'] ) || $original['utm_campaign'] == '' ) {
			$mam_parameters['utm_campaign'] = $_GET['utm_campaign'];
		}
	}
	if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
		if ( ! isset( $original['referral_url'] ) || $original['referral_url'] == '' ) {
			$mam_parameters['referral_url'] = $_SERVER['HTTP_REFERER'];
		}
	}

	setcookie( 'mam_utm_to_forms_parameters', json_encode( $mam_parameters ), time() + ( 3600 * 24 * 10 ), '/' );
}


// Create the admin options page
add_action( 'plugins_loaded', 'mam_utm_to_forms_admin_options' );
function mam_utm_to_forms_admin_options() {

	// Check function exists.
	if ( function_exists( 'acf_add_options_page' ) ) {
		// parent page
		acf_add_options_page( array(
			'page_title' => __( 'UTM To Forms' ),
			'menu_title' => __( 'UTM To Forms' ),
			'menu_slug'  => 'mam-utm-to-forms',
			'capability' => 'read',
			'redirect'   => true
		) );

		// child page
		acf_add_options_sub_page( array(
			'page_title'  => __( 'UTM To Forms Options' ),
			'menu_title'  => __( 'UTM To Forms Options' ),
			'menu_slug'   => 'mam-utm-to-forms-options',
			'capability'  => 'read',
			'parent_slug' => 'mam-utm-to-forms'
		) );
	}
}

// Add plugin action links
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'mam_utm_to_forms_settings_link' );
function mam_utm_to_forms_settings_link( $links ) {
	// Build and escape the URL.
	$url = esc_url( add_query_arg(
		'page',
		'mam-utm-to-forms-options',
		get_admin_url() . 'admin.php'
	) );
	// Create the link.
	$settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
	// Adds the link to the end of the array.
	array_push(
		$links,
		$settings_link
	);

	return $links;
}

// Add advanced custom fields
add_action( 'plugins_loaded', 'mam_utm_to_forms_custom_fields' );
function mam_utm_to_forms_custom_fields() {
	if ( function_exists( 'acf_add_local_field_group' ) ):

		acf_add_local_field_group( array(
			'key'                   => 'group_6156880fc550e',
			'title'                 => 'UTM to Forms Fields Mapping',
			'fields'                => array(
				array(
					'key'               => 'field_6156890592082',
					'label'             => 'Page',
					'name'              => 'page',
					'type'              => 'text',
					'instructions'      => 'The hidden input field name to map with the page, Ex: pageURL any field with the name pageURL will be auto filled with the current page URL.',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'mam_page',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_6156895692083',
					'label'             => 'utm_source',
					'name'              => 'utm_source',
					'type'              => 'text',
					'instructions'      => 'The hidden input field name to map with the utm_source, Ex: mam_utm_source any field with the name mam_utm_source will be auto filled with the original utm_source',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'mam_utm_source',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_6156898292084',
					'label'             => 'utm_medium',
					'name'              => 'utm_medium',
					'type'              => 'text',
					'instructions'      => 'The hidden input field name to map with the utm_medium, Ex: mam_utm_source any field with the name mam_utm_medium will be auto filled with the original utm_medium',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'mam_utm_medium',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_6156899992085',
					'label'             => 'utm_campaign',
					'name'              => 'utm_campaign',
					'type'              => 'text',
					'instructions'      => 'The hidden input field name to map with the utm_campaign, Ex: mam_utm_campaign any field with the name mam_utm_campaign will be auto filled with the original utm_campaign',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'mam_utm_campaign',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_615689d092086',
					'label'             => 'referral_url',
					'name'              => 'referral_url',
					'type'              => 'text',
					'instructions'      => 'The hidden input field name to map with the referral_url, Ex: mam_referral_url any field with the name mam_referral_url will be auto filled with the original referral_url',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'mam_referral_url',
					'placeholder'       => '',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_615688219207f',
					'label'             => 'Custom Fields Mapping',
					'name'              => 'custom_fields_mapping',
					'type'              => 'repeater',
					'instructions'      => 'Used for custom parameters you want to send to forms that are not showing above!',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'collapsed'         => '',
					'min'               => 0,
					'max'               => 0,
					'layout'            => 'table',
					'button_label'      => '',
					'sub_fields'        => array(
						array(
							'key'               => 'field_6156884292080',
							'label'             => 'Parameter',
							'name'              => 'parameter',
							'type'              => 'text',
							'instructions'      => 'Ex: 
utm_campaign
referral-code
randomParameter',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
							'maxlength'         => '',
						),
						array(
							'key'               => 'field_615688d092081',
							'label'             => 'Field Name',
							'name'              => 'name',
							'type'              => 'text',
							'instructions'      => 'The hidden input field name to make with the parameters!',
							'required'          => 1,
							'conditional_logic' => 0,
							'wrapper'           => array(
								'width' => '',
								'class' => '',
								'id'    => '',
							),
							'default_value'     => '',
							'placeholder'       => '',
							'prepend'           => '',
							'append'            => '',
							'maxlength'         => '',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'mam-utm-to-forms-options',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		) );

	endif;
}