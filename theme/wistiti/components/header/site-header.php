<?php
global $header_args;
//get_template_part( 'components/header/site-header', 'customizer' );
get_customizer('components/header/site-header');

//inline
$inline = false;
if (isset($header_args['options']['inline']))
{
  $inline = $header_args['options']['inline'];
  if ($inline) {
    if (!isset($header_args['options']['inline_breakpoint'])) $header_args['options']['inline_breakpoint']='ns';
    $breakpoint_ext = ($header_args['options']['inline_breakpoint']!='s')?'-'.$header_args['options']['inline_breakpoint']:'';

    $header_args['classes']['wrapper'] .= ' flex'.$breakpoint_ext.' items-center'.$breakpoint_ext;
  }
}
?>

<?php if ($header_args['options']['activate']) :?>
  <a class="clip skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wistiti' ); ?></a>

  <header id="masthead" class="cf cmzr-site-header" role="banner">

    <div class="<?php echo $header_args['classes']['wrapper'];?>">
      <?php get_template_part( 'components/header/site', 'branding' ); ?>
      <div class='mt3'<?php echo $breakpoint_ext;?>></div>
      <?php get_template_part( 'components/navigation/navigation', 'main' ); ?>
    </div>

  </header>
<?php endif; unset($header_args);?>
