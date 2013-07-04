<?php
/**
 * The template for displaying image attachments.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

get_header();
?>

		<!-- BEGIN #main-container -->
		<div id="main-container" class="container">
			
			<!-- BEGIN #primary -->
			<div id="primary" class="site-content image-attachment eleven columns">
				
				<!-- BEGIN #content -->
				<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<!-- BEGIN #post-<?php the_ID(); ?> -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
						<!-- BEGIN .entry-header -->
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>

							<!-- BEGIN .entry-meta -->
							<div class="entry-meta">
								<?php
									$metadata = wp_get_attachment_metadata();
									printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'cdatwentythirteen' ),
										esc_attr( get_the_date( 'c' ) ),
										esc_html( get_the_date() ),
										wp_get_attachment_url(),
										$metadata['width'],
										$metadata['height'],
										get_permalink( $post->post_parent ),
										esc_attr( get_the_title( $post->post_parent ) ),
										get_the_title( $post->post_parent )
									);
								?>
								<?php edit_post_link( __( 'Edit', 'cdatwentythirteen' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
							</div>
							<!-- END .entry-meta -->

							<!-- BEGIN #image-navigation -->
							<nav id="image-navigation" class="site-navigation">
								<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'cdatwentythirteen' ) ); ?></span>
								<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'cdatwentythirteen' ) ); ?></span>
							</nav>
							<!-- END #image-navigation -->
						</header>
						<!-- END .entry-header -->

						<!-- BEGIN .entry-content -->
						<div class="entry-content">

							<!-- BEGIN .entry-attachment -->
							<div class="entry-attachment">
								<div class="attachment">
									<?php
										/**
										 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
										 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
										 */
										$attachments = array_values( get_children( array(
											'post_parent'    => $post->post_parent,
											'post_status'    => 'inherit',
											'post_type'      => 'attachment',
											'post_mime_type' => 'image',
											'order'          => 'ASC',
											'orderby'        => 'menu_order ID'
										) ) );
										foreach ( $attachments as $k => $attachment ) {
											if ( $attachment->ID == $post->ID )
												break;
										}
										$k++;
										// If there is more than 1 attachment in a gallery
										if ( count( $attachments ) > 1 ) {
											if ( isset( $attachments[ $k ] ) )
												// get the URL of the next image attachment
												$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
											else
												// or get the URL of the first image attachment
												$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
										} else {
											// or, if there's only 1 image, get the URL of the image
											$next_attachment_url = wp_get_attachment_url();
										}
									?>

									<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
										$attachment_size = apply_filters( 'cdatwentythirteen_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
										echo wp_get_attachment_image( $post->ID, $attachment_size );
									?></a>
								</div><!-- .attachment -->

								<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<!-- END .entry-caption -->
								<?php endif; ?>
							</div>
							<!-- END .entry-attachment -->

							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'cdatwentythirteen' ), 'after' => '</div>' ) ); ?>

						</div>
						<!-- END .entry-content -->

						<!-- BEGIN .entry-meta -->
						<footer class="entry-meta">
							<?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open ?>
								<?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'cdatwentythirteen' ), get_trackback_url() ); ?>
							<?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open ?>
								<?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'cdatwentythirteen' ), get_trackback_url() ); ?>
							<?php elseif ( comments_open() && ! pings_open() ) : // Only comments open ?>
								<?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'cdatwentythirteen' ); ?>
							<?php elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed ?>
								<?php _e( 'Both comments and trackbacks are currently closed.', 'cdatwentythirteen' ); ?>
							<?php endif; ?>
							<?php edit_post_link( __( 'Edit', 'cdatwentythirteen' ), ' <span class="edit-link">', '</span>' ); ?>
						</footer>
						<!-- END .entry-meta -->
					</article>
					<!-- END #post-<?php the_ID(); ?> -->

					<?php comments_template(); ?>

				<?php endwhile; // end of the loop. ?>

				</div>
				<!-- END #content -->
			</div>
			<!-- END #primary -->
		
			<?php get_sidebar(); ?>
		
		</div>
		<!-- END #main-container -->

<?php get_footer(); ?>