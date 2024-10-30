<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Change Logo on wordpress login
 */
class CMYWLL_New_Login_Logo {
	function __construct() {
		add_action( 'login_head', [ $this, 'cmywll_change_wp_login_logo' ] );
	}

	/**
	 * Update wordpress login logo css.
	 */
	function cmywll_change_wp_login_logo() {
		$location = esc_url( trim( get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_URL ) ) );
		$width    = trim( get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_WIDTH ) );
		$height   = trim( get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_HEIGHT ) );
		$bool     = wp_http_validate_url( $location ) !== false && ! empty( $width ) && ! empty( $height );
		if ( $bool ) {
			?>
            <style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url(<?=$location?>);
                    height: <?=$height?>px;
                    width: <?=$width?>px;
                    background-size: <?=$height?>px <?=$width?>px;
                    background-repeat: no-repeat;
                    padding-bottom: 0px;
                }
            </style>
		<?php } ?>
	<?php }
}