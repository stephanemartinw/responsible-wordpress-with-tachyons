<?php
global $header_args;
get_template_part( 'components/header/site-header', 'customizer' );

//To do : use args in this template !
?>

<?php if ($header_args['options']['activate']) :?>
  <a class="clip skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wistiti' ); ?></a>

  <header id="masthead" class="cf cmzr-site-header" role="banner">

    <div class="relative flex items-center">
      <?php get_template_part( 'components/header/site', 'branding' ); ?>
      <?php get_template_part( 'components/navigation/navigation', 'main' ); ?>
    </div>

  </header>
<?php endif;?>
