<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- BEGIN .entry-header -->
	<header class="entry-header">
		<h1 class="page-title entry-title"><?php the_title(); ?></h1>
	</header>
	<!-- END .entry-header -->

	<!-- BEGIN .entry-content -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cdatwentythirteen' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'cdatwentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<!-- END .entry-content -->
</article>
<!-- END #post-<?php the_ID(); ?> -->
