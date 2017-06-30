
<?php $base_url = get_bloginfo('url');?>

<?php //Main jumbotron
if (function_exists("jumbotron_setup")) :?>
  <section class="mw8 center">
    <?php echo do_shortcode('[wistiti_jumbotron id="wistiti"]');?>
  </section>
<?php endif;?>

<!-- Simple content -->
<section class="mw8 center">
  <h2>A starter theme</h2>
  <p>The theme is inspired from 'Components' (Underscore). With just some little modifications :</p>
  <ul>
    <li>A navigation menu </li>
    <li>A 3 widgets footer </li>
    <li>No jquery</li>
  </ul>
  <h2>A plugin</h2>
  <p>Lorem ipsum...</p>
</section>
