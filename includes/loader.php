<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class to add menu to dashboard, add bootstraps & scripts
 *
 * Class CMYWLL_Change_My_Login_Logo
 */
class CMYWLL_Change_My_Login_Logo {

	function __construct() {

		add_action( 'admin_menu', [ $this, 'cmywll_add_menu_option_to_wp_admin_dashboard' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'cmywll_load_wp_media_files' ] );

	}

	/**
	 * Add menu to wp-admin dashboard
	 */
	function cmywll_add_menu_option_to_wp_admin_dashboard() {
		add_menu_page( "Login Logo", "Login Logo", "edit_posts",
			"cmywll_change_my_login_logo_operation", 'cmywll_change_my_login_logo_operation', plugin_dir_url( __FILE__ ) . '/images/cmywll.png', 3 );
	}

	/**
	 * Load media files
	 */
	function cmywll_load_wp_media_files() {
		wp_enqueue_media();
		wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ) . '/css/bootstrap.min.css' );
		wp_enqueue_script( 'bootstrap-js', plugin_dir_url( __FILE__ ) . '/js/bootstrap.min.js' );
	}
}





