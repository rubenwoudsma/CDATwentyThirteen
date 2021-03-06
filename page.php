<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
				<div id="content" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

					<?php endwhile; // end of the loop. ?>

				</div>
				<!-- END #content -->
			</div>
			<!-- END #primary -->

			<?php get_sidebar(); ?>
		
		</div>
		<!-- END #main-container -->
		
<?php get_footer(); ?>