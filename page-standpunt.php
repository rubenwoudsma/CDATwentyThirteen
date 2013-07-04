<?php
/**
 * Template Name: Custom post type Standpunt listing page
 *
 * The template for displaying specific page regarding the standpunten.
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
				
					<?php				 
					echo '<h2>Standpunten - Alfabetische lijst met standpunten</h2>
 
					  <div id="alphaList" align="center">'.get_alphabet_nav('standpunten').'</div><br />';
					?>
					<?php 
					query_posts(array('post_type'=>'standpunt'));
					while ( have_posts() ) : the_post(); ?>

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