<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */
?>
		<!-- BEGIN #secondary -->
		<div id="secondary" class="widget-area sidebar sidebar-<?php echo $sidebar_id; ?> four columns <?php echo $sidebar_offset; ?>" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'cdatwentythirteen' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'cdatwentythirteen' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div>
		<!-- END #secondary  -->
