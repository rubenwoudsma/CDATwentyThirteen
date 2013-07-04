<?php
/**
 * Default template for displayin blog post in the loop!
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */
?>

<!-- begin content.php: #post-<?php the_ID(); ?> -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- BEGIN .entry-header -->
	<header class="entry-header">

		<!-- Featured image ??? -->
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'cdatwentythirteen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<!-- BEGIN .entry-meta -->
		<div class="entry-meta">
			<?php cdatwentythirteen_posted_on(); ?>
		</div>
		<!-- END .entry-meta -->
		<?php endif; ?>
		
	</header>
	<!-- END .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<!-- .entry-summary -->
	<?php else : ?>
	
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'cdatwentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cdatwentythirteen' ), 'after' => '</div>' ) ); ?>
	</div>
	<!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
		
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'cdatwentythirteen' ) );
				if ( $categories_list && cdatwentythirteen_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'cdatwentythirteen' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'cdatwentythirteen' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'cdatwentythirteen' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'cdatwentythirteen' ), __( '1 Comment', 'cdatwentythirteen' ), __( '% Comments', 'cdatwentythirteen' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'cdatwentythirteen' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer>
	<!-- END .entry-meta -->
	
</article>
<!-- END content.php #post-<?php the_ID(); ?> -->
