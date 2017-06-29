<?php

function wistiti_contactform_deliver_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {

		// sanitize form values
		$name    = sanitize_text_field( $_POST["cf-name"] );
		$email   = sanitize_email( $_POST["cf-email"] );
		$subject = sanitize_text_field( $_POST["cf-subject"] );
		$message = esc_textarea( $_POST["cf-message"] );

		// get the blog administrator's email address
		$to = get_option( 'admin_email' );

		$headers = "From: $name <$email>" . "\r\n";

		//Check basic manadatory fiels
		if (!empty($email) && !empty($message)) {
			// If email has been process for sending, display a success message
			if ( wp_mail( $to, $subject, $message, $headers ) ) {
				wistiti_get_template('partials/contact-success.php');
			} else {
				wistiti_get_template('partials/contact-error.php');
			}
		}
		else {
			wistiti_get_template('partials/contact-invalid.php');
		}
	}
}


function wistiti_contactform_shortcode($atts = [], $content = null, $tag = '') {

		// normalize attribute keys, lowercase
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		ob_start();

		wistiti_contactform_deliver_mail();

		wistiti_get_template('contact-form.php');

		return ob_get_clean();
}

add_shortcode( 'wistiti_contact_form', 'wistiti_contactform_shortcode' );
?>
