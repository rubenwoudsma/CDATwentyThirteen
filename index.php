<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

get_header(); ?>
	
		<!-- BEGIN #main-container -->
		<div id="main-container" class="container">
		
			<!--  BEGIN .site-content -->
			<div id="primary" class="site-content eleven columns">
			
				<div id="content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php cdatwentythirteen_content_nav( 'nav-above' ); ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
							?>

					<?php endwhile; ?>

					<?php cdatwentythirteen_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>

				</div>
				<!-- END #content  -->
			</div>
			<!-- END .site-content -->

			<?php get_sidebar(); ?>
		</div>
		<!-- END #main-container -->
				
<?php get_footer(); ?>