<?php
/**
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */
?>

<!-- BEGIN #post-<?php the_ID(); ?> -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- BEGIN .entry-header -->
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<!-- BEGIN .entry-meta -->
		<div class="entry-meta">
			<div class="six columns omega far-edge">
				<?php cdatwentythirteen_posted_on(); ?>
			</div>
		</div>
		<!-- END .entry-meta -->
		
	</header>
	<!-- END .entry-header -->

	<!-- BEGIN .entry-content -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cdatwentythirteen' ), 'after' => '</div>' ) ); ?>
	</div>
	<!-- END .entry-content -->

	<!-- BEGIN .entry-meta -->
	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'cdatwentythirteen' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'cdatwentythirteen' ) );

			if ( ! cdatwentythirteen_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cdatwentythirteen' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cdatwentythirteen' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cdatwentythirteen' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cdatwentythirteen' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', 'cdatwentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- END .entry-meta -->
</article>
<!-- END #post-<?php the_ID(); ?> -->
