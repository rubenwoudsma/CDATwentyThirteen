<?php
/**
 * The template used for displaying post items in a newsblocks
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'one-third column with-meta' ); ?>>
	
	<?php switch( get_post_format() ){
		

	/* FORMAT: STATUS */
	case 'status': ?>
		<div class="entry-excerpt tagline notop-margin nobottom">

			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'More', 'cdatwentythirteen' ); ?></a>

		</div>

	<?php break;

	/* FORMAT: IMAGE */
	case 'image':
		?>
		<?php the_post_thumbnail( 'columns-thumb' )  ?>		
		<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'View', 'cdatwentythirteen' ); ?></a>


	<?php break;

	/* FORMAT: QUOTE */
	case 'quote': ?>
		<a href="<?php the_permalink(); ?>" class="quote-link"><?php the_content(); ?></a>

	<?php break;

	default: ?>

		<header class="">

			<?php if( has_post_thumbnail() ): ?>
			
			<div class="featured-image img-wrapper full-width">
			
				<?php the_post_thumbnail( 'columns-thumb' ); ?>
			
			</div>
			
			<?php endif; ?>

			<h1 class="entry-title"><span class="grid-postdate"><?php the_date(); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							
		</header>

		<div class="">

			
			<div class="entry-excerpt <?php if( 'aside' == get_post_format() ) echo 'tagline medium'; ?>">
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'Continue Reading', 'cdatwentythirteen' ); ?></a>
			</div>
			
		</div>

	<?php } // end switch ?>
	
</article>
<!-- END #post-<?php the_ID(); ?> -->