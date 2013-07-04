<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */
?>

<!-- BEGIN #post-0 -->
<article id="post-0" class="post no-results not-found">

	<!-- BEGIN .entry-header -->
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'cdatwentythirteen' ); ?></h1>
	</header>
	<!-- END .entry-header -->

	<!-- BEGIN .entry-content -->
	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cdatwentythirteen' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cdatwentythirteen' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cdatwentythirteen' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
	<!-- END .entry-content -->
</article>
<!-- END #post-0 -->
