<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wistiti
 */
?>

	</div>
	<footer id="colophon" role="contentinfo">
		<div>
			<?php get_template_part( 'components/footer/site', 'info' ); ?>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>

<?php unset($wistiti_args);?>
