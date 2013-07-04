<?php
/**
 * The template used for displaying post items in a grid
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
			<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'More &rarr;', 'cdatwentythirteen' ); ?></a>

		</div>

	<?php break;

	/* FORMAT: IMAGE */
	case 'image':
		?>
		<?php //cdatwentythirteen_featured_image( cdatwentythirteen_image_size( $post->ID , 640 ), '' , false, '', false, get_the_title() ); ?>		
		<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'View &rarr;', 'cdatwentythirteen' ); ?></a>


	<?php break;

	/* FORMAT: QUOTE */
	case 'quote': ?>
		<a href="<?php the_permalink(); ?>" class="quote-link"><?php the_content(); ?></a>

	<?php break;

	/* FORMAT: VIDEO */
	case 'video':
		switch( get_post_meta( $post->ID , 'feature_type', true ) ){
				
			case 'video':
			case 'video-embed':
			default:
				$video_url = get_post_meta( $post->ID, 'featured_video' , true ); ?>
				<div class="hint clearfix"><?php _e( 'Please enter a video URL in the "Featured Video" field, or change the Feature Type', 'cdatwentythirteen' ); ?></div>
				<?php
				break;
		}
		?>
		<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'More &rarr;', 'cdatwentythirteen' ); ?></a>

	<?php break;



	/* FORMAT: GALLERY */
	case 'gallery':
		//cdatwentythirteen_slider( $post->ID , 'attachments' , cdatwentythirteen_image_size( $post->ID , 640 ) ); ?>
		<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'View Gallery &rarr;' , 'cdatwentythirteen' ); ?></a>
	
	<?php break;




	default: ?>

		<header class="">

			<?php if( has_post_thumbnail() ): ?>
			
			<div class="featured-image img-wrapper full-width">
			
				<?php //cdatwentythirteen_featured_image( cdatwentythirteen_standard_format_image_size( $post->ID, 640 , 'grid' ) ); ?>
			
			</div>
			
			<?php endif; ?>

			<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<!-- begin .entry-meta -->
			<div class="entry-meta">
				
				<span class="cat-links">
				<?php //cdatwentythirteen_categories(); ?>
				</span>
							
				<span class="meta-right far-edge">
					<?php cdatwentythirteen_posted_on(); ?>
				</span>
			</div>
			<!-- end .entry-meta -->
							
		</header>

		<div class="">

			
			<div class="entry-excerpt <?php if( 'aside' == get_post_format() ) echo 'tagline medium'; ?>">
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>" class="excerpt-link"><?php _e( 'Continue Reading &rarr;', 'cdatwentythirteen' ); ?></a>
			</div>
			
		</div>

	<?php } // end switch ?>
	
</article>
<!-- END #post-<?php the_ID(); ?> -->