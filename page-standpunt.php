<?php
/**
 * Template Name: CPT standpunt alphabetical page
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
			<div id="primary" class="site-content sixteen columns">
			
				<!-- BEGIN #content -->
				<div id="content" role="main">
				
					<!-- BEGIN #A-Z Index for CPT 'standpunt' -->
					<div id="azindex-cpt-standpunt" class="azindex">
					<?php 
					/*
					 * Additional query arguments for the post loop
					 */
					$args = array(
					     'post_type'			=> 'standpunt',
					     'orderby'				=> 'title',
					     'order'				=> 'ASC',
					     'ignore_sticky_posts'	=> 1,
					);

					query_posts($args);
					$column_counter = 0;	//Columncounter to break after 3 columns
					while ( have_posts() ) : the_post();

						$first_letter = strtoupper(substr(apply_filters('the_title',$post->post_title),0,1));
						if ($first_letter != $curr_letter) {
							$column_counter++;
							if (++$post_count > 1) {
								cdatwentythirteen_end_prev_letter($column_counter);
							}
							cdatwentythirteen_start_new_letter($first_letter, $column_counter);
							$curr_letter = $first_letter;
						} 
						?>
								<li class="standpunt"><a href="<?php the_permalink() ?>" rel="bookmark" title="Meer informatie over standpunt: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
						
						<?php if ($column_counter >= 3 ) $column_counter = 0; ?>
					<?php endwhile; ?>
					<?php cdatwentythirteen_end_prev_letter($column_counter); ?>
					
					</div>
					<!-- END #azindex-cpt-standpunt -->
					
				</div>
				<!-- END #content -->
			</div>
			<!-- END #primary -->
	
		</div>
		<!-- END #main-container -->
		
<?php get_footer(); ?>

<?php
/*
 * Function to be called when ending the previous letter
 */
function cdatwentythirteen_end_prev_letter($counter)
{
	global $post_count;
?>
							</ul>
						</div>
						<!-- END .letterbox -->
	<?php if ($post_count > 1 && $counter == 1) echo "<br class='clear' />"; ?>
<?php
}

/*
 * Function to be called when starting the new letter
 */
function cdatwentythirteen_start_new_letter($letter, $columncounter)
{
	
	//Check if additional CSS class needs to be added
	if ( $columncounter == 1 ) {
		$extra_class = "alpha";
	} elseif ( $columncounter == 2 ) {
		$extra_class = "";
	} elseif ( $columncounter == 3 ) {
		$extra_class = "omega";
	}
	?>
					<!-- START .letterbox for <?php echo $letter; ?> in column <?php echo $columncounter; ?> -->
					<div class="letterbox one-third column <?php echo $extra_class; ?>">
						<div class="letter"><?php echo $letter; ?></div>
							<ul><?php
}
?>