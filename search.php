<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

get_header(); ?>

		<!-- BEGIN #main-container -->
		<div id="main-container" class="container">
			
			<!-- BEGIN #primary -->
			<section id="primary" class="site-content eleven columns">
				
				<!-- BEGIN #content -->
				<div id="content" role="main">

				<?php if ( have_posts() ) : ?>

					<!-- BEGIN .page-header -->
					<header class="page-header">
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'cdatwentythirteen' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header>
					<!-- END .page-header -->

					<?php cdatwentythirteen_content_nav( 'nav-above' ); ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>

					<?php cdatwentythirteen_content_nav( 'nav-below' ); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'search' ); ?>

				<?php endif; ?>

				</div>
				<!-- END #content -->
			</section>
			<!-- END #primary -->
		
			<?php get_sidebar(); ?>
		
		</div>
		<!-- END #main-container -->
		
<?php get_footer(); ?>