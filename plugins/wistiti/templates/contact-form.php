<?php
    global $contactform_args;
    wistiti_get_template('/customizers/contact-form-customizer.php', $atts);
?>

<form action="<?php esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
  <p>
    <label for="cf-name" id="cf-name-label" class="<?php echo $contactform_args['classes']['input_label'];?>"><?php _e('Your Name', 'wistiti');?></label>
    <input id="cf-name" class="<?php echo $contactform_args['classes']['input_text'];?>" type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="<?php ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' );?>" size="40" />
  </p>
  <p>
    <label for="cf-email" id="cf-email-label" class="<?php echo $contactform_args['classes']['input_label'];?>"><?php _e('Your Email', 'wistiti');?> *</label>
    <input id="cf-email" aria-required="true" class="<?php echo $contactform_args['classes']['input_text'];?>" type="email" name="cf-email" value="<?php ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' )?>" size="40" />
  </p>
  <p>
    <label for="cf-subject" id="cf-subject-label" class="<?php echo $contactform_args['classes']['input_label'];?>"><?php _e('Subject', 'wistiti');?></label>
    <input id="cf-subject" class="<?php echo $contactform_args['classes']['input_text'];?>" type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="<?php ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ); ?>" size="40" />
  </p>
  <p>
    <label for="cf-message" id="cf-message-label" class="<?php echo $contactform_args['classes']['input_label'];?>"><?php _e('Your Message', 'wistiti');?> *</label>
    <textarea id="cf-message" aria-required="true" class="<?php echo $contactform_args['classes']['input_text'];?>" rows="10" cols="35" name="cf-message"><?php ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' );?></textarea>
  </p>
  <p>
    <input class="<?php echo $contactform_args['classes']['input_submit'];?>" type="submit" name="cf-submitted" value="<?php _e('Send', 'wistiti');?>">
  </p>
</form>
