<form action="<?php the_permalink(); ?>" method="post">
  <p><?php _e('Your Name', 'wistiti');?><br/>
    <input class="f5 pa1 w-75 w-50-ns" type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="<?php ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' );?>" size="40" />
  </p>
  <p><?php _e('Your Email', 'wistiti');?>*<br/>
    <input class="f5 pa1 w-75 w-50-ns" type="email" name="cf-email" value="<?php ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' )?>" size="40" />
  </p>
  <p><?php _e('Subject', 'wistiti');?><br/>
    <input class="f5 pa1 w-75 w-50-ns" type="text" name="cf-subject" pattern="[a-zA-Z ]+" value="<?php ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ); ?>" size="40" />
  </p>
  <p><?php _e('Your Message', 'wistiti');?>*<br/>
    <textarea class="f5 pa1 w-75 w-50-ns" rows="10" cols="35" name="cf-message"><?php ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' );?></textarea>
  </p>
  <p><input class="f5 bg-<?php echo get_theme_mod( 'smew_colors_brand', 'blue' ); ?> white bw0 pa3" type="submit" name="cf-submitted" value="<?php _e('Send', 'smew-simple-elements');?>"></p>
</form>
