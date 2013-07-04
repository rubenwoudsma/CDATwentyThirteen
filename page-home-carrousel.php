<?php
/**
 * Template Name: Hom + Carrousel (and grid blocks)
 *
 * This template is used to get the normal starter page of the CDA website template. This will display a image carrousel
 * and an overview of the latest news items generated on the website.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */

get_header(); 

function cdatwentythirtheen_init_home_template() {

	$dir = get_template_directory_uri().'/';

	//Stylesheets
	wp_enqueue_style( 'flexslider-css', 	$dir . 'stylesheets/base.css' );
	//Javascript	
	wp_enqueue_script( 'flexslider-min', 	$dir . '/js/jquery.flexslider-min.js', array( 'jquery' ), '20130306', true );
	
}
add_action( 'wp_enqueue_scripts', 'cdatwentythirtheen_init_home_template' );

?>
		<!-- main-container container -->
		<div id="main-container" class="container">		
			<div id="primary" class="site-content">

				<div id="content" >

					<div id="first-row-container" class="sixteen columns">
						<div id="slider-container" class="eleven columns alpha">
						<?php
						if ( of_get_option('featured_slider_cat') ) {
							$feature_query = array ( 
												'cat' 				=> of_get_option( 'featured_slider_cat' ), 
												'showposts'			=> of_get_option( 'num_featured_posts' ), 
												'caller_get_posts'	=> 1,
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

									<li>
										<?php the_post_thumbnail('postpage-thumb'); ?>
										<p class="flex-caption"><?php the_excerpt(); ?></p>
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
						<div id="info-container" class="five columns omega">
						  <div class="featured-links">
							<ul class="featured-links-list">
							  <li class="featured-steunons"><a href="/partij/doe-mee/doneren/">Steun ons en doneer</a></li>
							  <li class="featured-wordlid"><a href="/partij/doe-mee/word-lid/">Word lid</a></li>
							  <li class="featured-aanmelden"><a href="/partij/doe-mee/aanmelden-als-vrijwilliger/">Aanmelden als vrijwilliger</a></li>
							  <li class="featured-bestellen"><a href="/contact/cda-webwinkel/" target="_Blanc">Materiaal bestellen</a></li>
							  <li class="featured-contact"><a href="/contact/">Contact</a></li>
							</ul>
						  </div>
						</div>
					</div>

					<?php 
					/* Main loop to retrieve the post experts on within this page template
					 * using a grid bord to show the different posts.
					 */

					 	query_posts( array ( 
										'cat'				=> of_get_option('expert_category'), 
										'showposts'			=> of_get_option('num_experts_posts'), 
										'caller_get_posts'	=> 1, 
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
		
<?php get_footer(); ?>