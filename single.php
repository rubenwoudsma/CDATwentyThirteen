<?php
/**
 * The Template for displaying all single posts.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

get_header(); ?>

		<!-- BEGIN #main-container -->
		<div id="main-container" class="container">
			
			<!-- BEGIN #primary -->
			<div id="primary" class="site-content eleven columns">
				
				<!-- BEGIN #content -->
				<div id="content" role="main" class="">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php cdatwentythirteen_content_nav( 'nav-above' ); ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php cdatwentythirteen_content_nav( 'nav-below' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template( '', true );
					?>

				<?php endwhile; // end of the loop. ?>

				</div>
				<!-- END #content -->
			</div>
			<!-- END #primary -->
		
			<?php get_sidebar(); ?>
		
		</div>
		<!-- END #main-container -->
		
<?php get_footer(); ?>
