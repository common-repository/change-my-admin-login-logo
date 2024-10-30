<?php

if ( ! defined( 'ABSPATH' ) && ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

/**
 * Remove all options on deactivation hook
 */
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