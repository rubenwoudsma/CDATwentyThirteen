<?php
/**
 * The template for displaying 404 pages (Not Found).
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

					<!-- BEGIN #post-0 -->
					<article id="post-0" class="post error404 not-found">
					
						<!-- BEGIN .entry-header -->
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'cdatwentythirteen' ); ?></h1>
						</header>
						<!-- END .entry-header -->

						<!-- BEGIN .entry-content -->
						<div class="entry-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cdatwentythirteen' ); ?></p>

							<?php get_search_form(); ?>

							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

							<!-- BEGIN .widget -->
							<div class="widget">
								<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'cdatwentythirteen' ); ?></h2>
								<ul>
								<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
								</ul>
							</div>
							<!-- END .widget -->

							<?php
							/* translators: %1$s: smilie */
							$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'cdatwentythirteen' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>

							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

						</div>
						<!-- END .entry-content -->
					</article>
					<!-- END #post-0 -->

				</div>
				<!-- END #content -->
			</div>
			<!-- END #primary -->

			<?php get_sidebar(); ?>

		</div>
		<!-- END #main-container -->
		
<?php get_footer(); ?>