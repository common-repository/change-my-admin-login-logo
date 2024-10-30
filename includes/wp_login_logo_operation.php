<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Access denied ! Please Login' );
}

function cmywll_change_my_login_logo_operation() {

	$message = "";
	$bool    = $_POST['change-my-wordpress-login-logo-nonce-field'] && wp_verify_nonce( $_POST['change-my-wordpress-login-logo-nonce-field'],
			'change-my-wordpress-login-logo-nonce-action' ) && current_user_can( 'edit_posts' ) === true;
	if ( $bool ) {
		$height     = sanitize_text_field( $_POST['logo-height'] );
		$width      = sanitize_text_field( $_POST['logo-width'] );
		$location   = sanitize_text_field( $_POST['logo_file_location'] );
		$url_option = ( get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_URL, null ) !== null );

		if ( ! is_numeric( $width ) || ! is_numeric( $height ) ) {
			$message = cmywll_change_my_login_logo_validation_message( "alert alert-danger", "Invalid Height/ Width value." );
		}
		if ( empty( trim( $location ) ) ) {
			$message = cmywll_change_my_login_logo_validation_message( "alert alert-danger", "Invalid image file location." );
		}

		if ( empty( $message ) ) {
			if ( $url_option ) {
				update_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_URL, $location );
			} else {
				add_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_URL, $location );
			}
			$height_option = ( get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_HEIGHT, null ) !== null );
			if ( $height_option ) {
				update_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_HEIGHT, $height );
			} else {
				add_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_HEIGHT, $height );
			}
			$width_option = ( get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_WIDTH, null ) !== null );
			if ( $width_option ) {
				update_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_WIDTH, $width );
			} else {
				add_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_WIDTH, $width );
			}
			$message = cmywll_change_my_login_logo_validation_message( "alert alert-success", "Data saved successfully" );
		}
	}
	$location = esc_url( get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_URL ) );
	$width    = get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_WIDTH );
	$height   = get_option( CMYWLL_Option_Constants::CHANGE_MY_LOGIN_LOGO_HEIGHT );

	echo "
        <h1 class='display-6'>Update Logo Setting</h1>
        </br>
        <div class='col-md-7 col-md-offset-4'>
            <form action='' method='POST' name='login_logo_form'>	
                " . wp_nonce_field( 'change-my-wordpress-login-logo-nonce-action', 'change-my-wordpress-login-logo-nonce-field' ) . "        
				   
             <div class='form-group row'>
                    <label for='inputLogoHeight' class='col-sm-2 col-form-label'>Logo Image</label>
                    <div class='col-sm-10'>
                        <input type='file' class='custom-file-input' id='upload-btn' />
                        <label class='custom-file-label' for='InputChoseFile' style='margin-left: 15px'>Choose file</label>
                         <span class='badge badge-light'>png, jpg, jpeg</span>                   
                         <input type='text' name= 'logo_file_location' class='form-control' id='logo_file_location' value='$location' readonly>
                    </div>
              </div>
                <div class='form-group row'>
                    <label for='inputLogoHeight' class='col-sm-2 col-form-label'>Logo Height</label>
                    <div class='col-sm-10'>
                        <input type='text' name= 'logo-height' class='form-control' id='logo-height' value='$height' required><span class='badge badge-light'>px</span>
                    </div>
                </div>
                <div class='form-group row'>
                    <label for='inputLogoWidth' class='col-sm-2 col-form-label'>Logo Width</label>
                    <div class='col-sm-10'>
                        <input type='text' name='logo-width' class='form-control' id='logo-width' value='$width' required><span class='badge badge-light'>px</span>
                    </div>
                </div>
                <div class='form-group row'>
                    <div class='col-sm-10 offset-sm-2'>
                        <button type='submit' class='btn btn-primary'>Save Settings</button>
                    </div>
                </div>

            </form>
        </div>
    ";
	if ( ! empty( $message ) ) {
		echo $message;
	}

	echo "
            <script type='text/javascript'>
                jQuery(document).ready(function($){
                    $('#upload-btn').click(function(e) {
                        e.preventDefault();
                        var image = wp.media({ 
                            title: 'Upload Image',
                            // mutiple: true if you want to upload multiple files at once
                            multiple: false
                        }).open()
                        .on('select', function(e){
                            // This will return the selected image from the Media Uploader, the result is an object
                            var uploaded_image = image.state().get('selection').first();                         
                            var image_url = uploaded_image.toJSON().url;                         
                            // Let's assign the url value to the input field                         
                            $('#logo_file_location').val(image_url);
                        });
                    });
                });
            </script>   
    
    ";
}

/**
 * Validation message
 *
 * @param $class_name
 * @param $message
 *
 * @return string
 */
function cmywll_change_my_login_logo_validation_message( $class_name, $message ) {
	return "<div class='$class_name' role='alert' style='width: 50%; margin-left: 180px'>$message</div>";
}