<?php
/**
 * Info: The template for displaying search forms in CDATwentyThirteen
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */
?>
	<!-- BEGIN form #searchform -->
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'cdatwentythirteen' ); ?></label>
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'cdatwentythirteen' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'cdatwentythirteen' ); ?>" />
	</form>
	<!-- END form #searchform -->
