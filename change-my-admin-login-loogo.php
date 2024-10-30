<?php
/*
Plugin Name: Change My Admin Login Logo
Plugin URI: arunupadhyay.com.np
Description: Change My Admin Login Logo
Version: 1.0
Author: Arun Upadhyay
Author URI: arunupadhayay.com.np
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Access denied ! Please Login' );
}


include_once( ABSPATH . 'wp-includes/pluggable.php' );
require_once plugin_dir_path( __FILE__ ) . 'includes/loader.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/wp_login_logo_operation.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/option_constants.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/change_admin_login.php';


$cMYWLL_Change_My_Login_Logo = new CMYWLL_Change_My_Login_Logo();
$cMYWLL_Change_My_Login_Logo = new CMYWLL_New_Login_Logo();

function cmywll_deactivate_on_change_my_login_logo() {
	$options_array =
		[
			CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_URL,
			CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_WIDTH,
			CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_HEIGHT
		];
	foreach ( $options_array as $option ) {
		delete_option( $option );
	}
}

register_deactivation_hook( __FILE__, 'cmywll_deactivate_on_change_my_login_logo' );