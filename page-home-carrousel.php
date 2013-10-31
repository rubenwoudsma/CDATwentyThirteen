<?php
/**
 * Template Name: Home + Carousel (and grid blocks)
 *
 * This template is used to get the normal starter page of the CDA website template. This will display a image carousel
 * and an overview of the latest news items generated on the website.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

get_header(); 
?>
		<!-- main-container container -->
		<div id="main-container" class="container">		
			<div id="primary" class="site-content">

				<div id="content" >

					<div id="first-row-container" class="sixteen columns">
						<div id="slider-frontpage" class="slider-container eleven columns alpha">
						<?php
						if ( of_get_option('featured_slider_cat') ) {
							$feature_query = array ( 
												'cat' 				=> of_get_option( 'featured_slider_cat' ), 
												'showposts'			=> of_get_option( 'num_featured_posts' ), 
												'ignore_sticky_posts'	=> 1,
												'meta_query'		=> array(array('key' => '_thumbnail_id')) 
											);
						} else {
							$feature_query = array ( 
												'post__in' 			=> get_option( 'sticky_posts' ), 
												'showposts' 		=> of_get_option( 'num_featured_posts' ),
												'meta_query'		=> array( array ( 'key' => '_thumbnail_id' ) ) 
											);
						}

						//Secondary Query (for featured posts)
						$featured_post_loop = new WP_Query( $feature_query );

						//Loop for secondary query
						if( $featured_post_loop->have_posts() ):
						?>
							<div class="flexslider">
								<ul class="slides">

								<?php while( $featured_post_loop->have_posts() ): $featured_post_loop->the_post(); $do_not_duplicate[] = $post->ID; ?>

									<li class="slide">
										<?php the_post_thumbnail( 'postpage-thumb' ); ?>
										<div class="flex-caption">
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
											<p class="caption-text"><?php cdatwentythirteen_the_excerpt_max_charlength(150); ?></p>
										</div>
									</li>
									<?php
									endwhile;
									?>
								</ul>
							</div>
						<?php
						endif;
						
						/* Restore original Post Data 
						 * NB: Because we are using new WP_Query we aren't stomping on the 
						 * original $wp_query and it does not need to be reset.
						*/
						wp_reset_postdata(); 
						?>
						</div>
						<?php get_template_part( 'content', 'infobar' ); ?>
					</div>

					<?php 
					/* Main loop to retrieve the post experts on within this page template
					 * using a grid bord to show the different posts.
					 */

					 	query_posts( array ( 
										'cat'				=> of_get_option('expert_category'), 
										'showposts'			=> of_get_option('num_experts_posts'), 
										'ignore_sticky_posts'	=> 1, 
										'post__not_in'		=> $do_not_duplicate 
									) 
						);
						?>
						<div class="row">
							<hr class="sixteen columns">
							<h5 class="entry-title page-title sixteen columns">Nieuwsoverzicht</h5>
						</div>

						<!-- Blog Grid Layout -->		
						<div id="blog-grid" class="col-3 cf clearfix blog-layout-grid newsblocks">

							<?php 
							/* Start the Loop */ 
							$post_index = 0;
							
							while( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID;
							//while ( $blog_query->have_posts() ) : $blog_query->the_post();

									/* Include the Post-Format-specific template for the content.
									 * If you want to overload this in a child theme then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'content', 'grid' );
									$post_index++;

							endwhile;
							?>
						</div>		
						<!-- end #blog-grid -->
				</div>
				<!-- end #content -->
			</div>
			<!-- end #primary .site-content -->
		</div>
		<!-- end #main-container .container -->

		<script  type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery('.flexslider').flexslider({
		    animation: "slide"
		  });
		});
		</script>
		
<?php get_footer(); ?>