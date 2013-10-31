<?php
/**
 * Template Name: People page (list all members)
 *
 * This template is used to get display a list of all the members of all the authors within the website. These can be 
 * filtered based upon the roles.
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
						<div id="slider-container" class="eleven columns alpha">
							<!-- Afbeelding voor 'onze-mensen' toevoegen -->
							<!-- Of afbeelding baseren op uitgelichte afbeelding -->
						</div>
						<?php get_template_part( 'content', 'infobar' ); ?>
					</div>

					<div class="row">
						<hr class="sixteen columns">
						<h5 class="entry-title page-title sixteen columns">Onze mensen</h5>
					</div>

					<!-- Page 'Onze-mensen' Layout -->		
					<div id="blog-grid" class="col-3 cf clearfix blog-layout-grid people-overview newsblocks">
						
						<?php echo cdatwentythirteen_people_page(); ?>
						
					</div>		
					<!-- end page #onze-mensen layout -->
				</div>
				<!-- end #content -->
			</div>
			<!-- end #primary .site-content -->
		</div>
		<!-- end #main-container .container -->
		
<?php get_footer(); ?>