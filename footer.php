<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 
 */
?>

	<!-- BEGIN #colophon -->
	<footer id="colophon" class="site-footer" role="contentinfo">
	
		<!-- BEGIN .footer-upper -->
		<div class="footer-upper container">

			<div class="one-third column">

				<!-- Widget Area: Footer Left -->
				<?php dynamic_sidebar( 'footer-left' ); ?>
				<!-- End Widget Area: Footer Left -->

			</div>


			<div class="one-third column">

				<!-- Widget Area: Footer Center -->
				<?php dynamic_sidebar( 'footer-center' ); ?>
				<!-- End Widget Area: Footer Center -->

			</div>

			<div class="one-third column">
				
				<!-- Widget Area: Footer Right -->
				<?php dynamic_sidebar( 'footer-right' ); ?>
				<!-- End Widget Area: Footer Right -->

			</div>
		
		</div>
		<!-- END .footer-upper -->
		
		<!-- BEGIN #footer-base -->
		<div id="footer-base" class="site-info">
			
			<div class="container">
				<?php do_action( 'cdatwentythirteen_credits' ); ?>
				<div class="eight columns"><?php cdatwentythirteen_social_media_icons(); echo of_get_option( 'footer-left' ); ?></div>
				<div class="eight columns far-edge"><?php echo of_get_option( 'footer-right' ); ?></div>
			</div>
			
		</div>
		<!-- END #footer-base -->
		
	</footer>
	<!-- END #colophon -->
	
</div>
<!-- END #page -->

<?php wp_footer(); ?>

</body>
</html>